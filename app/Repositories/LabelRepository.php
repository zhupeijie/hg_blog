<?php
/**
 * Created by HanGang.
 * Date: 2017/11/12
 */

namespace App\Repositories;

use App\Models\Label;
use App\Models\Topic;

class LabelRepository extends BaseRepository
{
    protected $topic;

    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    /**
     * Get all label [Search by label name]
     *
     * @param $name
     * @return mixed
     */
    public function getAllLabels($name)
    {
        return Label::select(['id', 'name'])
            ->where('name', 'like', '%' . $name . '%')
            ->get();
    }

    public function getTopicsByLabel($label, $request, $pageSize = 20)
    {
        return $this->topic
            ->with('user')
            ->whereHas('labels', function($query) use ($label) {
                $query->where('label_id', $label->id);
            })
            ->paginate($pageSize);
    }
}