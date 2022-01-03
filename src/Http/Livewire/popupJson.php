<?php

namespace Jiny\Filesystem\Http\Livewire;

use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Jiny\Action\Http\Livewire\LiveData;
use Jiny\Action\Http\Livewire\LiveTable;

use \Jiny\Html\CTag;

/**
 * explore에서 팝업창 형태로 json 파일을 수정합니다.
 */
class popupJson extends Component
{
    public $actions;
    public $form = [];
    public $json;

    public $popupJson=false;
    public function popupJsonClose()
    {
        $this->popupJson = false;
        $this->json = [];
        $this->form = [];
    }

    public function popupJsonOpen()
    {
        $this->popupJson = true;
    }

    public function render()
    {
        $keyName = $this->jsonKeytoDotName($this->form);
        $treeForm = $this->treeForms($keyName);

        return view("jinyfile::livewire.popup.json",[
            'treeForm'=>$treeForm,
            'filename'=>$this->filename
        ]);
    }

    public $filename;
    protected $listeners = ['editJson'];
    public function editJson($path)
    {
        $this->filename = $path;
        $this->jsonLoading();
        $this->popupJsonOpen();
    }


    public function jsonLoading()
    {
        $path = base_path().$this->filename;
        if(file_exists($path)) {
            $body = file_get_contents($path);
            $this->form = json_decode($body,true);
        }
    }


    public function jsonKeytoDotName($obj, $prev = "")
    {
        $key = [];
        foreach($obj as $k => $value) {
            if($prev) {
                $name = $prev.".".$k;
            } else {
                $name = $k;
            }

            if(is_array($value)) {
                $key[$k] = $this->jsonKeytoDotName($value, $name);
            } else {
                $key[$k] = $name;
            }
        }

        return $key;
    }

    public function treeForms($arr)
    {
        $ul = xUl();
        foreach($arr as $key => $value) {
            $li = xLi();

            if(is_array($value)) {
                $li->addItem($key);
                $li->addItem( $this->treeForms($value));
            } else {
                $li->addItem(
                    $this->HorizontalForm($key, $value)
                );
            }

            $ul->addItem($li);
        }
        return $ul;
    }

    public function HorizontalForm($key, $value)
    {
        $label = xLabel($key);
        $label->addClass("col-sm-2");
        $label->setAttribute('for',"password");

        $input = xInput();
        $input->setId("inputPassword");
        $input->setAttribute('type',"text");
        $input->setAttribute('wire:model.defer',"form.".$value);

        return xRow()
            ->addItem($label)
            ->addItem(
                xDiv()
                ->addItem($input)
                ->addClass("col-sm-10")
            );

    }

    public function jsonUpdate()
    {
        $path = base_path().$this->filename;
        $json = json_encode($this->form,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        file_put_contents($path, $json);

        $this->popupJsonClose();
    }


}
