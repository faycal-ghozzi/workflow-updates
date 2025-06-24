<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Crédits</h5>
    </div>
    <div class="card-body">
        @if(!empty($credits[0]->reference))
            <div class="form-group">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>Référence</th>
                                <th>Libellé</th>
                                <th>Category</th>
                                <th>Encours</th>
                                <th>Date Echéance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($credits as $item)
                                <tr>
                                    <td>{{ $item->reference ?? '--' }}</td>
                                    <td>{{ $item->libelle ?? '--' }}</td>
                                    <td>{{ $item->category ?? '--' }}</td>
                                    <td>{{ $item->encours ?? '--' }}</td>
                                    <td>{{ $item->date ?? '--' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucun crédit trouvée.
            </div>
        @endif
    </div>
</div>        