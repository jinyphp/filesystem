<?php

namespace Jiny\Filesystem\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function __construct()
    {

    }

    public function dropzone(Request $requet)
    {
        $uploaded = [];

        if($_POST['path']) {
            $path = base_path($_POST['path']);
        } else {
            // 경로가 없는 경우, 기본 public/uploads
            $path = public_path("uploads");
        }

        // 경로패스 토큰 변경
        $path = str_replace("/",DIRECTORY_SEPARATOR,$path);

        if (!is_dir($path)) mkdir($path, 755, true);

        if (!empty($_FILES['file']['name'][0])) {
            foreach ($_FILES['file']['name'] as $pos => $name) {

                $source = $_FILES['file']['tmp_name'][$pos];
                $filename = $path.DIRECTORY_SEPARATOR.$name;
                $filename = str_replace(DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR, $filename);

                if( move_uploaded_file($source, $filename) ){
                    $uploaded []= [
                        'name' =>$name,
                        'file' => $filename
                    ];
                }
            }
        }

        return response()->json($uploaded);
    }





}
