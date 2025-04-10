<?php

namespace App\Helpers;

class AgencyHelper
{
    /**
     * Get agency name based on the agency ID.
     *
     * @param int $agenceId
     * @return string
     */
    public function getAgencyName($agenceId)
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

        return isset($agencies[$agenceId]) ? $agencies[$agenceId] : 'Unknown Agency';
    }
}
