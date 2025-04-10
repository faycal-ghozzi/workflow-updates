@extends('layout.app')

@section('title', 'État Journalier')

@section('content')
<div class="container mt-4">

    <h4 class="mb-3">
        Extrait
    </h4>

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
