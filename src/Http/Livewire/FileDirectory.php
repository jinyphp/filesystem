<?php
/**
 * 파일목록 출력하기
 */
namespace Jiny\Filesystem\Http\Livewire;

use Livewire\Component;

class FileDirectory extends Component
{
    use \Jiny\Table\Http\Livewire\Permit;
    public $actions;
    public $path;

    public function mount()
    {
        $this->permitCheck();

    }

    public function render()
    {
        if($this->permit['read']) {
            //dd($this->path);
            $directory = xDirTree( xScanDir( $this->path ) );
            $directory->setAttribute("data-path", $this->path);



            $directory = $this->setDeleteLink($directory);

            return view("jinyfile::livewire.directory", ['directory'=>$directory]);
        }

        // 권한 접속 실패
        return view("jinytable::error.permit",[
            'actions'=>$this->actions
        ]);
    }

    protected $listeners = ['refeshTable'];
    public function refeshTable()
    {
        ## 페이지를 재갱신 합니다.
    }

    private function setDeleteLink($obj) {

        return $obj;
    }

    /** ----- ----- ----- ----- -----
     *  delete
     */

    # 선택삭제 팝업창
    public $popupDelete = false;
    public function popupDeleteClose()
    {
        // 삭제 확인창을 닫기
        $this->popupDelete = false;
    }

    public $delete_filepath;
    public function delete($path)
    {
        //dd($this->permit);
        if($this->permit['delete']) {
            $this->popupDelete = true;
            $this->delete_filepath = $path;
        } else {
            $this->popupPermitOpen();
        }
    }

    public function condfirmDelete()
    {
        unlink($this->delete_filepath);
        // dd($this->delete_filepath);
        $this->popupDeleteClose();
    }



}
