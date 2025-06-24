@php 
    use Illuminate\Support\Str; 

    $validPrefixes = ['5000', '5100', '5200', '5300', '5400', '5500'];

    $filteredEngagements = collect($engagementsCredit ?? [])->filter(function ($engagement) use ($validPrefixes) {
        return isset($engagement['LIMITREFRENCE']) && Str::startsWith($engagement['LIMITREFRENCE'], $validPrefixes);
    });
@endphp

<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Devise de compensation</h5>
    </div>
    <div class="card-body">
        <input type="text" class="form-control-plaintext" name="devise_compensation" value="TND" readonly/>
    </div>
</div>

<hr class="my-4">

<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Placements</h5>
    </div>
    <div class="card-body">
        @if(!empty($placements) && is_iterable($placements))
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="placement_table">
                    <thead class="table-dark">
                        <tr>
                            <th>Référence</th>
                            <th>Nature du placement</th>
                            <th>Montant</th>
                            <th>Devise</th>
                            <th>Du</th>
                            <th>Jusqu'au</th>
                            <th>Taux du placement</th>
                            <th>Base TMM</th>
                            <th>Marge Variable</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ((array) $placements as $placement)
                            <tr>
                                <input type="hidden" name="placement_compensation" value="notEmpty">

                                <td><input class="form-control" name="referenceP[]" value="{{ $placement['ID'] ?? '' }}" readonly></td>
                                <td><input class="form-control" name="natureP[]" value="{{ $placement['LCATEGORY'] ?? '' }}" readonly></td>
                                <td><input class="form-control" name="montantP[]" value="{{ $placement['AMOUNT'] ?? '' }}" readonly></td>
                                <td><input class="form-control" name="deviseP[]" value="{{ $placement['CURRENCY'] ?? '' }}" readonly></td>
                                <td><input class="form-control" name="du[]" value="{{ $placement['VALUEDATE'] ?? '' }}" readonly></td>
                                <td><input class="form-control" name="au[]" value="{{ $placement['FINMATDATE'] ?? '' }}" readonly></td>
                                <td><input class="form-control" name="taux[]" value="{{ $placement['INTERESTRATE'] ?? '' }}" readonly></td>

                                <td>
                                    <input class="form-control" name="basetmm[]" value="{{ $placement['TMMTX'] ?? '' }}" readonly>
                                </td>
                                <td>
                                    <input class="form-control" name="marge[]" value="{{ $placement['MARGETX'] ?? '' }}" readonly>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucune placement trouvée.
            </div>
        @endif
    </div>
</div>

<hr class="my-4">

<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Crédits</h5>
    </div>
    <div class="card-body">
        @if($filteredEngagements->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="credit_client">
                    <thead class="table-dark">
                        <tr>
                            <th>Référence</th>
                            <th>Libellé</th>
                            <th>Catégorie</th>
                            <th>Encours</th>
                            <th>Date Échéance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($filteredEngagements as $engagement)
                            <tr>
                                <input type="hidden" name="engagement_credit" value="notEmpty">

                                <td><input class="form-control" name="referenceCred[]" value="{{ $engagement['ENGAGEMENT'] ?? '' }}" readonly></td>
                                <td><input class="form-control" name="libelleCred[]" value="{{ $engagement['LIBELLECREDIT'] ?? '' }}" readonly></td>
                                <td><input class="form-control" name="categoryCred[]" value="{{ $engagement['CATEGORY'] ?? '' }}" readonly></td>
                                <td><input class="form-control" name="encoursCred[]" value="{{ $engagement['ENCOURS'] ?? '' }}" readonly></td>

                                @php
                                    $rawDate = $engagement['ECHEDATE'] ?? '';
                                    $formattedDate = $rawDate ? \Carbon\Carbon::parse($rawDate)->format('d/m/Y') : '';
                                @endphp
                                <td><input class="form-control" name="dateCred[]" value="{{ $formattedDate }}" readonly></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucun engagement crédit correspondant trouvé.
            </div>
        @endif
    </div>
</div>

<hr class="my-4">

<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Ligne de crédit de gestion</h5>
    </div>
    <div class="card-body">
        @if(!empty($firstLine))
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="autorisation_global">Autorisation :</label>
                        <input type="text" class="form-control-plaintext" name="autorisation_global" id="autorisation_global" value="{{ $firstLine['PCOMM'] ?? 0 }}" readonly />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label fw-bold" for="utilisation_global">Utilisation :</label>
                        <input type="text" class="form-control-plaintext" name="utilisation_global" id="utilisation_global" value="{{ $firstLine['POSAMT'] ?? 0 }}" readonly />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label class="form-label fw-bold">Disponible :</label>
                    <input type="text" class="form-control-plaintext" name="disponible_global" id="disponible_global" value="{{ $firstLine['PAVAIL'] ?? 0 }}" readonly/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label fw-bold">Date d'expiration :</label>
                        <input type="text" class="form-control-plaintext input-sm" name="date_global_new" value="{{ $firstLine['EXP'] ?? '' }}" readonly>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucune limite trouvé.
            </div>
        @endif
    </div>
</div>

<hr class="my-4">

<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Facilité de caisse</h5>
    </div>
    <div class="card-body">
        @if(!empty($secondLine))
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                    <label class="form-label fw-bold">Autorisation :</label>
                    <input type="text" class="form-control-plaintext" value="{{ $secondLine['PCOMM'] ?? 0 }}" name="valeur_decision" id="valeur_decision" readonly/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label class="form-label fw-bold">Utilisation :</label>
                    <input type="text" class="form-control-plaintext" value="{{ $secondLine['POSAMT'] ?? 0 }}" name="autorisation" id="autorisation_facilite" readonly/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label class="form-label fw-bold">Disponible :</label>
                    <input type="text" class="form-control-plaintext" value="{{ $secondLine['PAVAIL'] ?? 0 }}" name="disponible_autorisation" id="disponible_autorisation" readonly/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label fw-bold">Date d'expiration :</label>
                        <input type="text" class="form-control-plaintext input-sm" name="date_exp_decision_new" value="{{ $secondLine['EXP'] ?? '' }}" readonly>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucune limite trouvé.
            </div>
        @endif
    </div>
</div>

<hr class="my-4">

<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Encours impayé client</h5>
    </div>
    <div class="card-body">
        @if(!empty($impayes) && is_iterable($impayes))
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="impayes_client">
                    <thead class="table-dark">
                        <tr>
                            <th>Référence</th>
                            <th>Type d'impayé</th>
                            <th>Montant</th>
                            <th>Devise</th>
                            <th>Montant en TND</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($impayes as $impaye)
                            <tr>
                                <td><input class="form-control" name="refImp[]" value="{{ $impaye['ID'] ?? '' }}" readonly></td>
                                <td><input class="form-control" name="nature_besoinImp[]" value="{{ $impaye['DESCRIPTION'] ?? '' }}" readonly></td>
                                <td><input class="form-control" name="valeur_besoinImp[]" value="{{ $impaye['TOTALAMTTOREPAY'] ?? '' }}" readonly></td>
                                <td><input class="form-control" name="deviseImp[]" value="{{ $impaye['CURRENCY'] ?? '' }}" readonly></td>
                                <td><input class="form-control" name="mantant_tndImp[]" value="{{ $impaye['TOTALAMTTOREPAYTND'] ?? '' }}" readonly></td>
                                
                                @php
                                    $rawDate = $impaye['PAYMENTDTEDUE'] ?? null;
                                    $formattedDate = $rawDate ? \Carbon\Carbon::parse($rawDate)->format('d/m/Y') : '';
                                @endphp
                                <td><input class="form-control" name="echeance_besoinImp[]" value="{{ $formattedDate }}" readonly></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucune Impayé trouvée.
            </div>
        @endif
    </div>
</div>

<hr class="my-4">

<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Impayés de Leasing - 3017</h5>
    </div>
    <div class="card-body">
        @if(!empty($leasing) && is_iterable($leasing))
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm" id="leasing_client">
                    <thead class="table-dark">
                        <tr>
                            <th>Numéro d Compte</th>
                            <th>Solde</th>
                            <th>Devise</th>
                            <th>Date d'ouvreture</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leasing as $lease)
                            <tr>
                                <td><input class="form-control" name="num_compte_ImpLeasing[]" value="{{ $lease['ID'] ?? '' }}" readonly></td>
                                <td><input class="form-control" name="solde_leasing[]" value="{{ $lease['WORKINGBALANCE'] ?? '' }}" readonly></td>
                                <td><input class="form-control" name="devise_leasing[]" value="{{ $lease['CURRENCY'] ?? '' }}" readonly></td>
                                @php
                                    $rawDate = $lease['OPENINGDATE'] ?? null;
                                    $formattedDate = $rawDate ? \Carbon\Carbon::parse($rawDate)->format('d/m/Y') : '';
                                @endphp
                                <td><input class="form-control" name="date_ouverture_leasing[]" value="{{ $formattedDate }}" readonly></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucun impayé leasing trouvée.
            </div>
        @endif
    </div>
</div>

<hr class="my-4">

<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Incidents de Paiment</h5>
    </div>
    <div class="card-body">
        @if(!empty($incidentsPaiment) && is_iterable($incidentsPaiment))
            <div class="form-group">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="table-dark">
                            <th>REF</th>
                            <th>NUM CHQ</th>
                            <th>CODE PRESENTATION</th>
                            <th>MONTANT</th>
                            <th>CURRENCY</th>
                            <th>DATE EMISSION</th>
                            <th>RIB BENEFICIAIRE</th>
                            <th>NOM BENEFICIAIRE</th>
                            <th>MOTIF REJET</th>
                        </thead>
                        <tbody>
                            @foreach ($incidentsPaiment as $incident)
                                <tr>
                                    <td><input class="form-control" name="refIncident" value="{{ $incident['ID'] ?? '' }}" readonly></td>
                                    <td><input class="form-control" name="numChqIncident" value="{{ $incident['NUMCHQ'] ?? '' }}" readonly></td>
                                    <td><input class="form-control" name="codeIncident" value="{{ $incident['CODEPRESENTATION'] ?? '' }}" readonly></td>
                                    <td><input class="form-control" name="montantIncident" value="{{ $incident['MONTANT'] ?? '' }}" readonly></td>
                                    <td><input class="form-control" name="currencyIncident" value="{{ $incident['CURRENCY'] ?? '' }}" readonly></td>
                                    @php
                                        $rawDate = $incident['DATEEMISSION'] ?? null;
                                        $formattedDate = $rawDate ? \Carbon\Carbon::parse($rawDate)->format('d/m/Y') : '';
                                    @endphp
                                    <td><input class="form-control" name="dateIncident" value="{{ $formattedDate }}" readonly></td>
                                    <td><input class="form-control" name="ribIncident" value="{{ $incident['RIBBENEF'] ?? '' }}" readonly></td>
                                    <td><input class="form-control" name="nomBenefIncident" value="{{ $incident['NOMBENEF'] ?? '' }}" readonly></td>
                                    <td><input class="form-control" name="motifIncident" value="{{ $incident['MOTIFREJET'] ?? '' }}" readonly></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucun incident de paiment trouvée.
            </div>
        @endif
    </div>
</div>

<hr class="my-4">


<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-info-circle-fill me-2"></i>Compensation
        </h5>
        <button type="button" class="btn btn-light btn-sm text-primary d-none add-comp-row">
            <i class="fa fa-plus me-1"></i> Ajouter
        </button>
    </div>
    <div class="card-body">
        <div id="comp_empty_state" class="text-center my-4">
            <button type="button" class="btn btn-primary bg-gradient add-comp-row">
                <i class="fa fa-plus me-1"></i> Ajouter une compensation
            </button>
        </div>

        <div class="table-responsive d-none" id="comp_table_container">
            <table class="table table-bordered table-striped table-sm align-middle" id="tab_logic">
                <thead class="table-dark">
                    <tr>
                        <th><span class="text-danger">*</span> Type de transaction</th>
                        <th><span class="text-danger">*</span> Bénéficiaire</th>
                        <th><span class="text-danger">*</span> Montant</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="comp_body">
                    <!-- Rows will be added here -->
                </tbody>
                <tfoot>
                    <tr>
                        <td class="text-center text-danger fw-bold">Total</td>
                        <td colspan="2">
                            <input id="Total_TTC" name="val_compensation" type="text"
                                   class="form-control input-md" placeholder="0" readonly>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
