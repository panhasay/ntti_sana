<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardDepartment extends Component
{
    /**
     * url
     *
     * @var mixed
     */
    public $url;
    public $image;
    public $alt;
    public $title;
    /**
     * __construct
     *
     * @param  mixed $url
     * @param  mixed $image
     * @param  mixed $alt
     * @param  mixed $title
     * @return void
     */
    public function __construct($url, $image, $alt, $title)
    {
        $this->url = $url;
        $this->image = $image;
        $this->alt = $alt;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-department');
    }
}
