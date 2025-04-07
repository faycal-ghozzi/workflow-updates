<?php

namespace App\Helpers;

class StatusHelper
{
    public static function getStatusLabel($status)
    {
        $statusLabels = [
            1 => ['label' => __('En Attente'), 'badge' => 'warning'],
            2 => ['label' => __('Acceptée'), 'badge' => 'success'],
            3 => ['label' => __('Refusée'), 'badge' => 'danger'],
            4 => ['label' => __('Avis favorable par chargé'), 'badge' => 'success'],
            5 => ['label' => __('Avis défavorable par chargé'), 'badge' => 'danger'],
            6 => ['label' => __('Avis défavorable par chef d\'agence'), 'badge' => 'danger'],
            7 => ['label' => __('Avis favorable par chef d\'agence'), 'badge' => 'success'],
            8 => ['label' => __('Avis défavorable par exploitation corporate'), 'badge' => 'danger'],
            9 => ['label' => __('Avis favorable par exploitation corporate'), 'badge' => 'success'],
            10 => ['label' => __('Avis défavorable par exploitation corporate et particulier'), 'badge' => 'danger'],
            11 => ['label' => __('Avis favorable par exploitation corporate et particulier'), 'badge' => 'success'],
            12 => ['label' => __('Refusé par exploitation'), 'badge' => 'danger'],
            13 => ['label' => __('Avis favorable par exploitation'), 'badge' => 'success'],
            14 => ['label' => __('Avis défavorable par risque'), 'badge' => 'danger'],
            15 => ['label' => __('Avis favorable par risque'), 'badge' => 'success'],
            16 => ['label' => __('Avis défavorable par direction générale'), 'badge' => 'danger'],
            17 => ['label' => __('Avis favorable par direction générale'), 'badge' => 'success'],
            18 => ['label' => __('Avis défavorable par DGA'), 'badge' => 'danger'],
            19 => ['label' => __('Avis favorable par DGA'), 'badge' => 'success'],
            20 => ['label' => __('Avis favorable par chef d\'agence suite à un arbitrage'), 'badge' => 'success'],
            21 => ['label' => __('Avis défavorable par chef d\'agence suite à un arbitrage'), 'badge' => 'danger'],
            22 => ['label' => __('Avis favorable par exploitation suite à un arbitrage'), 'badge' => 'success'],
            23 => ['label' => __('Avis défavorable par exploitation suite à un arbitrage'), 'badge' => 'danger'],
            24 => ['label' => __('Avis défavorable par risque suite à un arbitrage'), 'badge' => 'danger'],
            25 => ['label' => __('Avis favorable par risque suite à un arbitrage'), 'badge' => 'success'],
        ];

        return $statusLabels[$status] ?? null;
    }
}
