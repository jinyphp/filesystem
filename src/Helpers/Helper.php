<?php
use \Jiny\Html\CTag;


/**
 * 재귀적 디렉터리 구조를 스켄하는 함수
 */
if(!function_exists("xScanDir")) {
    function xScanDir($path, $except=[]) {
        $except=['.','..','.git'];

        $base = base_path($path);


        $files = [];
        foreach (scandir($base) as $item) {
            // 제외 폴더 및 파일 처리
            foreach($except as $name) {
                if($item == $name) continue(2);
            }

            // 디렉터리 검사
            if(is_dir($base.DIRECTORY_SEPARATOR.$item)) {
                $files []= [
                    'name'=>$item,
                    'path'=>$path.DIRECTORY_SEPARATOR.$item,
                    'sub'=>xScanDir($path.DIRECTORY_SEPARATOR.$item)
                ];
            } else {

                $files []= [
                    'name'=>$item,
                    'path'=>$path.DIRECTORY_SEPARATOR.$item
                ];
            }
        }

        return $files;
    }
}


