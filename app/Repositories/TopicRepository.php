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
    protected $user;
    protected $topic;

    /**
     * TopicRepository constructor.
     *
     * @param $topic
     */
    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
        $this->user = user();
    }

    public function getAllTopicsWithAuthor(Request $request)
    {
        return $this->topic->withOrder($request->order)
            ->undeleted()->published()
            ->with('user', 'category')->get();
    }

    public function getTopicById($id)
    {
        return $this->topic->findOrFail($id);
    }

    public function getTopicWithLabelById($id)
    {
        return $this->topic->where('id', $id)->with('labels')->firstOrFail();
    }

    public function create(array $attributes)
    {
        $attributes['user_id'] = Auth::id();
        $attributes['last_reply_user_id'] = Auth::id();

        return $this->topic->create($attributes);
    }

    public function update($topic, array $attributes)
    {
        $attributes['last_reply_user_id'] = user()->id;

        return $topic->update($attributes);
    }

    public function delete($topic)
    {
        $topic->is_delete = Topic::IS_DELETE;

        return $topic->save();
    }

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

    private function getLabelIdByName($label)
    {
        $oldLabel = Label::where('name', $label)->first();
        if (!$oldLabel) {
            $newLabel = Label::create(['name' => $label, 'description' => $label, 'topics_count' => 1, 'creator' => user()->id]);

            return $newLabel->id;
        }

        return $oldLabel->id;
    }

    public function getTopicsWithCategories(Category $category, Request $request, $pageSize = 20)
    {
        return $this->topic->withOrder($request->order)
                        ->with('user', 'category')
                        ->where('category_id', $category->id)
                        ->paginate($pageSize);
    }
}