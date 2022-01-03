<?php

namespace Jiny\Filesystem\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

/**
 * 관리자 Actions Rule을 설정하는 팝업창 입니다.
 */
use Jiny\Table\Http\Livewire\SetActionRule;
class SetActionPath extends SetActionRule
{
    public function render()
    {
        return view("jinyfile::livewire.popup.setpath");
    }
}
