<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    public array $array;
    public ?string $style;

    /**
     * Breadcrumbs constructor.
     *
     * @param array $array
     * @param string|null $style
     */
    public function __construct(array $array, ?string $style = null)
    {
        $this->array = $array;
        $this->style = $style;
    }

    /**
     * Render the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        $items = collect($this->array);

        $firstItem = $items->shift();
        $lastItem = $items->last();

        return view('components.breadcrumbs', [
            'items' => $items,
            'style' => $this->style,
            'count' => $items->count(),
            'firstItem' => $firstItem,
            'lastItem' => array_key_last($this->array),
        ]);
    }
}
