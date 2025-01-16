<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CancelButton extends Component
{
    public $class;
    public $label;
    public $dismiss;
    /**
     * Create a new component instance.
     *
     * @param string $label
     * @param string $class
     * @param string $dismiss
     */
    public function __construct($label = 'បិទ', $class = 'btn-outline-danger', $dismiss = 'modal')
    {
        $this->label = $label;
        $this->class = $class;
        $this->dismiss = $dismiss;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cancel-button');
    }
}
