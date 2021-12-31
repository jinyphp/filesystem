<?php

namespace Jiny\Filesystem\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

use Jiny\Table\Http\Controllers\ResourceController;
class DropzoneController extends ResourceController
{
    public function __construct()
    {
        parent::__construct();
        $this->setVisit($this);

        ##
        $this->actions['table'] = "site_theme_store"; // 테이블 정보
        $this->actions['paging'] = 10; // 페이지 기본값

        $this->actions['view_main'] = "jinyfile::admin.dropzone.main";
        $this->actions['view_main_layout'] = "jinyfile::admin.dropzone.main_layout";
        $this->actions['view_list'] = "jinyfile::admin.dropzone.tile";
        $this->actions['view_form'] = "jinyfile::admin.dropzone.form";
    }





}
