<?php
namespace Jiny\Filesystem;

use \Jiny\Html\CTag;

// 디렉터리를 Html Ul 테그로 생성합니다.
class Directory
{
    public $dir;
    public $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function scan($path=null)
    {
        if($path) $this->path = $path;

        $this->dir = xScanDir($this->path);
        return $this;
    }

    public function html($tree=[])
    {
        // 데이터 초기화
        if(empty($tree)) $tree = $this->dir;
        $ul = $this->makeTree($tree);

        $__li = xLi();
        $__li->addClass("dropzone");
        $__li->setAttribute("data-path", $this->path);
        $__li->addItem("+ 여기에 파일을 올려 놓으세요.");
        $ul->addItem($__li);

        return $ul;
    }

    public function makeTree($tree)
    {
        //dd($tree);

        $icon_folder_add = xIcon("folder-plus")->setType("bootstrap")->setClass("h-4 w-4 inline-block");

        $ul = xUl();
        $li = xLi();
        foreach($tree as $item) {
            $_li = clone $li;
            $_li->addItem($item['name']); // 이름등록

            // 삭제버튼
            if(isset($item['sub'])) {
                // 디렉터리
                // 서브 디렉터리 추가버튼 설정
                $create = (new CTag('a',true))
                    ->addItem($icon_folder_add)
                    ->setAttribute("wire:click","create('".str_replace("\\","/",$item['path'])."')");
                $_li->addItem($create);

                // 서브폴더가 비어 있는 경우, 삭제 버튼 활성화

                if(empty($item['sub'])) {
                    $_li->addItem(
                        (new CTag('a',true))
                        ->addItem(xIcon("x")->setType("bootstrap")->setClass("h-6 w-6"))
                        ->setAttribute("wire:click","delete('".str_replace("\\","/",$item['path'])."')")
                    );
                }


            } else {
                // 파일 삭제 버튼
                $_li->addItem(
                    (new CTag('a',true))
                    ->addItem(xIcon("x")->setType("bootstrap")->setClass("h-6 w-6"))
                    ->setAttribute("wire:click","delete('".str_replace("\\","/",$item['path'])."')")
                );
            }

            // 서브디렉터리 재귀호출
            if(isset($item['sub'])) {
                $sub = $this->makeTree($item['sub']);
                $sub->addItem($this->addDropzone($item));
                $_li->addItem( $sub );
            }

            $ul->addItem($_li);
        }

        // dropzone
        if(isset($item)) {
            //$ul->addItem($this->addDropzone($item));
        }


        return $ul;
    }


    private function addDropzone($item)
    {
        $__li = xLi();
        $path = $this->resolvePath($item['path']);
        $__li->addClass("dropzone");
        $__li->setAttribute("data-path", $path."/".$item['name']);
        $__li->addItem("+ 여기에 파일을 올려 놓으세요.");

        return $__li;
    }

    private function resolvePath($path)
    {
        $path = str_replace("\\","/", $path);
        return substr($path, 0, strrpos($path,'/')); // 디렉터리만 추출
    }
}
