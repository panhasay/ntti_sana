<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SaveChangeButton extends Component
{
    public $class;
    public $label;
    public $type;
    public $btn;
    public $value;
    /**
     * Create a new component instance.
     *
     * @param string $label
     * @param string $class
     * @param string $type
     */
    public function __construct($label = 'Save Changes', $class = 'btn-outline-primary', $type = 'submit', $btn = null, $value = null)
    {
        $this->label = $label;
        $this->class = $class;
        $this->type = $type;
        $this->btn = $btn;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.save-change-button');
    }
}
