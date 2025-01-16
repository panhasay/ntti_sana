<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Module extends Component
{
    public $img, $url, $title;
    /**
     * Create a new component instance.
     */
    public function __construct($img, $url, $title)
    {
        $this->img = $img;
        $this->url = $url;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.module');
    }
}
