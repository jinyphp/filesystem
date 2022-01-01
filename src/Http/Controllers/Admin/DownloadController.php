<?php

namespace Jiny\Filesystem\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DownloadController extends Controller
{
    public function __construct()
    {

    }

    public function index(...$slug)
    {
        $path = implode("/",$slug);
        $row = DB::table('download')->where('path',"/".$path)->first();
        //dd($row);
        if ($row) {
            if($row->permit) {
                $filename = base_path()."/".$path;
                return response()->download($filename);
            }
        }

        return "다운로드 권환이 없습니다.";

    }

}