<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Autre Comptes Client</h5>
    </div>
    <div class="card-body">
        @if (!empty($autre_comptes[0]->num_compte))
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm">
                            <thead class="table-dark">
                                <th>Numéro Compte</th>
                                <th>Balance</th>
                                <th>Catégorie</th>
                            </thead>
                            <tbody>
                                @foreach ($autre_comptes as $item)
                                    <tr>
                                        <td>{{ $item->num_compte }}</td>
                                        <td>{{ $item->montant }}</td>
                                        <td>{{ $item->category }}</td>
                                    </tr>    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucun autre compte trouvé pour ce client.
        </div>
        @endif
    </div>
</div>
