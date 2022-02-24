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

        $this->actions['view_main'] = "jinyfile::admin.dropzone.main";

    }


}
