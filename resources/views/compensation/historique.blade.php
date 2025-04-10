@extends('layout.app')

@section('title', 'Historique des Compensations')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">
        @if($hasAgency)
            Historique compensations de votre agence
        @else
            Toutes les historiques des compensations
        @endif
    </h4>

    <div class="mb-4">
        <strong>Total :</strong> {{ $counts->total }} |
        <span class="text-warning">🕓 Attente : {{ $counts->attent }}</span> |
        <span class="text-success">✔ Accepté : {{ $counts->accept }}</span> |
        <span class="text-danger">❌ Refusé : {{ $counts->refuse }}</span>
    </div>

    <div class="table-responsive">
        <table id="historique-compensation" class="table table-bordered table-striped table-sm">
            <thead class="table-dark">
                <tr>
                    <th>Client</th>
                    <th>Nom / Raison sociale</th>
                    <th>Date</th>
                    <th>Agence</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('scripts')
    @vite(['resources/js/compensation.js'])
@endpush
