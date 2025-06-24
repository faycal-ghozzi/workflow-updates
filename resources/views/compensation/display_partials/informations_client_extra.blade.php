
<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Informations complémentaires sur le client</h5>
    </div>
    <div class="card-body">
        <div class="row g-4">
            <div class="col-3">
                <label class="form-label fw-bold">Autres sociétés :</label>
                <div class="form-group">
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="interdit_chq_ben" id="interdit_chq_ben_oui" value="oui" @if($view_comp->interdit_chq_ben =='oui') checked @endif>
                        <label class="form-check-label">Oui</label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="interdit_chq_ben" id="interdit_chq_ben_non" value="non" @if($view_comp->interdit_chq_ben =='non') checked @endif>
                        <label class="form-check-label">Non</label>
                    </div>
                </div>
            </div>
            @if ($view_comp->interdit_chq_ben === 'oui')
                <div class="col-3">
                    <label class="form-label fw-bold">Code :</label>
                    <input type="text" name="code_autre_sc" id="code_autre_sc" class="form-control" value="{{ $view_comp->code_autre_sc }}" disabled>
                </div>
                <div class="col-3">
                    <label class="form-label fw-bold">Nom :</label>
                    <input type="text" name="nom_autre_sc" id="nom_autre_sc" class="form-control" value="{{ $view_comp->nom_autre_sc }}" disabled>
                </div>
                <div class="col-3">
                    <label class="form-label fw-bold">Activité :</label>
                    <input type="text" name="activite_autre_sc" id="activite_autre_sc" class="form-control" value="{{ $view_comp->activite_autre_sc }}" disabled>
                </div>
            @endif
        </div>
        <div class="row g-2">
            <div class="col">
                <label class="form-label fw-bold">Situation des sociétés avec la banque :</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->situation_banque_ben}}" name="situation_banque_ben" id="situation_banque_ben" disabled>
            </div>
            <div class="col">
                <label class="form-label fw-bold">Situation du gérant et le client avec la banque :</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->situation_agent_benf}}" name="situation_agent_benf" id="situation_agent_benf" disabled>
            </div>
        </div>
    </div>
</div>