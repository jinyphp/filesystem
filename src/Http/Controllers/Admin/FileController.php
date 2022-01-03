<?php

namespace Jiny\Filesystem\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

use Jiny\Table\Http\Controllers\ResourceController;
class FileController extends ResourceController
{
    public function __construct()
    {
        parent::__construct();
        $this->setVisit($this);


        $this->actions['view_main'] = "jinyfile::admin.explore.main";

    }

    public function index(Request $request, ...$slug)
    {
        // 서브경로를 추가합니다.
        $this->actions['slug'] = implode("/",$slug);
        return parent::index($request);
    }

}
