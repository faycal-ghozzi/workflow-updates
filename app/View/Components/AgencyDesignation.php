<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AgencyDesignation extends Component
{

    public $agenceId;

    /**
     * Create a new component instance.
     */
    public function __construct($agenceId)
    {
        $this->agenceId = $agenceId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $agencies = [
            1 => 'BTL agence Tunis',
            3 => 'BTL agence Sfax',
            4 => 'BTL agence Nabeul',
            5 => 'BTL agence Petite Ariana',
            6 => 'BTL agence Ben Arous',
            7 => 'BTL agence Den Den',
            8 => 'BTL agence Sousse',
            9 => 'BTL agence Gabes',
            11 => 'BTL agence Sfax ELBOSTENE',
            12 => 'BTL agence Bizerte',
            13 => 'BTL agence Nabeul 2',
            14 => 'BTL agence Mednine',
            15 => 'BTL agence Monastir',
            16 => 'BTL agence Centre Urbain Nord',
            17 => 'BTL agence Enasr',
            18 => 'BTL agence Ariana',
            19 => 'BTL agence Lac 2',
            20 => 'BTL agence Aouina',
            22 => 'BTL agence Marsa',
            23 => 'BTL agence Djerba',
            24 => 'BTL agence Megrine'
        ];

        $agenceName = isset($agencies[$this->agenceId]) ? $agencies[$this->agenceId] : null;
        
        return view('components.agency-designation', compact('agenceName'));
    }
}
