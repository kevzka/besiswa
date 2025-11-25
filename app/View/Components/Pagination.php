<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use function PHPUnit\Framework\isArray;

class Pagination extends Component
{
    /**
     * Create a new component instance.
     */
    public $type;
    public $dataNya = [];
    public function __construct($type = null, $dataNya = [])
    {
        $this->type = $type;
        $this->dataNya = isArray($dataNya) ? $dataNya : (array) $dataNya;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pagination');
    }
}
