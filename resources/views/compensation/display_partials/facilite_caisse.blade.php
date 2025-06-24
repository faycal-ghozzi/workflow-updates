<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Facilité de caisse</h5>
    </div>
    <div class="card-body">
        <div class="row g-4">
            <div class="col-3">
                <label class="form-label fw-bold">Autorisation par caisse :</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->valeur_decision}}" name="valeur_decision" id="valeur_decision">
            </div>
            <div class="col-3">
                <label class="form-label fw-bold">Utilisation :</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->autorisation}}" name="autorisation" id="autorisation">
            </div>
            <div class="col-3">
                <label class="form-label fw-bold">Disponible / Excess :</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->disponible_autorisation}}" name="disponible_autorisation" id="disponible_autorisation">
            </div>
            <div class="col-3">
                <label class="form-label fw-bold">Date d'expiration :</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->date_exp_decision ? $view_comp->date_exp_decision->format('d-m-Y') : $view_comp->date_exp_decision_new }}" name="autorisation_global" id="autorisation_global">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">
                <label class="form-label fw-bold">Solde Actuel :</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->solde_compensation }}" name="solde_actuel" id="solde_actuel">
            </div>
            <div class="col-4">
                <label class="form-label fw-bold">Compensation (Compensation + Impayé à payer) :</label>
                <input type="text" class="form-control" id="total_comp_edit" readonly/>
                <input type="hidden" class="form-control" value="{{ $view_comp->val_compensation +$impaye_client }}" id="total_comp" readonly/>
                <input type="hidden" class="form-control" value="{{ $view_comp->val_compensation}}" id="total_comp_comp" readonly/>
            </div>
            <div class="col-4">
                <label class="form-label fw-bold">Solde Après réglement :</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->solde_compensation - $view_comp->compensation_val }}" name="soldeApr" id="soldeApr">
            </div>
        </div>
    </div>
</div>        