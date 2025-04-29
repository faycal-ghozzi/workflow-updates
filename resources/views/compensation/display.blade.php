@extends('layout.app')

@section('title', 'Consultation Compensation')

@section('content')
@php
    // Define role hierarchy (highest to lowest)
    $roleHierarchy = ['dg' => 5, 'risque' => 4, 'exploitation' => 3, 'chef' => 2, 'charge' => 1];

    // Config for modals per role
    $roleConfigs = [
        'dg' => ['title' => "Décision DG", 'action' => '/viewCompensation/avis_avec_decision_dg', 'decisionName' => 'decision'],
        'risque' => ['title' => "Arbitrage Risque", 'action' => '/viewCompensation/avis_avec_arbitrage_risque', 'decisionName' => 'decisionRisque'],
        'exploitation' => ['title' => "Arbitrage Exploitation", 'action' => '/viewCompensation/avis_avec_arbitrage_exploitation', 'decisionName' => 'decisionExp'],
        'chef' => ['title' => "Arbitrage Chef d'agence", 'action' => '/viewCompensation/avis_avec_arbitrage_chef', 'decisionName' => 'decision'],
        'charge' => ['title' => "Avis Chargé", 'action' => '/viewCompensation/avis_charge', 'decisionName' => 'decision'],
    ];

    // Determine highest available role for authenticated user
    $userRoles = collect(array_keys($roleHierarchy))
                    ->filter(fn($r) => Auth::user()->hasRole($r));

    $highestRole = $userRoles->sortByDesc(fn($r) => $roleHierarchy[$r])->first();
    $config = $highestRole ? $roleConfigs[$highestRole] : null;

    // Enforce previous step validation
    $previousRole = array_search($highestRole, array_keys($roleHierarchy)) + 1;
    $requiresValidation = isset(array_keys($roleHierarchy)[$previousRole]) &&
                          !Auth::user()->hasRole(array_keys($roleHierarchy)[$previousRole]);
@endphp

<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-4">Consultation Compensation</h5>

            <!-- Display info as readonly -->
            <div class="mb-3">
                <label class="form-label">Client</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->client_name ?? 'Non spécifié' }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Montant</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->montant ?? 'Non spécifié' }}">
            </div>

            @if ($config && !$requiresValidation)
                <button class="btn btn-primary" data-toggle="modal" data-target="#modal_role_{{ $view_comp->id }}">
                    {{ $config['title'] }}
                </button>
            @elseif ($requiresValidation)
                <div class="alert alert-warning">
                    Vous devez d'abord valider en tant que rôle inférieur avant d'agir comme <strong>{{ strtoupper($highestRole) }}</strong>.
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal -->
@if ($config && !$requiresValidation)
<div class="modal fade" id="modal_role_{{ $view_comp->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-sm">
            <div class="modal-header">
                <h5 class="modal-title">{{ $config['title'] }}</h5>
                <button type="button" class="close btn" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="POST" action="{{ url($config['action']) }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="compensation_id" value="{{ $view_comp->id }}">
                    <div class="form-group">
                        <label for="text_avis">Votre avis</label>
                        <textarea class="form-control" name="text_avis" rows="4" placeholder="Saisissez votre avis..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="submit" name="{{ $config['decisionName'] }}" value="favorable" class="btn btn-success">Favorable</button>
                    <button type="submit" name="{{ $config['decisionName'] }}" value="defavorable" class="btn btn-danger">Défavorable</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
