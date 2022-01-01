<?php
namespace Jiny\Filesystem;

use \Jiny\Html\CTag;

// 디렉터리를 Html Ul 테그로 생성합니다.
class Directory
{
    public $dir=[];
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

        if(file_exists($this->path) && is_dir($this->path)) {
            $this->dir = xScanDir($this->path);
        }
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
        $ul = xUl();
        $li = xLi();
        foreach($tree as $item) {
            $_li = clone $li;
            $_li->addItem($this->item($item));

            // 서브디렉터리 재귀호출
            if(isset($item['sub'])) {
                $sub = $this->makeTree($item['sub']);
                $sub->addItem($this->addDropzone($item));
                $_li->addItem( $sub );
            }

            $ul->addItem($_li);
        }

        return $ul;
    }

    // 출력형태 지정
    public function item($item)
    {
        $info = pathinfo( base_path().$item['path'] );
        $left = $this->itemLeft($item, $info);
        $right = $this->itemRight($item, $info);

        $flex = xDiv();
        $flex->addItem($left);
        $flex->addItem($right);

        return $flex->addClass("flex justify-between");
    }

    public function itemLeft($item, $info)
    {
        $left = xDiv();

        // 삭제버튼
        if(isset($item['sub'])) {
            // 디렉터리
            // 서브 디렉터리 추가버튼 설정
            $left->addItem($this->btnCreate($item));
            $left->addItem($this->btnEdit($item));

            // 서브폴더가 비어 있는 경우, 삭제 버튼 활성화
            if(empty($item['sub'])) {
                $left->addItem($this->btnDelete($item));
            }

        } else {
            // 파일 삭제 버튼
            $line1 = xDiv()
                ->addItem($this->btnEdit($item))
                ->addItem($this->btnDelete($item));

            $line2 = xDiv()
                ->addItem(
                    xSpan(date("Y-M-D H:i:s",filemtime(base_path().$item['path'])))
                    ->addClass("text-gray-500 text-xs pr-2")
                )
                ->addItem($this->btnDownload($item))
                ->addItem($this->btnPermit($item));


            $left->addItem($line1);
            $left->addItem($line2);
        }

        return $left;
    }

    public function itemRight($item, $info)
    {
        $right = xDiv();
        return $right;
    }

    public function btnPermit($item)
    {
        $link = (new CTag('a',true))
                    ->addItem('Permit')
                    //->setAttribute('href', "javascript: void(0);")
                    ->setAttribute("wire:click","setPermit('".str_replace("\\","/",$item['path'])."')");
        $link->addClass("text-violet-500 text-xs pr-2");
        return $link;
    }


    public function btnDownload($item)
    {
        $link = (new CTag('a',true))
                    ->addItem('download')
                    //->setAttribute('href', "javascript: void(0);")
                    ->setAttribute("wire:click","export('".str_replace("\\","/",$item['path'])."')");
        $link->addClass("text-green-500 text-xs pr-2");
        return $link;
    }

    public function btnEdit($item)
    {
        return (new CTag('a',true))
        ->addItem($item['name'])
        ->setAttribute('href', "javascript: void(0);")
        ->setAttribute("wire:click","edit('".str_replace("\\","/",$item['path'])."')");
    }

    public function btnCreate($item)
    {
        $icon_folder_add = xIcon("folder-plus")->setType("bootstrap")->setClass("h-4 w-4 inline-block");

        return (new CTag('a',true))
            ->addItem(xSpan($icon_folder_add)->addClass("px-2"))
            ->setAttribute("wire:click","create('".str_replace("\\","/",$item['path'])."')");
    }

    public function btnDelete($item)
    {
        return (new CTag('a',true))
            ->addItem(xIcon("x")->setType("bootstrap")->setClass("h-3 w-3 inline-block text-red-600"))
            ->setAttribute("wire:click","delete('".str_replace("\\","/",$item['path'])."')");
    }


    private function addDropzone($item)
    {
        $li = xLi();
        $path = $this->resolvePath($item['path']);
        $li->addClass("dropzone");
        $li->setAttribute("data-path", $path."/".$item['name']);
        $li->addItem("+ 여기에 파일을 올려 놓으세요.");

        return $li;
    }

    private function resolvePath($path)
    {
        $path = str_replace("\\","/", $path);
        return substr($path, 0, strrpos($path,'/')); // 디렉터리만 추출
    }
}
