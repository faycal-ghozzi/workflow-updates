<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Informations Client</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <label class="form-label fw-bold">Code Client :</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->code_client }}" name="code_client">
            </div>
            <div class="col-3">
                <label class="form-label fw-bold">Numéro du compte :</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->account_number ?? '' }}" name="code_client">
            </div>
            <div class="col-3">
                <label class="form-label fw-bold">Client :</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->nom_client }}" name="code_client">
            </div>
            <div class="col-3">
                <label class="form-label fw-bold">Secteur :</label>
                <input type="text" class="form-control-plaintext" readonly value="{{ $view_comp->name_secteur }}" name="code_client">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3">
                <label for="activite_societe" class="form-label fw-bold">Activité du société :</label>
                <input type="text" name="activite_societe" id="activite_societe" class="form-control-plaintext" value="{{ $view_comp->domaine_societe }}" readonly>
            </div>
            <div class="col-3">
                <label for="id_benef" class="form-label fw-bold">Identifiant Bénéficiaire Effectif :</label>
                <input type="text" name="id_benef" id="id_benef" class="form-control-plaintext" value="{{ $view_comp->id_benef }}" readonly>
            </div>
            <div class="col-3">
                <label for="benef" class="form-label fw-bold">Bénéficiaire Effectif :</label>
                <input type="text" name="benef" id="benef" class="form-control-plaintext" value="{{ $view_comp->beneficiare }}" readonly>
            </div>
            <div class="col-3">
                <label for="date_ouverture" class="form-label fw-bold">Date d'ouverture du compte :</label>
                <input type="text" name="date_ouverture" id="date_ouverture" class="form-control-plaintext" value="{{ $view_comp->date_ouverture ?? $view_comp->date_ouverture_new }}" readonly>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3">
                <label for="classement_client" class="form-label fw-bold">Classement du client chez la banque :</label>
                <input type="text" name="classement_client" id="classement_client" class="form-control-plaintext" value="{{ $view_comp->classement_client }}" readonly>
            </div>
            <div class="col-3"></div>
            <div class="col-3"></div>
            <div class="col-3">
                <label for="email-benef" class="form-label fw-bold">E-Mail :</label>
                <input type="email" name="email-benef" id="email-benef" class="form-control" value="{{ $view_comp->email_client }}" {{ Auth::user()->hasRole('Charge') ? 'required' : 'disabled'}} />
                <p id="emailFeedback"></p>
            </div>
        </div>
        @if(!empty($view_comp->agent_societe))
            <div class="row">
                <div class="col-6">
                    <label class="form-label fw-bold">Gérant du société :</label>
                    <input type="text" class="form-control-plaintext" value="{{ $view_comp->agent_societe }}" readonly>
                </div>
                <div class="col-6">
                    <label class="form-label fw-bold">Est-ce que le gérant est un client de la banque ?</label>
                    <div class="form-group">
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="client_banque" id="client_banque_gerant_oui" value="oui" @if($view_comp->client_banque =='oui') checked @endif>
                            <label class="form-check-label radio-inline">Oui</label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="client_banque" id="client_banque_gerant_non" value="non" @if($view_comp->client_banque =='non') checked @endif>
                            <label class="form-check-label">Non</label>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
    @vite('resources/js/compensation/email-client.js')
@endpush