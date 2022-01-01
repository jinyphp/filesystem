<?php
/**
 * 파일목록 출력하기
 */
namespace Jiny\Filesystem\Http\Livewire;

use Livewire\Component;
use Jiny\Filesystem\Directory;

class FileManager extends Component
{
    use \Jiny\Table\Http\Livewire\Permit;
    public $actions;
    public $path;

    public function mount()
    {
        // 권환체크
        $this->permitCheck();
    }

    public function render()
    {
        // 읽기 권한 체크
        if($this->permit['read']) {

            $directory = (new Directory($this->path))->scan()->html();
            $directory->setAttribute("data-path", $this->path);



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

    /** ----- ----- ----- ----- -----
     *  create : 디렉터리 생성
     */
    public $popupForm = false;
    public $form;
    public $filepath;
    public function create($path)
    {
        $this->filepath = $path;
        $this->popupForm = true;
        $this->form = "";
    }

    public function popupFormClose()
    {
        $this->popupForm = false;
    }

    public function store()
    {
        $filename = base_path().$this->filepath.DIRECTORY_SEPARATOR.$this->form;
        if(!file_exists($filename)) {
            mkdir($filename,755,true);
        }
        $this->popupForm = false;
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


    public function delete($path)
    {
        //dd($this->permit);
        if($this->permit['delete']) {
            $this->popupDelete = true;
            $this->filepath = $path;
        } else {
            $this->popupPermitOpen();
        }
    }

    public function condfirmDelete()
    {
        $filename = base_path().$this->filepath;
        if(file_exists($filename)) {
            unlink($filename);
        }

        $this->popupDeleteClose();
    }



}
