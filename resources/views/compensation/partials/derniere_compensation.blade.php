@php
    $decisions = [
        4 => "avis favorable par chargé clientèle",
        5 => "avis défavorable par chargé clientèle",
        6 => "avis défavorable par chef d'agence",
        7 => "avis favorable par chef d'agence",
        8 => "avis défavorable par exploitation corporate",
        9 => "avis favorable par exploitation corporate",
        10 => "avis défavorable par exploitation particulier",
        11 => "avis favorable par exploitation particulier",
        12 => "avis défavorable par exploitation",
        13 => "avis favorable par exploitation",
        14 => "avis défavorable par risque",
        15 => "avis favorable par risque",
        16 => "Avis défavorable par direction générale",
        17 => "Avis favorable par direction générale",
        18 => "Avis défavorable par DGA",
        19 => "Avis favorable par DGA",
        20 => "Avis favorable par chef d'agence suite à un arbitrage",
        21 => "Avis défavorable par chef d'agence suite à un arbitrage",
        22 => "Avis favorable par exploitation suite à un arbitrage",
        23 => "Avis défavorable par exploitation suite à un arbitrage",
        24 => "Avis défavorable par risque suite à un arbitrage",
        25 => "Avis favorable par risque suite à un arbitrage",
    ];
@endphp

<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Information sur la dernière compensation</h5>
    </div>
    <div class="card-body">
        @if(!empty($derniereCompensation))
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date">Date :</label>
                                <input type="text" class="form-control input-sm" name="date_der_comp_new" 
                                    value="{{ $derniereCompensation['date_compensation']->format('d-m-Y') }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Montant :</label>
                                <input type="number" step="any" name="montant_der_comp" class="form-control" 
                                    value="{{ $derniereCompensation['val_compensation'] }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Décision de la comité :</label>
                                <input type="text" name="decision_der_comp" class="form-control"
                                    value="{{ $decisions[$derniereCompensation['status']] ?? 'Décision inconnue' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Respect des promesses faites :</label>
                                <div class="form-group">
                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="respect_promet" id="oui" value="oui">
                                        <label class="form-check-label">Oui</label>
                                    </div>
                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="respect_promet" id="non" value="non">
                                        <label class="form-check-label">Non<label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if($derniereCompensation['justification_comp']->count() > 0)
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <th>Promesse</th>
                                        <th>Values</th>
                                    </thead>
                                    <tbody>
                                        @foreach($derniereCompensation['justification_comp'] as $justif)
                                            <tr>
                                                <td>{!! nl2br(htmlspecialchars($justif["name_justification_update"], ENT_NOQUOTES)) !!}</td>
                                                <td>{{ $justif['value'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @foreach($derniereCompensation['justification_comp'] as $justif)
                                <input type="hidden" name="input_justif" value="notEmpty">
                                <input type="hidden" name="promesse_new[]" value="{{ $justif['name_justification_update'] }}">
                                <input type="hidden" name="valeur[]" value="{{ $just["value"] }}">
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Note :</label>
                        <textarea type="text" name="note_der_comp_update" class="form-control "></textarea>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucun compensation trouvée.
            </div>
        @endif
    </div>
</div>