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

        ##
        $this->actions['table'] = "site_theme_store"; // 테이블 정보
        $this->actions['paging'] = 10; // 페이지 기본값

        $this->actions['view_main'] = "jinyfile::admin.file.main";
        $this->actions['view_main_layout'] = "jinyfile::admin.file.main_layout";
        $this->actions['view_list'] = "jinyfile::admin.file.tile";
        $this->actions['view_form'] = "jinyfile::admin.file.form";
    }

    public function index(Request $request, ...$slug)
    {
        $this->actions['slug'] = implode("/",$slug);
        return parent::index($request);
    }

}
