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

<h5>Informations Globales</h5>

@if(!empty($infosGlobales) && is_iterable($infosGlobales))
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="agence">Agence</label>
                <input type="text" name="agence" class="form-control" value="{{ $agencyHelper->getAgencyName(Auth::user()->agence_id) }}" readonly/>
            </div>
        </div>
        <div class="col-md-3">
            <input type="hidden" name="user_id" value="{{ Auth::user()->name }}"/>
        </div>
        <div class="col-md-3">
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="date">Date :</label>
                <input type="date" class="form-control input-sm" id="dateSys" name="date_compensation"
                       value="{{ now()->format('Y-m-d') }}" readonly>
            </div>
        </div>        
    </div>
    <br />
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Code Client :</label>
                <input type="number" class="form-control " name="code_client" id="code_client" value="{{ $infosGlobales['ID'] }}" readonly/>
                <input type="hidden" class="form-control " name="account_number" value="{{ $infosGlobales['ACCOUNT'] }}" readonly/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Client :</label>
                <input type="text" class="form-control" name="nom_client" id="nom_client" value="{{ $infosGlobales['SHORTNAME'] }}" readonly/>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Date d'ouverture du compte :</label>
                <input type="text" class="form-control input-sm" name="date_ouverture_new"
                       value="{{ \Carbon\Carbon::parse($infosGlobales['CONTACTDATE'])->format('d/m/Y') }}" readonly>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Activité du société :</label>
                <input type="text" class="form-control" name="domaine_societe" value="{{ $infosGlobales['LIBINDUSTRY'] }}" readonly/>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label>Secteur :</label>
                <input type="hidden" class="form-control" name="secteur_client" value="{{ $secteurClient }}" readonly />
                <input type="text" class="form-control" name="name_secteur" value="{{ $infosGlobales['DESCRIPTION'] }}" readonly />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Identifiant Bénéficiaire Effectif :</label>
                <input type="text" class="form-control" name="id_benef"
                       value="{{ $infosGlobales['IDBENEFICIAIRE'] ?? '' }}" readonly />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Bénéficiaire Effectif :</label>
                <input type="text" class="form-control " name="beneficiare" value="{{ $infosGlobales['BENEFICIAIRE'] ?? '' }}" readonly/>
            </div>
        </div>
    </div>
@else
    <p class="text-muted">Aucune information globale trouvée.</p>
@endif

<hr>

<h5>Engagements Gérant</h5>

@if(!empty($engagementsGerant) && is_iterable($engagementsGerant))
    <div class="table-responsive">
        <table class="table" id="tableGerant">
            <thead>
                <tr>
                    <th>CODE</th>
                    <th>NAME</th>
                    <th>CLIENT</th>
                    <th>CLASSEMENT</th>
                    <th>ENGAGEMENT</th>
                    <th>LIBELLE</th>
                    <th>DATE ECHEANCE</th>
                    <th>ENCOURS</th>
                    <th>CURRENCY</th>
                    <th>ENCOURS TND</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <input type="hidden" name="engagement_store" value="notEmpty">

                    <td><input class="form-control" name="code_gerant[]" value="{{ $engagementsGerant['SIGNATORY'] ?? '' }}" readonly></td>
                    <td><input class="form-control" name="nom_gerant[]" value="{{ $engagementsGerant['SIGNATORYNAME'] ?? '' }}" readonly></td>
                    <td><input class="form-control" name="client[]" value="{{ $engagementsGerant['CLIENTBANQUE'] ?? '' }}" readonly></td>

                    <td>
                        <input class="form-control" name="classementEng[]" 
                            value="{{ $classements[$engagementsGerant['CLASSEMENT']] ?? '' }}" readonly>
                    </td>

                    @if (!empty($engagementsGerant['ENGAGEMENT']))
                        <td><input class="form-control" name="engagement" value="{{ $engagementsGerant['ENGAGEMENT'] }}" readonly></td>
                        <td><input class="form-control" name="type_eng_gerant" value="{{ $engagementsGerant['LIBELLE'] ?? '' }}" readonly></td>
                        <td><input class="form-control" name="date_eng_gerant" value="{{ $engagementsGerant['ECHEDATE'] ?? '' }}" readonly></td>
                        <td><input class="form-control" name="montant_eng_gerant" value="{{ $engagementsGerant['ENCOURS'] ?? '' }}" readonly></td>
                        <td><input class="form-control" name="devise" value="{{ $engagementsGerant['CURRENCY'] ?? '' }}" readonly></td>
                        <td><input class="form-control" name="encours_tnd" value="{{ $engagementsGerant['ENCOURSTND'] ?? '' }}" readonly></td>
                    @else
                        <td colspan="6"></td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
@else
    <p class="text-muted">Aucun engagement gérant trouvé.</p>
@endif

<hr>

<h5>Engagement du gérant sur le SED</h5>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Crédit au particulier :</label>
            <div class="custom-file">
                <input type="file" name="credit_particulier_gerant" class="custom-file-input" id="credit_particulier_gerant" accept=".pdf" disabled>
                <label class="custom-file-label" for="credit_particulier_gerant"></label>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Classement :</label>
            <div class="custom-file">
                <input type="file" name="classement_gerant" class="custom-file-input" id="classement_gerant" accept=".pdf" disabled>
                <label class="custom-file-label" for="classement_gerant"></label>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Chèque impayé :</label>
            <div class="custom-file">
                <input type="file" name="cheque_impaye_gerant" class="custom-file-input" id="cheque_impaye_gerant" accept=".pdf" disabled>
                <label class="custom-file-label" for="cheque_impaye_gerant"></label>
            </div>
        </div>
    </div>
</div>