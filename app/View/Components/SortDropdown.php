<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SortDropdown extends Component
{
    public $sortOptions;
    pubLIC $route;

    public function __construct($sortOptions, $route)
    {
        //
        $this->sortOptions = $sortOptions;
        $this->route = $route;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sort-dropdown');
    }
}
