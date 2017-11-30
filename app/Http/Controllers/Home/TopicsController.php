<?php

namespace App\Http\Controllers\Home;

use App\Models\Topic;
use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\TopicRepository;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    protected $topic;
    protected $category;

    public function __construct(TopicRepository $topic, CategoryRepository $category)
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->topic = $topic;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $topics = $this->topic->getAllTopicsWithAuthor($request);

        return view('home.topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->getAllCategories();

        return view('home.topics.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TopicRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicRequest $request)
    {
        $data = [
            'title'              => $request->get('title'),
            'body'               => $request->get('body'),
            'category_id'        => $request->get('category_id'),
        ];

        $topicId = $this->topic->create($data);

        flashy()->success('发布成功！');

        return redirect()->route('topics.show', [$topicId]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        return view('home.topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
