@extends('layout.app')

@section('title', 'Consultation Compensation')

@section('content')
<div class="container-fluid">
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
        </div>
@endsection