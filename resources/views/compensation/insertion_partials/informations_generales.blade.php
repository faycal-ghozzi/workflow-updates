@php
    $secteurClient = in_array($infosGlobales['SECTORCODE'], [7000, 7100]) ? 'particulier' : 'corporate';

    $classements = [
        0 => 'CREANCES COURANTES - 0',
        1 => 'CREANCES NECESSITANT UN SUIVI PARTICULIER - 1',
        2 => 'CREANCES INCERTAINTES - 2',
        3 => 'CREANCES PREOCCUPANTES - 3',
        4 => 'CREANCES COMPROMESES - 4',
        5 => 'CREANCES AU CONTENTIEUX - 5',
    ];

    $fileInputs = [
        ['label' => 'Crédit au particulier', 'name' => 'credit_particulier_gerant'],
        ['label' => 'Classement', 'name' => 'classement_gerant'],
        ['label' => 'Chèque impayé', 'name' => 'cheque_impaye_gerant'],
    ];
@endphp

@php
    $secteurClient = in_array($infosGlobales['SECTORCODE'], [7000, 7100]) ? 'particulier' : 'corporate';
    $classements = [
        0 => 'CREANCES COURANTES - 0',
        1 => 'CREANCES NECESSITANT UN SUIVI PARTICULIER - 1',
        2 => 'CREANCES INCERTAINTES - 2',
        3 => 'CREANCES PREOCCUPANTES - 3',
        4 => 'CREANCES COMPROMESES - 4',
        5 => 'CREANCES AU CONTENTIEUX - 5',
    ];
@endphp

<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Informations Globales</h5>
    </div>
    <div class="card-body">
        @if(!empty($infosGlobales) && is_iterable($infosGlobales))
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label fw-bold">Agence</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ $agencyHelper->getAgencyName(Auth::user()->agence_id) }}">
                    <input type="hidden" class="form-control-plaintext" readonly value="{{ Auth::user()->agence_id }}" name="code_agence">
                </div>
                <div class="col-md-3">
                    <input type="hidden" class="form-control-plaintext" readonly value="{{ Auth::user()->name }}" name="user_id">
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Date</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ now()->format('d/m/Y') }}" name="date_compensation">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-bold">Code Client</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ $infosGlobales['ID'] }}" name="code_client">
                    <input type="hidden" class="form-control-plaintext" readonly value="{{ $infosGlobales['ACCOUNT'] }}" name="account_number"/>

                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Client</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ $infosGlobales['SHORTNAME'] }}" name="nom_client">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">ID Bénéficiaire Effectif</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ $infosGlobales['IDBENEFICIAIRE'] ?? '-' }}" name="id_benef">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Date d'ouverture du compte</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ \Carbon\Carbon::parse($infosGlobales['CONTACTDATE'])->format('d/m/Y') }}" name="date_ouverture_new">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Activité</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ $infosGlobales['LIBINDUSTRY'] }}" name="domaine_societe">
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-bold">Secteur</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ $infosGlobales['DESCRIPTION'] }}" name="name_secteur">
                </div>

                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Bénéficiaire Effectif</label>
                    <input type="text" class="form-control-plaintext" readonly value="{{ $infosGlobales['BENEFICIAIRE'] ?? '-' }}" name="beneficiare">
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucune information globale trouvée.
            </div>
        @endif
    </div>
</div>

<hr class="my-4">

<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Engagements Gérant</h5>
    </div>
    <div class="card-body">
        @if(!empty($engagementsGerant) && is_iterable($engagementsGerant))
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Code</th><th>Nom</th><th>Client</th><th>Classement</th>
                            <th>Engagement</th><th>Libellé</th><th>Date Échéance</th>
                            <th>Encours</th><th>Devise</th><th>Encours TND</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <input type="hidden" name="engagement_store" value="notEmpty">
                            <td><input class="form-control" name="code_gerant[]" value="{{ $engagementsGerant['SIGNATORY'] ?? '' }}" readonly></td>
                            <td><input class="form-control" name="nom_gerant[]" value="{{ $engagementsGerant['SIGNATORYNAME'] ?? '' }}" readonly></td>
                            <td><input class="form-control" name="client[]" value="{{ $engagementsGerant['CLIENTBANQUE'] ?? '' }}" readonly></td>
                            <td><input class="form-control" name="classementEng[]" value="{{ $classements[$engagementsGerant['CLASSEMENT']] ?? '' }}" readonly></td>
                            <td><input class="form-control" name="engagement[]" value="{{ $engagementsGerant['ENGAGEMENT'] ?? '' }}" readonly></td>
                            <td><input class="form-control" name="type_eng_gerant[]" value="{{ $engagementsGerant['LIBELLE'] ?? '' }}" readonly></td>
                            <td><input class="form-control" name="date_eng_gerant[]" value="{{ $engagementsGerant['ECHEDATE'] ?? '' }}" readonly></td>
                            <td><input class="form-control" name="montant_eng_gerant[]" value="{{ $engagementsGerant['ENCOURS'] ?? '' }}" readonly></td>
                            <td><input class="form-control" name="devise[]" value="{{ $engagementsGerant['CURRENCY'] ?? '' }}" readonly></td>
                            <td><input class="form-control" name="encours_tnd[]" value="{{ $engagementsGerant['ENCOURSTND'] ?? '' }}" readonly></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"> Aucun engagement gérant trouvé.</i>
            </div>
        @endif
    </div>
</div>

<hr id="hrGerant" class="my-4">

<div id="cardGerant" class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Engagement du gérant sur le SED</h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            @foreach($fileInputs as $file)
                <div class="col-md-4">
                    <label for="{{ $file['name'] }}" class="form-label fw-bold mb-2">{{ $file['label'] }}</label>
                    <x-file-input :name="$file['name']" :disabled="false" />
                </div>
            @endforeach
        </div>
    </div>
</div>
