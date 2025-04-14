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
            <form method="POST" action="{{ route('compensation.add_request') }}">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="clientModalLabel">Résultat de la recherche</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="modalMessage" class="mb-3"></div>
            
                    <div class="d-flex justify-content-center mb-3" id="clientCodeContainer" style="display:none;">
                        <input type="text" readonly id="clientCodeInput" name="client_code" 
                               class="form-control-plaintext fs-5 text-primary text-center" 
                               style="max-width: 300px; border: none; background: transparent;">
                    </div>
            
                    <!-- Hidden input for account number -->
                    <input type="hidden" id="accountNumberInput" name="account_number" value="">
            
                    <div class="d-flex justify-content-center mt-3" id="modalSearchButtonContainer" style="display:none;">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-search"></i> Rechercher Client
                        </button>
                    </div>
                </div>
            </form>            
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @vite('resources/js/compensation/client-infos.js');
@endpush