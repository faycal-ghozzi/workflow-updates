<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Tombées Proches (dans 2 semaines)</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <h5 class="card-description text-secondary">Escompte Commercial</h5>
            <br>
            <div class="row g-4">
                <div class="col-3"></div>
                <div class="col-3"><input type="text" class="fw-bold form-control-plaintext" id="totale_escompte" value="{{ $tombe }}" readonly></div>
                <div class="col-3"><button class="btn btn btn-success" data-toggle="modal" data-target="#modal_escompte_comm_{{$view_comp->id}}">Consulter</button></div>
                <div class="col-3"></div>
            </div>
        </div>

        <div class="row">
            <h5 class="card-description text-secondary">Decouvertes Mobilisées</h5>
            <br>
            <div class="row g-4">
                <div class="col-3"></div>
                <div class="col-3"><input class="fw-bold form-control-plaintext" value="{{ $decouvert }}" id="totale_decouvert" readonly></div>
                <div class="col-3"><button class="btn btn btn-success" data-toggle="modal" data-target="#modal_decouvert_mobilise_{{$view_comp->id}}">Consulter</button></div>
                <div class="col-3"></div>
            </div>
        </div>

        <div class="row">
            <h5 class="card-description text-secondary">Autres</h5>
            <br>
            @if(!empty($tombe_compensation))
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm">
                            <thead class="table-dark">
                                <th>Référence</th>
                                <th>Nature</th>
                                <th>Montant</th>
                                <th>Devise</th>
                                <th>Date Echéance</th>
                                <th>Date Proche</th>
                            </thead>
                            @foreach ($tombe_compensation as $tm)
                                @if (($tm->category != 21050)&&($tm->category != 21059))
                                    <tbody>
                                        <tr>
                                            <td>{{ $tm->reference ?? '--' }}</td>
                                            <td>{{ $tm->nature ?? '--' }}</td>
                                            <td>{{ $tm->montant ?? '--' }}</td>
                                            <td>{{ $tm->devise ?? '--' }}</td>
                                            <td>{{ $tm->date_ech ?? '--' }}</td>
                                            <td>{{ $tm->date_proche ?? '--' }}</td>
                                        </tr>
                                    </tbody>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            @else
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucun incident de paiment.
                </div>
            @endif
        </div>
    </div>
</div>

