<?php
/**
 * Created by HanGang.
 * Date: 2017/11/12
 */

namespace App\Repositories;

use Auth;
use App\Models\Category;
use App\Models\Topic;
use App\Models\Label;
use Illuminate\Http\Request;

class TopicRepository extends BaseRepository
{
    /**
     * The user model instance.
     * @var
     */
    protected $user;

    /**
     * The topic model instance.
     *
     * @var Topic
     */
    protected $topic;

    /**
     * TopicRepository constructor.
     *
     * @param $topic
     */
    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    /**
     * Get all topics.
     *
     * @param Request $request
     * @param int $pageSize
     * @param bool $showAll
     * @return mixed
     */
    public function getAllTopicsWithAuthor(Request $request, $pageSize = 20, $showAll = false)
    {
        $title = ($request->has('q') && $request->get('q')) ? $request->get('q') : '';

        $resource = $this->topic->withOrder($request->order)
            ->byTitle($title);

        if ( !$showAll) $resource->undeleted()->published();

        return $resource->with('user', 'category')
            ->paginate($pageSize);
    }

    /**
     * Get topic by topic id.
     *
     * @param $id
     * @return mixed
     */
    public function getTopicById($id)
    {
        return $this->topic->findOrFail($id);
    }

    /**
     * Get topic with label by topic id.
     *
     * @param $id
     * @return mixed
     */
    public function getTopicWithLabelById($id)
    {
        return $this->topic->where('id', $id)->with('labels')->firstOrFail();
    }

    /**
     * Create a topic.
     *
     * @param array $attributes
     * @return Topic
     */
    public function create(array $attributes)
    {
        $this->topic->fill($attributes);
        $this->topic->user_id = user()->id;
        $this->topic->last_reply_user_id = 0;

        $this->topic->save();

        return $this->topic;
    }

    /**
     * Update topic.
     *
     * @param $topic
     * @param array $attributes
     * @return mixed
     */
    public function update($topic, array $attributes)
    {
        $topic->fill($attributes);
        $topic->last_reply_user_id = 0;

        return $topic->update($attributes);
    }

    /**
     * Delete topic  update topic column is_delete.
     *
     * @param $topic
     * @return mixed
     */
    public function delete($topic)
    {
        $topic->is_delete = Topic::IS_DELETE;

        return $topic->save();
    }

    /**
     * 新建话题时 规范 label id.
     *
     * @param array $labels
     * @return array
     */
    public function normalizeLabelOnCreate(array $labels)
    {
        return collect($labels)->map(function ($label) {
            if (is_numeric($label)) {
                // 文章数目 递增
                Label::findOrFail($label)->increment('topics_count');
                return (int) $label;
            }

            return $this->getLabelIdByName($label);
        })->toArray();
    }

    /**
     * 更新话题时 规范 label id.
     *
     * @param array $labels
     * @param $topic
     * @return array
     */
    public function normalizeLabelOnUpdate(array $labels, $topic)
    {
        $labels = collect($labels)->map(function ($label) {
            if (is_numeric($label)) {
                return (int) $label;
            }
            return $this->getLabelIdByName($label);
        })->toArray();

        $oldLabelIds = $topic->labels()->pluck('labels.id')->toArray();
        $incrementIds = [];
        foreach ($labels as $label) {
            if (!in_array($label, $oldLabelIds)) {
                $incrementIds[] = $label;
            }
        }
        if (!empty($incrementIds)) Label::whereIn('id', $incrementIds)->increment('topics_count');

        $decrementIds = [];
        foreach ($oldLabelIds as $id) {
            if (!in_array($id, $labels)) {
                $decrementIds[] = $id;
            }
        }
        if (!empty($decrementIds)) Label::whereIn('id', $decrementIds)->decrement('topics_count');

        return $labels;
    }

    /**
     * Get label id By label name.
     *
     * @param $label
     * @return mixed
     */
    private function getLabelIdByName($label)
    {
        $oldLabel = Label::where('name', $label)->first();
        if (!$oldLabel) {
            $newLabel = Label::create(['name' => $label, 'description' => $label, 'topics_count' => 1, 'creator' => user()->id]);

            return $newLabel->id;
        }

        return $oldLabel->id;
    }

    /**
     * Get topics by category.
     *
     * @param Category $category
     * @param Request $request
     * @param int $pageSize
     * @return mixed
     */
    public function getTopicsByCategory(Category $category, Request $request, $pageSize = 20)
    {
        return $this->topic->withOrder($request->order)
                        ->with('user', 'category')
                        ->where('category_id', $category->id)
                        ->paginate($pageSize);
    }

    /**
     * Topic relation models decrement column topics_count.
     *
     * @param $topic
     * @return bool
     */
    public function decTopicRelations($topic)
    {
        $topic->user()->decrement('topics_count');

        $topic->category()->decrement('topics_count');

        $labelIds = $topic->labels()->pluck('label_id');
        Label::where('id', $labelIds)->decrement('topics_count');

        return true;
    }
}