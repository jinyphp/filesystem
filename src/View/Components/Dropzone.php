<?php

namespace Jiny\Filesystem\View\Components;

use Illuminate\View\Component;

/**
 * dropzone 영역을 설정하는 컴포넌트
 */
class Dropzone extends Component
{
    public $path;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($path=null)
    {
        $this->path = $path;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('jinyfile::components.'.'dropzone');
    }
}
