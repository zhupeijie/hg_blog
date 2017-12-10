<?php

namespace App\Http\Controllers\Home;

use App\Models\Category;
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
        $this->middleware('single.user.login')->only(['store','create','edit','update']);
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
        $topic = $this->topic->create($request->all());

        $labels = $this->topic->normalizeLabelOnCreate($request->get('labels'));
        $topic->labels()->attach($labels);

        $topic->user()->increment('topics_count');

        $topic->category()->increment('topics_count');

        flashy()->success('发布成功！');

        return redirect()->route('p.show', [hashIdEncode($topic->id)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = hashIdDecode($id)[0];
        $topic = $this->topic->getTopicById($id);

        $topic->increment('view_count');

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
        $id = hashIdDecode($id)[0];
        $topic = $this->topic->getTopicById($id);

        $this->authorize('update', $topic);
        $categories = $this->category->getAllCategories();

        return view('home.topics.edit', compact('topic', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TopicRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TopicRequest $request, $id)
    {
        $id = hashIdDecode($id)[0];
        /* @var $topic Topic */
        $topic = $this->topic->getTopicById($id);
        $this->authorize('update', $topic);

        $labels = $this->topic->normalizeLabelOnUpdate($request->get('labels'), $topic);

        $this->category->syncTopicsCount($topic, $request->get('category_id'));

        $this->topic->update($topic, $request->all());

        $topic->labels()->sync($labels);

        flashy()->success('发布成功！');

        return redirect()->route('p.show', [hashIdEncode($topic->id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = hashIdDecode($id)[0];
        $topic = $this->topic->getTopicById($id);
        $this->authorize('destroy', $topic);

        if ($this->topic->delete($topic)) {
            $this->topic->decTopicRelations($topic);

            flashy()->success('删除成功！');
        } else {
            flashy()->error('删除失败！');
        }

        return redirect()->route('p.index')->with('success', '成功删除！');
    }
}
