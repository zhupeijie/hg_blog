<?php
/**
 * Created by HanGang.
 * Date: 2017/12/14
 */

namespace app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Repositories\TopicRepository;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    protected $topic;

    public function __construct(TopicRepository $topic)
    {
        $this->topic = $topic;
    }

    public function index(Request $request)
    {
        return $this->topic->getAllTopicsWithAuthor($request);
    }

    public function show(Topic $topic)
    {
        return $topic;
    }
}