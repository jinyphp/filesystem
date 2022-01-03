<?php
/**
 *
 */
namespace Jiny\Filesystem\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

use Jiny\Table\Http\Controllers\ResourceController;
class JsonController extends ResourceController
{
    /*
    use \Jiny\Table\Http\Controllers\SetMenu;

    // 리소스 저장경로
    const PATH = "actions";
    //const MENU_PATH = "menus";
    protected $actions = [];

    public function __construct()
    {
        ## 라우트정보
        $routename = Route::currentRouteName();
        $uri = Route::current()->uri;

        $this->actions['route']['uri'] = $uri;
        $this->actions['routename'] = substr($routename,0,strrpos($routename,'.'));
        $this->actions['route']['name'] = $this->actions['routename'];
    }
    */

    public function __construct()
    {
        parent::__construct();
        $this->setVisit($this);


        $this->actions['view_main'] = "jinyfile::admin.json.main";

    }

    public function index(Request $request, ...$slug)
    {
        // 서브경로를 추가합니다.
        $this->actions['slug'] = implode("/",$slug);
        //dd($this->actions['slug']);

        return parent::index($request);
    }

    /*
    public function index(Request $request)
    {
        return view("jinyfile::admin.json.main",['actions'=>$this->actions]);
    }
    */



}
