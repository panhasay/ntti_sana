<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalFirst extends Component
{
    public $id;
    public $title;
    public $size;
    public $centered;
    public $scrollable;
    public $fullscreen;
    public $class;
    public $footer;
    public function __construct(
        $id,
        $title,
        $size = null,
        $centered = false,
        $scrollable = false,
        $fullscreen = false,
        $class = '',
        $footer = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->size = $size;
        $this->centered = $centered;
        $this->scrollable = $scrollable;
        $this->fullscreen = $fullscreen;
        $this->class = $class;
        $this->footer = $footer;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal-first');
    }
}
