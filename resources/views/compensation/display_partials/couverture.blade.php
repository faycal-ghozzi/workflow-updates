<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Couverture</h5>
    </div>
    <div class="card-body">
        @if (!empty($view_compte->cheque_encours))
            <div class="row">
                <div class="col-3">
                    <label class="form-label fw-bold">Encours chèque :</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->cheque_encours}}" name="cheque_encours" id="cheque_encours">
                </div>
                <div class="col-3">
                    <label class="form-label fw-bold">Devise d'encours chèque :</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->cheque_encours_devise}}" name="cheque_encours_devise" id="cheque_encours_devise">
                </div>    
                <div class="col-3">
                    <label class="form-label fw-bold">Date d'encaissement :</label>
                    <div class="input-group date" id="dateExp" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#dateExp" name="cheque_encours_date" value="{{ !empty($view_comp->cheque_encours_date) ? $view_comp->cheque_encours_date->format('d-m-Y') : 'jj-mm-aaaa' }}" readonly/>
                        <div class="input-group-append" data-target="#dateExp" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->cheque_encours}}" name="cheque_encours" id="cheque_encours">
                </div>
                <div class="col-3">
                    <label class="form-label fw-bold">Tiré :</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->cheque_encours_tire}}" name="cheque_encours_tire" id="cheque_encours_tire">
                </div>
            </div>
            <br>          
        @endif
        @if (!empty($view_comp->escompte_effet))
            <div class="row">
                <div class="col-3">
                    <label class="form-label fw-bold">Encours effet à l'encaissement :</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->escompte_effet}}" name="escompte_effet" id="escompte_effet">
                </div>
                <div class="col-3">
                    <label class="form-label fw-bold">Effet à l'escompte en cours d'étude :</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->encaissement_effet_etude}}" name="encaissement_effet_etude" id="encaissement_effet_etude">
                </div>
                <div class="col-3">
                    <label class="form-label fw-bold">Effet à l'escompte en cours de validation :</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->encaissement_effet}}" name="encaissement_effet" id="encaissement_effet">
                </div>
                <div class="col-3">
                    <label class="form-label fw-bold">Versement Espèces :</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->versement}}" name="versement" id="versement">
                </div>
            </div>
            <br>
        @endif
        <div class="row">
            <div class="col-4">
                <label class="form-label fw-bold">Effet à l'escompte en cours d'étude :</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->encaissement_effet_etude}}" name="encaissement_effet_etude" id="encaissement_effet_etude">
            </div>
            <div class="col-4">
                <label class="form-label fw-bold">Effet à l'escompte en cours de validation :</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->encaissement_effet}}" name="encaissement_effet" id="encaissement_effet">
            </div>
            <div class="col-4">
                <label class="form-label fw-bold">Versement Espèces :</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->versement}}" name="versement" id="versement">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <label class="form-label fw-bold">Note Couverture :</label>
                <textarea type="text" rows="3" name="note_couverture" class="form-control " disabled>{{ $view_comp->note_couverture}}</textarea>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-6">
                <center>
                    <label class="form-label fw-bold">Promesses</label>
                </center>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm">
                            <thead class="table-dark">
                                <th>Justifications</th>
                                <th>Montant</th>
                            </thead>
                            <tbody>
                                @foreach($view_comp->justification_comp as $item)
                                <tr>
                                    <td>{!! nl2br(htmlspecialchars($item->name_justification_update, ENT_NOQUOTES)) !!}</td>
                                    <td>{{ $item->value }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <input type="hidden" class="form-control" id="justification" name="justification" value="{{ $view_comp->justification }}" readonly/>
            </div>
            <div class="col-6">
                <center>
                    <label class="form-label fw-bold">Impayé à régler</label>
                </center>
                <div class="row g-1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm">
                            <thead class="table-dark">
                                <th>Nature</th>
                                <th>Montant</th>
                                <th>Devise</th>
                            </thead>
                            <tbody>
                                @foreach ($view_comp->impaye_client as $imp)
                                <tr>
                                    <td>{{ $imp->nature_impaye }}</td>
                                    <td id="impa">{{ $imp->montant_impaye }}</td>
                                    <td>{{ $imp->devise_impaye }}</td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
                <input type="hidden" class="form-control" id="TOTAL_IMPAYE" value="{{ $impaye_client }}" readonly/>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-6">
            </div>
            <div class="col-6">
                <center>
                    <label class="form-label fw-bold">Compensation</label>
                </center>
                <div class="row g-1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm">
                            <thead class="table-dark">
                                <th>Type de transaction</th>
                                <th>Bénéficiaire</th>
                                <th>Montant</th>
                            </thead>
                            <tbody>
                                @foreach ($view_comp->detail_comp as $details)
                                <tr>
                                    <td>{{ $details->name }}</td>
                                    <td>{{ $details->beneficiare }}</td>
                                    <td>{{ $details->value }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" class="form-control" id="solde_compensation" name="solde_compensation" value="{{ $view_comp->val_compensation }}" readonly/>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="hidden" id="total_credit" class="form-control" readonly/>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label fw-bold text-danger">Total Débit : Compensation + Impayé à payer</label>
                    <input type="text" id="total_debit" class="form-control" readonly/>
                </div>
            </div>
        </div>
    </div>
</div>