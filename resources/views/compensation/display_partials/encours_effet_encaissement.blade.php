<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Encours effet à l'encaissement</h5>
    </div>
    <div class="card-body">
        @if (!empty($encours_effet[0]->reference))
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm">
                                <thead class="table-dark">
                                    <th>Numéro effet</th>
                                    <th>Nom tiré</th>
                                    <th>RIB tiré</th>
                                    <th>Montant</th>
                                    <th>Date echeance</th>
                                    <th>Date remise</th>
                                </thead>
                                <tbody>
                                    @foreach ($encours_effet as $item)
                                        <tr>
                                            <td>{{ $item->num_effet }}</td>
                                            <td>{{ $item->nom_tire }}</td>
                                            <td>{{ $item->rib_tire }}</td>
                                            <td>{{ $item->montant }}</td>
                                            <td>{{ $item->date_echenace }}</td>
                                            <td>{{ $item->date_remise }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucun encours effet à l'encaissement.
            </div>
        @endif
    </div>
</div>