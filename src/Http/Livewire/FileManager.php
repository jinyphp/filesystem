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
    public $mode;
    public function create($path)
    {
        $this->mode = "create";

        $this->filepath = $path;
        $this->popupForm = true;
        $this->form = "";
    }

    public function popupFormClose()
    {
        $this->popupForm = false;
        $this->mode = "";
    }

    public function store()
    {
        $filename = base_path().$this->filepath.DIRECTORY_SEPARATOR.$this->form;
        if(!file_exists($filename)) {
            mkdir($filename,755,true);
            $this->dispatchBrowserEvent('dropzone', []);
        }

        $this->popupFormClose();
    }

    /** ----- ----- ----- ----- -----
     *  edit
     */

    public function edit($path)
    {
        $this->mode = "edit";

        $this->filepath = $path;
        $this->popupForm = true;

        // 파일, 디렉터리명만 추출
        $path = str_replace("\\","/", $path);
        $this->form = substr($path,strrpos($path,'/')+1);
    }

    public function update()
    {
        $path = str_replace("\\","/", $this->filepath);
        $path = substr($path,0,strrpos($path,'/'));

        $filename = base_path().$path.DIRECTORY_SEPARATOR.$this->form;

        if(!file_exists($filename)) {
            rename(base_path().$this->filepath, $filename);
        }
        $this->popupFormClose();
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

    public function editDelete()
    {
        $this->popupFormClose();
        $this->delete($this->filepath);
    }

    public function delete($path)
    {
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
            $this->unlinkAll($filename);
        }

        $this->popupDeleteClose();
    }

    public function unlinkAll($dir) {
        if(is_dir($dir)) {
            foreach( scandir($dir) as $file) {
                if($file == "." || $file == "..") continue;
                if(is_dir($dir.DIRECTORY_SEPARATOR.$file)) {
                    $this->unlinkAll($dir.DIRECTORY_SEPARATOR.$file);
                } else {
                    unlink($dir.DIRECTORY_SEPARATOR.$file);
                }
            }
            rmdir($dir);
        } else if(file_exists($dir)) {
            unlink($dir);
        }
    }

    public function export($path)
    {
        $filename = base_path().$path;
        return response()
            ->download($filename);
    }

}
