<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class navUserView extends Component
{
    
    public $activeMenu;
    public $deg;
    /**
     * Create a new component instance.
     */
    public function __construct($activeMenu = 'dashboard', $deg)
    {
        $this->activeMenu = $activeMenu;
        $this->deg = $deg;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-user-view');
    }
}
