<?php

namespace Jiny\Filesystem\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function __construct()
    {

    }

    public function index(...$slug)
    {
        $path = implode("/",$slug);
        $filename = base_path()."/".$path;
        return response()->download($filename);
    }

}
