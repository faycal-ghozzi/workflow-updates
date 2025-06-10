@extends('layout.app')

@section('title', 'Consultation Compensation')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            @foreach ($modalConfigs as $key => $config)
                @include('components.avis-button', [
                    'role' => $config['role'],
                    'showIf' => $config['showIf'],
                    'key' => $key,
                    'compensation' => $view_comp
                ])
            @endforeach
        </div>
    </div>

    <div class="card card-default">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Consultation Compensation</h4>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-4">
                    <p>Chargé : {{ $view_comp->user_id }} - {{ $agencyHelper->getAgencyName(Auth::user()->agence_id) }}</p>
                </div>
                <div class="col-4"></div>
                <div class="col-4 text-end">
                    <p>Date : {{ $view_comp->date_compensation->format('d/m/Y') }}</p>
                </div>
            </div>
            <hr>
            @include('compensation.display_partials.informations_client', ['view_comp' => $view_comp])
            <hr>
            @include('compensation.display_partials.engagement_gerant_avec_banque', ['engagement_gerant' => $view_comp->engagement_gerant])
            <hr>
            @include('compensation.display_partials.encours_impaye_client', ['impaye_besoin' => $view_comp->impaye_besoin])
            <hr>
            @include('compensation.display_partials.impaye_leasing', ['impaye_leasing' => $view_comp->impaye_leasing])
            <hr>
            @include('compensation.display_partials.placement', ['placement' => $view_comp->placement_compensation])
            <hr>
            @include('compensation.display_partials.credits', ['credits' => $view_comp->credit_compensation])
            <hr>
            @include('compensation.display_partials.incidents', ['incidents' => $view_comp->incident_paiement_compensation])
            <hr>
            @include('compensation.display_partials.chiffre_affaires', ['ca_n_1' => $view_comp->chiffre_ans_preced, 'ca_n' => $view_comp->chiffre_ans_encours])
            <hr>
            @include('compensation.display_partials.situation_client', ['view_comp' => $view_comp])
            <hr>
            @include('compensation.display_partials.tombee_proche', ['view_comp' => $view_comp])
            <hr>
            @include('compensation.display_partials.tombee_proche_2w', ['tombe' => $tombe, 'decouvert' => $decouvert, 'tombe_compensation' => $view_comp->tombe_compensation])
        </div>

        @php
        $modalConfigs = [
            'charge' => [
                'role' => 'Charge',
                'label' => "chargé de clientèle",
                'action' => '/viewCompensation/avis_avec_decision_charge',
                'submitName' => 'decision',
                'showIf' => in_array($view_comp->status, [1]),
            ],
            'chef' => [
                'role' => 'Chef_agence',
                'label' => "chef d'agence",
                'action' => '/viewCompensation/avis_avec_decision_chef',
                'submitName' => 'decision',
                'showIf' => in_array($view_comp->status, [4, 5]),
            ],
            'exp_corporate' => [
                'role' => 'Exploitation_corporate',
                'label' => "Exploitation Corporate",
                'action' => '/viewCompensation/avis_avec_decision_exp_corporate',
                'submitName' => 'decision',
                'showIf' => in_array($view_comp->status, [6, 7]),
            ],
            'exp_particulier' => [
                'role' => 'Exploitation_particulier',
                'label' => "Exploitation Particulier",
                'action' => '/viewCompensation/avis_avec_decision_exp_particulier',
                'submitName' => 'decision',
                'showIf' => in_array($view_comp->status, [6, 7]),
            ],
            'exp' => [
                'role' => 'Exploitation_décideur',
                'label' => "Exploitation",
                'action' => '/viewCompensation/avis_avec_decision_exp',
                'submitName' => 'decision',
                'showIf' => in_array($view_comp->status, [8, 9, 10, 11, 20, 21]),
            ],
            'risque' => [
                'role' => 'Risque',
                'label' => "Risque",
                'action' => '/viewCompensation/avis_avec_decision_risque',
                'submitName' => 'decision',
                'showIf' => in_array($view_comp->status, [13, 22]),
            ],
            'dg' => [
                'role' => 'PDG', // or 'DGA'
                'label' => "Direction Générale",
                'action' => '/viewCompensation/avis_avec_decision_dg',
                'submitName' => 'decision',
                'showIf' => in_array($view_comp->status, [15, 24, 25]),
            ],
        ];
        @endphp
        
        @foreach ($modalConfigs as $key => $config)
            @if (Auth::user()->hasRole($config['role']) && $config['showIf'])
                @include('compensation.modals.decision', [
                    'role' => $key,
                    'label' => $config['label'],
                    'action' => $config['action'],
                    'submitName' => $config['submitName'],
                    'compensation' => $view_comp
                ])
            @endif
        @endforeach
@endsection