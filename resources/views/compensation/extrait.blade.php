@extends('layout.app')

@section('title', 'État Journalier')

@section('content')
<div class="container mt-4">

    <h4 class="mb-3">
        Extrait
    </h4>

    <div class="row mb-3">
        <div class="col-md-3 d-flex align-items-end">
            <h3 class="form-label mb-0">Filtrer par date:</h3>
        </div>
        <div class="col-md-3">
            <label for="start_date" class="form-label">Date début</label>
            <input type="date" id="start_date" class="form-control">
        </div>
        <div class="col-md-3">
            <label for="end_date" class="form-label">Date fin</label>
            <input type="date" id="end_date" class="form-control">
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button id="filterBtn" class="btn btn-primary">Filtrer</button>
            <button id="resetBtn" class="btn btn-secondary ms-2">Réinitialiser</button>
        </div>
    </div>    

    <div class="table-responsive">
        <table id="liste-extrait" class="table table-bordered table-striped table-sm">
            <thead class="table-dark">
                <tr>
                    <th>Code client</th>
                    <th>Nom client</th>
                    <th>Date</th>
                    <th>Agence</th>
                    <th>Status</th>
                </tr>
            </thead>
        </table>
    </div>

</div>
@endsection

@push('scripts')
    @vite('resources/js/compensation.js')
@endpush
