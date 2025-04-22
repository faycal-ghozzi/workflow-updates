@php
    $classements = [
        0 => 'CREANCES COURANTES - 0',
        1 => 'CREANCES NECESSITANT UN SUIVI PARTICULIER - 1',
        2 => 'CREANCES INCERTAINTES - 2',
        3 => 'CREANCES PREOCCUPANTES - 3',
        4 => 'CREANCES COMPROMESES - 4',
        5 => 'CREANCES AU CONTENTIEUX - 5',
    ];
    $classementValue = $classements[$infosGlobales['CLASSEMENT']] ?? 'Non classé';
@endphp

<h5>Situation Client</h5>

@if(!empty($infosGlobales) && is_iterable($infosGlobales))
    <input type="hidden" name="working_balance" class="form-control" value={{ $infosGlobales['WORKING'] ?? '' }} readonly>
    <div class="row">
        <div class="col-md-3">
            <label for="solde_actuel">Solde actuel :</label>
            <input type="number" name="solde_actuel" id="solde_actuel" class="form-control" value="{{ $infosGlobales['AMOUNT'] ?? '' }}" readonly>
        </div>
        <div class="col-md-3">
            <label for="solde_comp">Solde de compensation :</label>
            <input type="number" name="solde_comp" id="solde_comp" class="form-control" readonly>
        </div>
        <div class="col-md-3">
            <label for="solde_post_comp">Solde aprés compensation :</label>
            <input type="number" name="solde_post_comp" id="solde_post_comp" class="form-control" readonly>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Classement du client chez la banque :</label>
                <input type="text" class="form-control" id="classement_client" name="classement_client"
                       value="{{ $classementValue }}" readonly>
            </div>
        </div>
    </div>
@else
    <p class="text-muted">Aucune Information trouvée.</p>
@endif

<hr>

<h5>Arriérés</h5>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <h5 class="card-description text-info">--- {{ __('Impayé à payer') }} ---</h5>
            <div class="table-responsive">
                <table class="table" id="tab_impaye">
                    <thead>
                        <th>Nature</th>
                        <th>Montant</th>
                        <th>Devise</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr id='impaye0'></tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10"></td>
                            <td>
                                <a id="add_row_impaye" class="btn btn-info"><i
                                        class="fa fa-plus"></i></a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<hr />

<h5>Encours chèque</h5>

@if(!empty($encours) && is_iterable($encours))
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Référence</th>
                                <th>Montant</th>
                                <th>Devise</th>
                                <th>Num Bord</th>
                                <th>Date d'encaissement</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <input type="hidden" name="encours_compensation" value="notEmpty">

                                <td>
                                    <input class="form-control" name="referenceEnc" 
                                        value="{{ $encours['REFERENCE'] ?? '' }}" readonly>
                                </td>

                                <td>
                                    <input class="form-control" name="montantEnc" 
                                        value="{{ $encours['AMOUNT'] ?? '' }}" readonly>
                                </td>

                                <td>
                                    <input class="form-control" name="deviseEnc" 
                                        value="{{ $encours['CURRENCY'] ?? '' }}" readonly>
                                </td>

                                <td>
                                    <input class="form-control" name="numbord" 
                                        value="{{ $encours['NUMBORD'] ?? '' }}" readonly>
                                </td>

                                <td>
                                    @php
                                        $dateEnc = !empty($encours['DATEENCAISS']) 
                                            ? date('d/m/Y', strtotime($encours['DATEENCAISS'])) 
                                            : '';
                                    @endphp
                                    <input class="form-control" name="dateEnc" value="{{ $dateEnc }}" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@else
    <p class="text-muted">Aucun encour chèque trouvé.</p>
@endif

<hr />

{{-- EFFET ENCOURS NOT YET IMPLEMENTED --}}
{{-- <h5>Encours effet à l'encaissement</h5> --}}

<h5>Couverture</h5>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="encaissement_effet_etude">Effet à l'escompte encours d'étude :</label>
            <input type="number" name="encaissement_effet_etude" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="encaissement_effet_etude">Effet à l'escompte encours de validation :</label>
            <input type="number" name="encaissement_effet" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="encaissement_effet_etude">Versement Espèce :</label>
            <input type="number" name="versement" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Note Couverture :</label>
            <textarea type="text" name="note_couverture" class="form-control"></textarea>
        </div>
    </div>
</div>

<hr />

<h5>Chiffre d'affaire Confié</h5>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label><span class="text-danger">*</span>L'année précédente :</label>
            <input type="number" step="any" name="chiffre_ans_preced" id="chiffre_ans_preced" class="form-control"  required/>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label><span class="text-danger">*</span>Cette année :</label>
            <input type="number" step="any" name="chiffre_ans_encours" id="chiffre_ans_encours" class="form-control"  required/>
        </div>
    </div>
</div>

<hr />

<h5>Situation Client</h5>

<div class="row">

    <div class="col-md-6">
        <label><span class="text-danger">*</span>Interdit de chéquier ?</label>
        <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="interdit_chq_client" value="oui" required>
            <label class="form-check-label">Oui</label>
        </div>
        <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="interdit_chq_client" value="non">
            <label class="form-check-label">Non</label>
        </div>

        <div class="row mt-2">
            <div class="col-6">
                <label>Date d'interdiction</label>
                <input type="text" name="interdit_chq_client_date" placeholder="jj/mm/AAAA" class="form-control" disabled>
            </div>
            <div class="col-6">
                <label>Nombre</label>
                <input type="number" name="interdit_chq_client_nombre" class="form-control" disabled>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <label><span class="text-danger">*</span>Classement Client sur le SED</label>
        <input type="file" name="engagement_client" class="custom-file-input" accept=".pdf" required>
    </div>

    <div class="col-md-6 mt-3">
        <label><span class="text-danger">*</span>Impayé dans le secteur ?</label>
        <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="montant_non_paye" value="oui" required>
            <label class="form-check-label">Oui</label>
        </div>
        <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="montant_non_paye" value="non">
            <label class="form-check-label">Non</label>
        </div>
    </div>

    <div class="col-md-6 mt-3">
        <label><span class="text-danger">*</span>Risque Client sur le SED</label>
        <input type="file" name="risque_client" class="custom-file-input" accept=".pdf" required>
    </div>

    <div class="col-md-6 mt-3">
        <label><span class="text-danger">*</span>Dépassement sur les engagements ?</label>
        <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="depassement" value="oui" required>
            <label class="form-check-label">Oui</label>
        </div>
        <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="depassement" value="non">
            <label class="form-check-label">Non</label>
        </div>
    </div>

    <div class="col-md-6 mt-3">
        <label>Garanties</label>
        <input type="file" name="garantie" class="custom-file-input" accept=".pdf">
    </div>

    <div class="col-md-6 mt-3">
        <label><span class="text-danger">*</span>Etat Financier fournie ?</label>
        <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="liste_finance_final" value="oui" required>
            <label class="form-check-label">Oui</label>
        </div>
        <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="liste_finance_final" value="non">
            <label class="form-check-label">Non</label>
        </div>

        <div class="row mt-2">
            <div class="col-6">
                <label>Année</label>
                <input type="number" name="annee_etat_financier" class="form-control" disabled>
            </div>
            <div class="col-6">
                <label>Type</label>
                <select class="form-control" name="type_etat_financier" disabled>
                    <option value=""> </option>
                    <option value="provisoire">Provisoire</option>
                    <option value="certifié">Certifié</option>
                    <option value="définitif">Définitif</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-6 mt-3">
        <label><span class="text-danger">*</span>Rapport commissaire au compte ?</label>
        <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="liste_finance_rapport" value="oui" required>
            <label class="form-check-label">Oui</label>
        </div>
        <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="liste_finance_rapport" value="non">
            <label class="form-check-label">Non</label>
        </div>

        <div class="row mt-2">
            <div class="col-6">
                <label>Année</label>
                <input type="number" name="anneecommissaire" class="form-control" disabled>
            </div>
            <div class="col-6">
                <label>Réserve</label>
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="liste_finance_rapport_reserve" value="oui">
                    <label class="form-check-label">Oui</label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="liste_finance_rapport_reserve" value="non">
                    <label class="form-check-label">Non</label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mt-4">
        <label>Chiffre d'affaire global N</label>
        <input type="number" step="any" name="nb_transaction" class="form-control">

        <label class="mt-3">Résultat net N</label>
        <input type="number" step="any" name="resultat_brut" class="form-control">
    </div>

    <div class="col-md-6 mt-4">
        <label>Chiffre d'affaire global N-1</label>
        <input type="number" step="any" name="chiffre_n" class="form-control">

        <label class="mt-3">Résultat net N-1</label>
        <input type="number" step="any" name="resultat_n" class="form-control">
    </div>
</div>

<h5>Les tombés d'échéance (Dans 2 semaines)</h5>

@if(!empty($tombees) && is_iterable($tombees))
    <div class="col-md-12">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table_tombee">
                            <thead>
                                <th>Référence</th>
                                <th>Nature</th>
                                <th>Montant</th>
                                <th>Devise</th>
                                <th>Date d'écheance</th>
                                <th>Date proche</th>
                            </thead>
                            <tbody>
                                @foreach ($tombees as $tombee)
                                    <tr>
                                        <td>
                                            <input class="form-control" name="referenceTombe" value="{{ $tombee['ENGAGEMENT'] }}" readonly>
                                        </td>
                                    
                                        <td>
                                            <input class="form-control" name="natureTombe" value="{{ $tombee['LIBELLECREDIT'] ?? '' }}" readonly>
                                        </td>
                                    
                                        <td>
                                            <input class="form-control" name="montantTombe" value="{{ $tombee['ENCOURS'] }}" readonly>
                                        </td>
                                    
                                        <td>
                                            <input class="form-control" name="deviseTombe" value="{{ $tombee['CURRENCY'] }}" readonly>
                                        </td>
                                    
                                        <td>
                                            <input class="form-control" name="date_echTombe" value="{{ \Carbon\Carbon::parse($tombee['ECHEDATE'])->format('d/m/Y') }}" readonly>
                                        </td>
                                    
                                        <td>
                                            <input class="form-control" name="date_procheTombe" value="{{ isset($tombee['DATEPROCH']) ? \Carbon\Carbon::parse($tombee['DATEPROCH'])->format('d/m/Y') : '' }}" readonly>
                                        </td>
                                    
                                        <input type="hidden" name="categoryTombe" value="{{ $tombee['CATEGORY'] }}">
                                    </tr>
                                @endforeach                      
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <p class="text-muted">Aucune tombées d'échéance trouvée.</p>
@endif