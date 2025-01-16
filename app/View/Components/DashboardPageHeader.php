<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardPageHeader extends Component
{
    public $title;
    public $dashboardUrl;
    public $studentId;
    public $style;

    /**
     * Create a new component instance.
     *
     * @param string $title
     * @param string $dashboardUrl
     * @param string|null $studentId
     */
    public function __construct($title, $dashboardUrl, $studentId = null, $style = null)
    {
        $this->title = $title;
        $this->dashboardUrl = $dashboardUrl;
        $this->studentId = $studentId;
        $this->style = $style;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-page-header');
    }
}
