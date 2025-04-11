<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CompensationActionButtons extends Component
{

    public $comp;
    /**
     * Create a new component instance.
     */
    public function __construct($comp)
    {
        $this->comp = $comp;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.compensation-action-buttons');
    }
}
