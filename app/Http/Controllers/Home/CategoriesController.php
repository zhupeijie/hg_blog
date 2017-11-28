<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Topic;
use App\Repositories\TopicRepository;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    protected $topic;

    public function __construct(TopicRepository $topic)
    {
        $this->topic = $topic;
    }


    public function show(Category $category, Request $request)
    {
        $topics = $this->topic->getTopicsWithCategories($category, $request);

        return view('home.topics.index', compact('topics', 'category'));
    }
}
