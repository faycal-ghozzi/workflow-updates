@extends('layout.app')

@section('title', 'État Journalier')

@section('content')
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">État Journalier des Compensations</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="liste-etat-journalier" class="table table-bordered table-striped table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Code client</th>
                            <th>Num compte</th>
                            <th>Nom client</th>
                            <th>Secteur</th>
                            <th>Classement</th>
                            <th>Solde actuel</th>
                            <th>Date de création</th>
                            <th>Date de validation</th>
                            <th>Agence</th>
                            <th>Total débit</th>
                            <th>Status</th>
                            <th>Dernier avis</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @vite('resources/js/compensation.js')
@endpush