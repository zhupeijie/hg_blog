<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Topic;
use App\Models\User;
use App\Repositories\TopicRepository;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    protected $topic;

    public function __construct(TopicRepository $topic)
    {
        $this->topic = $topic;
    }

    public function show(Category $category, Request $request, User $user)
    {
        $topics = $this->topic->getTopicsByCategory($category, $request);
        $activeUsers = $user->getActiveUsers();

        return view('home.topics.index', compact('topics', 'category', 'activeUsers'));
    }
}
