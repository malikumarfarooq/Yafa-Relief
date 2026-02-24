<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    /**
     * Create a new component instance.
     */
    public string $pageTitle;

    public string $breadcrumb;

    public string $tabTitle;

    public function __construct(string $pageTitle = '', string $breadcrumb = '', string $tabTitle = 'Dashboard')
    {
        $this->pageTitle = $pageTitle;
        $this->breadcrumb = $breadcrumb;
        $this->tabTitle = $tabTitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.layout');
    }
}
