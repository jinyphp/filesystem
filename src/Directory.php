<?php
/**
 * 디렉터리 목록을 HTML 테그로 생성합니다.
 */
namespace Jiny\Filesystem;

use \Jiny\Html\CTag;

class Directory
{
    public $dir=[];
    public $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    ## 출력 디렉터리 설정
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    ## 디렉터리 목록읽기
    public function scan($path=null)
    {
        if($path) $this->path = $path;

        $base = base_path().$this->path;
        if(file_exists($base) && is_dir($base)) {
            $this->dir = xScanDir($this->path);
        }
        return $this;
    }

    ## 생성목 html 목록을 출력합니다.
    public function html($tree=[])
    {
        // 데이터 초기화
        if(empty($tree)) $tree = $this->dir;

        // 재귀호출 트리 만들기
        $tree = $this->makeTree($tree);

        // dropzone 영역 추가하기
        $__li = xLi();
        $__li->addClass("dropzone");
        $__li->setAttribute("data-path", $this->path);
        $__li->addItem("+ 여기에 파일을 올려 놓으세요.");
        $tree->addItem($__li);

        return $tree;
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

    ## 목록셀 출력형태 지정
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
            // 이동버튼
            //$left->addItem($this->btnMove($item));

            // 디렉터리 생성버튼
            $left->addItem($this->btnCreate($item));

            // 수정버튼
            $left->addItem($this->btnEdit($item));

            // 서브폴더가 비어 있는 경우, 삭제 버튼 활성화
            if(empty($item['sub'])) {
                $left->addItem($this->btnDelete($item));
            }

            // 외부 이동링크
            $left->addItem( $this->btnExternal($item) );

        } else {
            // 파일 삭제 버튼
            $line1 = xDiv()
                ->addItem($this->btnEdit($item));

            // 수정버튼
            if($info['extension'] == "json") {
                $line1->addItem($this->btnModify($item));
            }

            $line1->addItem($this->btnDelete($item));


            $line2 = xDiv()
                ->addItem(
                    xSpan(date("Y-M-D H:i:s",filemtime(base_path().$item['path'])))
                    ->addClass("text-gray-500 text-xs pr-2")
                )
                ->addItem($this->btnDownload($item))
                ->addItem($this->btnPermit($item));

            $line2->addItem( $this->btnLinkCopy($item) );


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

    public function btnModify($item)
    {
        $icon = xSpan();
        $icon->addHtml('<svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>');
        $icon->addClass("px-2");

        $link = (new CTag('a',true))
                    ->addItem($icon)
                    ->setAttribute("wire:click","$"."emit('editJson', '".str_replace("\\","/",$item['path'])."')");
        //$link->addClass("text-xs pr-2");
        return $link;
    }





    public function btnMove($item)
    {
        $icon = xSpan();
        $icon->addHtml('<svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
        </svg>');

        return $icon;
    }

    private function btnLinkCopy($item)
    {
        $external = xSpan();
            $external->addHtml('<svg xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
            </svg>')->addClass("px-2");

        $link = (new CTag('a',true))
                ->addItem($external)
                ->setAttribute('title',"다운로드 주소 복사")
                ->setAttribute('onclick', "copy('".Route("download").str_replace("\\","/",$item['path'])."')");
        //dd($link);
        return $link;
    }

    public function btnExternal($item)
    {
        $external = xSpan();
            $external->addHtml('<svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
            </svg>')->addClass("px-2");

        $link = (new CTag('a',true))
                    ->addItem($external)
                    ->setAttribute('href', Route("admin.file.explore").str_replace($this->path,"",$item['path']));
        return $link;
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
