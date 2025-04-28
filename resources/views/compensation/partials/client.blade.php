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

    $fileInputs = [
        ['label' => 'Classement Client sur le SED', 'name' => 'engagement_client'],
        ['label' => 'Risque Client sur le SED', 'name' => 'risque_client'],
        ['label' => 'Garanties', 'name' => 'garantie'],
    ];
@endphp

<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Situation Client</h5>
    </div>
    <div class="card-body">
        @if(!empty($infosGlobales) && is_iterable($infosGlobales))
            <input type="hidden" name="working_balance" class="form-control-plaintext" value={{ $infosGlobales['WORKING'] ?? '' }} readonly>
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label fw-bold" for="solde_actuel">Solde actuel :</label>
                    <input type="text" name="solde_compensation" id="solde_actuel" class="form-control-plaintext" value="{{ $infosGlobales['AMOUNT'] ?? '' }}" readonly>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold" for="solde_comp">Solde de compensation :</label>
                    <input type="text" name="compensation_val" id="compensation_val" class="form-control-plaintext" readonly>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold" for="solde_post_comp">Solde aprés compensation :</label>
                    <input type="text" name="solde_apres" id="solde_apres" class="form-control-plaintext" readonly>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label fw-bold">Classement du client chez la banque :</label>
                        <input type="text" class="form-control-plaintext" id="classement_client" name="classement_client"
                            value="{{ $classementValue }}" readonly>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucune information trouvée.
            </div>
        @endif
    </div>
</div>

<hr class="my-4">

<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-info-circle-fill me-2"></i>Arriérés
        </h5>
        <button id="add_row_impaye" type="button" class="btn btn-light btn-sm text-primary d-none">
            <i class="fa fa-plus me-1"></i> Ajouter
        </button>
    </div>
    <div class="card-body">
        <div id="impaye_empty_state" class="text-center my-4">
            <button id="add_row_impaye_empty" type="button" class="btn btn-primary bg-gradient">
                <i class="fa fa-plus me-1"></i> Ajouter un impayé
            </button>
        </div>

        <div class="table-responsive d-none" id="impaye_table_container">
            <table class="table align-middle" id="tab_impaye">
                <thead>
                    <tr>
                        <th>Nature</th>
                        <th>Montant</th>
                        <th>Devise</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="impaye_body">
                    <!-- Rows added dynamically -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<hr class="my-4">

<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Encours chèque</h5>
    </div>
    <div class="card-body">
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
                                            <input class="form-control-plaintext" name="referenceEnc[]" 
                                                value="{{ $encours['REFERENCE'] ?? '' }}" readonly>
                                        </td>

                                        <td>
                                            <input class="form-control-plaintext" name="montantEnc[]" 
                                                value="{{ $encours['AMOUNT'] ?? '' }}" readonly>
                                        </td>

                                        <td>
                                            <input class="form-control-plaintext" name="deviseEnc[]" 
                                                value="{{ $encours['CURRENCY'] ?? '' }}" readonly>
                                        </td>

                                        <td>
                                            <input class="form-control-plaintext" name="numbord[]" 
                                                value="{{ $encours['NUMBORD'] ?? '' }}" readonly>
                                        </td>

                                        <td>
                                            @php
                                                $dateEnc = !empty($encours['DATEENCAISS']) 
                                                    ? date('d/m/Y', strtotime($encours['DATEENCAISS'])) 
                                                    : '';
                                            @endphp
                                            <input class="form-control-plaintext" name="dateEnc[]" value="{{ $dateEnc }}" readonly>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucun encour chèque trouvé.
            </div>
        @endif
    </div>
</div>

<hr class="my-4">

{{-- EFFET ENCOURS NOT YET IMPLEMENTED --}}
{{-- <h5>Encours effet à l'encaissement</h5> --}}

<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Couverture</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label fw-bold" for="encaissement_effet_etude">Effet à l'escompte encours d'étude :</label>
                    <input type="number" name="encaissement_effet_etude" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label fw-bold" for="encaissement_effet_etude">Effet à l'escompte encours de validation :</label>
                    <input type="number" name="encaissement_effet" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-label fw-bold" for="encaissement_effet_etude">Versement Espèce :</label>
                    <input type="number" name="versement" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label fw-bold">Note Couverture :</label>
                    <textarea type="text" name="note_couverture" class="form-control"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<hr class="my-4">

<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Chiffre d'affaire Confié</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label fw-bold"><span class="text-danger">*</span>L'année précédente :</label>
                    <input type="number" step="any" name="chiffre_ans_preced" id="chiffre_ans_preced" class="form-control"  required/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label fw-bold"><span class="text-danger">*</span>Cette année :</label>
                    <input type="number" step="any" name="chiffre_ans_encours" id="chiffre_ans_encours" class="form-control"  required/>
                </div>
            </div>
        </div>
    </div>
</div>

<hr class="my-4">

<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Situation Client</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label fw-bold"><span class="text-danger">*</span>Interdit de chéquier ?</label>
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="interdit_chq_client" value="oui" required>
                                <label class="form-check-label">Oui</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="interdit_chq_client" value="non">
                                <label class="form-check-label">Non</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 conditional-inputs d-none interdit-fields row">
                        <div class="col-6">
                            <label class="form-label fw-bold">Date d'interdiction</label>
                            <input type="text" name="interdit_chq_client_date" placeholder="jj/mm/AAAA" class="form-control" disabled>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold">Nombre</label>
                            <input type="number" name="interdit_chq_client_nombre" class="form-control" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label fw-bold"><span class="text-danger">*</span>Impayé dans le secteur ?</label>
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="montant_non_paye" value="oui" required>
                                <label class="form-check-label">Oui</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="montant_non_paye" value="non">
                                <label class="form-check-label">Non</label>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label fw-bold"><span class="text-danger">*</span>Dépassement sur les engagements ?</label>
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="depassement" value="oui" required>
                                <label class="form-check-label">Oui</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="depassement" value="non">
                                <label class="form-check-label">Non</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label fw-bold"><span class="text-danger">*</span>Etat Financier fournie ?</label>
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="liste_finance_final" value="oui" required>
                                <label class="form-check-label">Oui</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="liste_finance_final" value="non">
                                <label class="form-check-label">Non</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 conditional-inputs finance-fields d-none row">
                        <div class="col-6">
                            <label class="form-label fw-bold">Année</label>
                            <input type="number" name="annee_etat_financier" class="form-control" disabled>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold">Type</label>
                            <select class="form-control" name="type_etat_financier" disabled>
                                <option value=""> </option>
                                <option value="provisoire">Provisoire</option>
                                <option value="certifié">Certifié</option>
                                <option value="définitif">Définitif</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label fw-bold"><span class="text-danger">*</span>Rapport commissaire au compte ?</label>
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="liste_finance_rapport" value="oui" required>
                                <label class="form-check-label">Oui</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="liste_finance_rapport" value="non">
                                <label class="form-check-label">Non</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 conditional-inputs rapport-fields d-none row">
                        <div class="col-6">
                            <label class="form-label fw-bold">Année</label>
                            <input type="number" name="anneecommissaire" class="form-control" disabled>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold">Réserve</label>
                            <div class="form-group">
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
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-4">
                <label class="form-label fw-bold">Chiffre d'affaire global N</label>
                <input type="number" step="any" name="nb_transaction" class="form-control">

                <label class="form-label fw-bold" class="mt-3">Résultat net N</label>
                <input type="number" step="any" name="resultat_brut" class="form-control">
            </div>

            <div class="col-md-6 mt-4">
                <label class="form-label fw-bold">Chiffre d'affaire global N-1</label>
                <input type="number" step="any" name="chiffre_n" class="form-control">

                <label class="form-label fw-bold" class="mt-3">Résultat net N-1</label>
                <input type="number" step="any" name="resultat_n" class="form-control">
            </div>
        </div>

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

<hr class="my-4">

<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Les tombés d'échéance (Dans 2 semaines)</h5>
    </div>
    <div class="card-body">
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
                                                    <input class="form-control-plaintext" name="referenceTombe[]" value="{{ $tombee['ENGAGEMENT'] }}" readonly>
                                                </td>
                                            
                                                <td>
                                                    <input class="form-control-plaintext" name="natureTombe[]" value="{{ $tombee['LIBELLECREDIT'] ?? '' }}" readonly>
                                                </td>
                                            
                                                <td>
                                                    <input class="form-control-plaintext" name="montantTombe[]" value="{{ $tombee['ENCOURS'] }}" readonly>
                                                </td>
                                            
                                                <td>
                                                    <input class="form-control-plaintext" name="deviseTombe[]" value="{{ $tombee['CURRENCY'] }}" readonly>
                                                </td>
                                            
                                                <td>
                                                    <input class="form-control-plaintext" name="date_echTombe[]" value="{{ \Carbon\Carbon::parse($tombee['ECHEDATE'])->format('d/m/Y') }}" readonly>
                                                </td>
                                            
                                                <td>
                                                    <input class="form-control-plaintext" name="date_procheTombe[]" value="{{ isset($tombee['DATEPROCH']) ? \Carbon\Carbon::parse($tombee['DATEPROCH'])->format('d/m/Y') : '' }}" readonly>
                                                </td>
                                            
                                                <input type="hidden" name="categoryTombe[]" value="{{ $tombee['CATEGORY'] }}">
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
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucune tombées d'échéance trouvée.
            </div>
        @endif
    </div>
</div>
