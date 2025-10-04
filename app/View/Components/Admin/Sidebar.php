<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public $role;
    public $id_role;
    public $activeMenu;
    public $adminName;

    /**
     * Create a new component instance.
     */
    public function __construct($role = 'admin', $idRole = 1, $activeMenu = 'home', $adminName = 'Admin')
    {
        $this->role = $role;
        $this->id_role = $idRole;
        $this->activeMenu = $activeMenu == 'profil' ? 'profil' : $activeMenu;
        $this->adminName = $adminName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.sidebar');
    }
}
