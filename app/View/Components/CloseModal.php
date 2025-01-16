<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CloseModal extends Component
{
    public $class;
    public $label;
    public $dismiss;
    public $btn;
    /**
     * Create a new component instance.
     */
    public function __construct($label = 'Close', $class = 'btn btn-secondary', $dismiss = 'modal', $btn = '')
    {
        $this->label = $label;
        $this->class = $class;
        $this->dismiss = $dismiss;
        $this->btn = $btn;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.close-modal');
    }
}
