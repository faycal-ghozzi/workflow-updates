<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Encours chèque</h5>
    </div>
    <div class="card-body">
        @if (!empty($encours_cheque[0]->reference))
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm">
                                <thead class="table-dark">
                                    <th>Référence</th>
                                    <th>Montant</th>
                                    <th>Devise</th>
                                    <th>Numéro Bordereau</th>
                                    <th>Date d'encaissement</th>
                                </thead>
                                <tbody>
                                    @foreach ($encours_cheque as $item)
                                        <tr>
                                            <td>{{ $item->reference }}</td>
                                            <td>{{ $item->montant }}</td>
                                            <td>{{ $item->devise }}</td>
                                            <td>{{ $item->numbord }}</td>
                                            <td>{{ $item->date }}</td>
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
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucun encours chèque.
            </div>
        @endif
    </div>
</div>