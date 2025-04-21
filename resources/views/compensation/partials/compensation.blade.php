{{-- @php
    var_dump($firstLine);
    var_dump($secondLine);

@endphp --}}

@php 
    use Illuminate\Support\Str; 

    $validPrefixes = ['5000', '5100', '5200', '5300', '5400', '5500'];

    $filteredEngagements = collect($engagementsCredit ?? [])->filter(function ($engagement) use ($validPrefixes) {
        return isset($engagement['LIMITREFRENCE']) && Str::startsWith($engagement['LIMITREFRENCE'], $validPrefixes);
    });

@endphp

<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="devise_compensation">Devise de compensation :</label>
            <input type="text" class="form-control" name="devise_compensation" value="TND" readonly/>
        </div>
    </div>
</div>

<br />

<h5>Placements</h5>

@if(!empty($placements) && is_iterable($placements))
    <div class="table-responsive">
        <table class="table" id="placement_table">
            <thead>
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
    <p class="text-muted">Aucun placement trouvée.</p>
@endif

<hr>

<h5>Crédits</h5>

@if($filteredEngagements->isNotEmpty())
    <div class="table-responsive">
        <table class="table" id="credit_client">
            <thead>
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

                        <td><input class="form-control" name="reference[]" value="{{ $engagement['ENGAGEMENT'] ?? '' }}" readonly></td>
                        <td><input class="form-control" name="libelle[]" value="{{ $engagement['LIBELLECREDIT'] ?? '' }}" readonly></td>
                        <td><input class="form-control" name="categorie[]" value="{{ $engagement['CATEGORY'] ?? '' }}" readonly></td>
                        <td><input class="form-control" name="encours[]" value="{{ $engagement['ENCOURS'] ?? '' }}" readonly></td>

                        @php
                            $rawDate = $engagement['ECHEDATE'] ?? '';
                            $formattedDate = $rawDate ? \Carbon\Carbon::parse($rawDate)->format('d/m/Y') : '';
                        @endphp
                        <td><input class="form-control" name="date_echeance[]" value="{{ $formattedDate }}" readonly></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p class="text-muted">Aucun engagement crédit correspondant trouvé.</p>
@endif

<hr>

<h5>Ligne de crédit de gestion</h5>

@if(!empty($firstLine) && is_iterable($firstLine))
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="autorisation_global">Autorisation :</label>
                <input type="number" name="autorisation_global" id="autorisation_global" class="form-control" value="{{ $firtstLine['PCOMM'] ?? '' }}" readonly />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="utilisation_global">Utilisation :</label>
                <input type="number" name="utilisation_global" id="utilisation_global" class="form-control" value="{{ $firstLine['POSAMT'] ?? '' }}" readonly />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
            <label>Disponible :</label>
            <input type="number" step="any" class="form-control" name="disponible_global" id="disponible_global" value="{{ $firstLine['PAVAIL'] ?? '' }}" readonly/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Date d'expiration :</label>
                <input type="text" class="form-control input-sm" name="date_global_new" value="{{ $firstLine['EXP'] ?? '' }}" readonly>
            </div>
        </div>
    </div>
@else
    <p class="text-muted">Aucune limite trouvé.</p>
@endif

<br />

<h5>Facilité de caisse</h5>

@if(!empty($secondLine) && is_iterable($secondLine))
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
            <label>Autorisation :</label>
            <input type="number" step="any" class="form-control " value="{{ $secondLine['PCOMM'] ?? '' }}" name="valeur_decision" id="valeur_decision" readonly/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
            <label>Utilisation :</label>
            <input type="number" step="any" class="form-control " value="{{ $secondLine['POSAMT'] ?? '' }}" name="autorisation" id="autorisation_facilite" readonly/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
            <label>Disponible :</label>
            <input type="number" step="any" class="form-control " value="{{ $secondLine['PAVAIL'] ?? '' }}" name="disponible_autorisation" id="disponible_autorisation" readonly/>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>{{ __('Date d\'expiration') }} :</label>
                <input type="text" class="form-control input-sm" name="date_exp_decision_new" value="{{ $secondLine['EXP'] ?? '' }}" readonly>
            </div>
        </div>
    </div>
@else
    <p class="text-muted">Aucune limite trouvé.</p>
@endif

<br />

<h5>Encours impayé client</h5>

@if(!empty($impayes) && is_iterable($impayes))
    <div class="table-responsive">
        <table class="table" id="impayes_client">
            <thead>
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
                        <td><input class="form-control" name="refImp" value="{{ $impaye['ID'] ?? '' }}" readonly></td>
                        <td><input class="form-control" name="nature_besoinImp" value="{{ $impaye['DESCRIPTION'] ?? '' }}" readonly></td>
                        <td><input class="form-control" name="valeur_besoinImp" value="{{ $impaye['TOTALAMTTOREPAY'] ?? '' }}" readonly></td>
                        <td><input class="form-control" name="deviseImp" value="{{ $impaye['CURRENCY'] ?? '' }}" readonly></td>
                        <td><input class="form-control" name="mantant_tndImp" value="{{ $impaye['TOTALAMTTOREPAYTND'] ?? '' }}" readonly></td>
                        
                        @php
                            $rawDate = $impaye['PAYMENTDTEDUE'] ?? null;
                            $formattedDate = $rawDate ? \Carbon\Carbon::parse($rawDate)->format('d/m/Y') : '';
                        @endphp
                        <td><input class="form-control" name="echeance_besoinImp" value="{{ $formattedDate }}" readonly></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        @foreach($impayes as $impaye)
            <li>{{ json_encode($impaye) }}</li>
        @endforeach
@else
    <p class="text-muted">Aucun lease trouvé.</p>
@endif

<h5>Leasing</h5>

@if(!empty($leasing) && is_iterable($leasing))
    <ul>
        @foreach($leasing as $lease)
            <li>{{ json_encode($lease) }}</li>
        @endforeach
    </ul>
@else
    <p class="text-muted">Aucun lease trouvé.</p>
@endif

<h5>Incidents de Paiment</h5>

@if(!empty($incidentsPaiment) && is_iterable($incidentsPaiment))
    <ul>
        @foreach($incidentsPaiment as $incidentPaiment)
            <li>{{ json_encode($incidentPaiment) }}</li>
        @endforeach
    </ul>
@else
    <p class="text-muted">Aucun lease trouvé.</p>
@endif
