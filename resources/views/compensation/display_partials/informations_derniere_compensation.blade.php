<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Informations sur la dérniere compensation</h5>
    </div>
    <div class="card-body">
        @if (!empty($view_comp->date_der_comp))
            <div class="row g-4">
                <div class="col-3">
                    <label class="form-label fw-bold">Date :</label>
                    <input type="text" class="form-control-plaintext" readonly 
                        value="{{ $view_comp->date_der_comp ? $view_comp->date_der_comp->format('d-m-Y') : 'jj-mm-aaaa' }}">
                </div>
                <div class="col-3">
                    <label class="form-label fw-bold">Montant :</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->montant_der_comp}}" name="montant_der_comp" id="montant_der_comp">
                </div>
                <div class="col-3">
                    <label class="form-label fw-bold">Décision du comité :</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->decision_der_comp}}" name="decision_der_comp">
                </div>
                <div class="col-3">
                    <label class="form-label fw-bold">Respect des promesses faites :</label>
                    <div class="form-group">
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="respect_promet" id="respect_promet_oui" value="oui" @if($view_comp->respect_promet =='oui') checked @endif>
                            <label class="form-check-label">Oui</label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="respect_promet" id="respect_promet_non" value="non" @if($view_comp->respect_promet =='non') checked @endif>
                            <label class="form-check-label">Non</label>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Montant des promesses faites :</label>
                        <input type="text" id="montant_promesse" name="montant_promesse" class="form-control " value="{{ $view_comp->montant_promesse }}" disabled />
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Promesses faites :</label>
                        <textarea type="text" name="promesse_der_comp_update" class="form-control " disabled>{{ $view_comp->promesse_der_comp_update }}</textarea>
                    </div>
                </div>
            </div>
        @elseif(!empty($view_comp->derniere_compensation_justif))
            <div class="row g-4">
                <div class="col-3">
                    <label class="form-label fw-bold">Date :</label>
                    <input type="text" class="form-control-plaintext" readonly 
                        value="{{ $view_comp->date_der_comp_new }}">
                </div>
                <div class="col-3">
                    <label class="form-label fw-bold">Montant :</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->montant_der_comp}}" name="montant_der_comp" id="montant_der_comp">
                </div>
                <div class="col-3">
                    <label class="form-label fw-bold">Décision du comité :</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->decision_der_comp}}" name="decision_der_comp">
                </div>
                <div class="col-3">
                    <label class="form-label fw-bold">Respect des promesses faites :</label>
                    <div class="form-group">
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="respect_promet" id="respect_promet_oui" value="oui" @if($view_comp->respect_promet =='oui') checked @endif>
                            <label class="form-check-label">Oui</label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="respect_promet" id="respect_promet_non" value="non" @if($view_comp->respect_promet =='non') checked @endif>
                            <label class="form-check-label">Non</label>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            @if (!empty($view_comp->derniere_compensation_justif[0]->valeur))
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead class="table-dark">
                                        <th>Promesse faites</th>
                                        <th>Montant</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($view_comp->derniere_compensation_justif as $item)
                                            <tr>
                                                <td>{!! nl2br(htmlspecialchars($item->promesse_new, ENT_NOQUOTES)) !!}</td>
                                                <td>{{ $item->valeur }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucune promesse faite.
                </div>
            @endif
        @endif
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label fw-bold">Note :</label>
                    <textarea type="text" name="note_der_comp_update" class="form-control " disabled>{!! nl2br(htmlspecialchars($view_comp->note_der_comp_update, ENT_NOQUOTES)) !!}</textarea>
                </div>
            </div>
        </div>    
    </div>
</div>