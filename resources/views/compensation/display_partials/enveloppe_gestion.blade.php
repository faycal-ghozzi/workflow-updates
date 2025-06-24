<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Enveloppe de crédits de gestion</h5>
    </div>
    <div class="card-body">
        <div class="row g-4">
            <div class="col-3">
                <label class="form-label fw-bold">Autorisation :</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->autorisation_global}}" name="autorisation_global" id="autorisation_global">
            </div>
            <div class="col-3">
                <label class="form-label fw-bold">Utilisation :</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->utilisation_global}}" name="utilisation_global" id="utilisation_global">
            </div>
            <div class="col-3">
                <label class="form-label fw-bold">Disponible / Excess :</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->disponible_global}}" name="disponible_global" id="disponible_global">
            </div>
            <div class="col-3">
                <label class="form-label fw-bold">Date d'expiration :</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->date_global ? $view_comp->date_global->format('d-m-Y') : $view_comp->date_global_new }}" name="autorisation_global" id="autorisation_global">
            </div>
        </div>
    </div>
</div>        