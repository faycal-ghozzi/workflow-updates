@extends('layout.app')

@section('title', 'Nouvelle Fiche Compensation')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4 text-center text-primary">
            Demande de création d'une fiche de compensation
        </h2>

        <div class="d-flex justify-content-center align-items-center mb-3">
            <label for="accountNumber" class="form-label me-2">Numéro de Compte</label>
            <input type="text" class="form-control w-auto" id="accountNumber" placeholder="Entrez le numéro de compte" maxlength="10">
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="clientModalLabel">Résultat de la recherche</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body text-center">
                <div id="modalMessage" class="mb-3"></div>

                <!-- Client code container, hidden by default -->
                <div class="d-flex justify-content-center mb-3" id="clientCodeContainer" style="display:none;">
                    <p id="clientCode" class="form-control-plaintext fs-5 text-primary" style="max-width: 300px;"></p>
                </div>

                <!-- Rechercher Client button, hidden by default -->
                <div class="d-flex justify-content-center mt-3" id="modalSearchButtonContainer" style="display:none;">
                    <button id="modalSearchButton" class="btn btn-success">
                        <i class="bi bi-search"></i> Rechercher Client
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @vite('resources/js/compensation/client-infos.js');
@endpush