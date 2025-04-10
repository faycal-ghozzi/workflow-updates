@extends('layout.app')

@section('title', 'État Journalier')

@section('content')
<div class="container mt-4">

    <h4 class="mb-3">
        État Journalier
    </h4>

    <div class="table-responsive">
        <table id="liste-compensation" class="table table-bordered table-striped table-sm">
            <thead class="table-dark">
                <tr>
                    <th>Code client</th>
                    <th>Num compte</th>
                    <th>Nom client</th>
                    <th>Secteur</th>
                    <th>Classement</th>
                    <th>Solde actuel</th>
                    <th>Date de création</th>
                    <th>Date de validation</th>
                    <th>Agence</th>
                    <th>Total débit (compensation + impayé à payer)</th>
                    <th>Status</th>
                    <th>Dernier avis</th>
                </tr>
            </thead>
        </table>
    </div>

</div>
@endsection

@push('scripts')
    @vite('resources/js/compensation.js')
@endpush
