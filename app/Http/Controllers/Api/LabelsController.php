<?php
/**
 * Created by HanGang.
 * Date: 2017/11/28
 */

namespace app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\LabelRepository;

class LabelsController extends Controller
{
    protected $label;

    public function __construct(LabelRepository $label)
    {
        $this->label = $label;
    }

    public function index()
    {
        return $this->label->getAllLabels(request('q'));
    }
}