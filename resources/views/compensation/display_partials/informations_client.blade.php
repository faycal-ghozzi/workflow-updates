<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Informations Client</h5>
    </div>
    <div class="card-body">
        <div class="row g-4">
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
            <div class="col-3">
                <label for="classement_client" class="form-label fw-bold">Classement du client chez la banque :</label>
                <input type="text" name="classement_client" id="classement_client" class="form-control-plaintext" value="{{ $view_comp->classement_client }}" readonly>
            </div>
        </div>
    </div>
</div>