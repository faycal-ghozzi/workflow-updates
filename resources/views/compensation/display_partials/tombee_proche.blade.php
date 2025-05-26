<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Tombées Proches</h5>
    </div>
    <div class="card-body">
        @if(!empty($view_comp->nature_tombe))
            <div class="row g-4">
                <div class="col-3">
                    <label for="nature" class="form-label fw-bold">Nature :</label>
                    <input type="text" name="nature_tombe" class="form-control-plaintext" value="{{ $view_comp->nature_tombe }}" disabled>
                </div>
                <div class="col-3">
                    <label for="nature" class="form-label fw-bold">Montant :</label>
                    <input type="text" name="montant_tombe" id="montant_tombe" class="form-control-plaintext" value="{{ $view_comp->montant_tombe }}" disabled>
                </div>
                <div class="col-3">
                    <label for="nature" class="form-label fw-bold">Devise :</label>
                    <input type="text" name="devise_tombe" class="form-control-plaintext" value="{{ $view_comp->devise_tombe }}" disabled>
                </div>
                <div class="col-3">
                    <label for="nature" class="form-label fw-bold">Echéance :</label>
                    <input type="text" name="echeance_tombe" class="form-control-plaintext" value="{{ $view_comp->echeance_tombe }}" disabled>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucun tombée proche trouvée.
            </div>
        @endif
    </div>
</div>