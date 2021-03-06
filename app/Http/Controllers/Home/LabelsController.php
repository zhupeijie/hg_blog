<?php
/**
 * Created by HanGang.
 * Date: 2017/12/10
 */

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Label;
use App\Models\User;
use App\Repositories\LabelRepository;
use App\Repositories\TopicRepository;
use Request;

class LabelsController extends Controller
{
    protected $label;
    protected $topic;

    public function __construct(LabelRepository $label, TopicRepository $topic)
    {
        $this->label = $label;
        $this->topic = $topic;
    }

    public function show(Label $label, Request $request, User $user)
    {
        $topics = $this->label->getTopicsByLabel($label, $request);
        $activeUsers = $user->getActiveUsers();

        return view('home.topics.index', compact('topics', 'label', 'activeUsers'));
    }
}