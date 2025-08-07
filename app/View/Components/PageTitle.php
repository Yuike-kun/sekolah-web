<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageTitle extends Component
{
    public $pageTitle;

    public $pagePretitle;

    /**
     * Create a new component instance.
     */
    public function __construct($pageTitle, $pagePretitle)
    {
        $this->pageTitle = $pageTitle;
        $this->pagePretitle = $pagePretitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.page-title');
    }
}
