<?php
use \Jiny\Html\CTag;

if(!function_exists("xScanDir")) {
    function xScanDir($path, $except=[]) {
        $except=['.','..','.git'];

        //$base = public_path();

        $files = [];
        foreach (scandir($path) as $item) {
            foreach($except as $name) {
                if($item == $name) continue(2);
            }

            if(is_dir($path.DIRECTORY_SEPARATOR.$item)) {
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

        //dd($files);
        return $files;
    }
}

if(!function_exists("xDirTree")) {
    function xDirTree($tree)
    {
        $ul = new CTag('ul',true);
        $li = new CTag('li',true);
        foreach($tree as $item) {
            $_li = clone $li;
            $_li->addItem($item['name']);

            // 삭제버튼
            if(!isset($item['sub'])) {
                $_li->addItem(
                    (new CTag('a',true))
                    ->addItem(xIcon("x")->setType("bootstrap")->setClass("h-6 w-6"))
                    ->setAttribute("wire:click","delete('".str_replace("\\","/",$item['path'])."')")
                );
            }

            if(isset($item['sub'])) {
                $sub = xDirTree($item['sub']);

                $path = str_replace("\\","/", $item['path']);
                $path = substr($path, 0, strrpos($path,'/'));
                $sub->setAttribute("data-path", $path."/".$item['name']);

                $_li->addItem( $sub );
            }

            $ul->addItem($_li);
        }

        if (empty($tree)) {
            $_li = clone $li;
            $_li->addItem("+");
            $ul->addItem($_li);
        }
        // 추가 dropzone
        /*

        */



        $ul->addClass("dropzone");
        return $ul;
    }
}
