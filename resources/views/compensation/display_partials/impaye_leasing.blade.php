<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Impayé Leasing - 3017</h5>
    </div>
    <div class="card-body">
        @if(!empty($impaye_leasing))
            <div class="form-group">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>Numéro Compte</th>
                                <th>Solde</th>
                                <th>Devise</th>
                                <th>Date d'ouverture</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($impaye_leasing as $imp)
                                <tr>
                                    <td>{{ $imp->num_compte ?? '--' }}</td>
                                    <td>{{ $imp->solde ?? '--' }}</td>
                                    <td>{{ $imp->currency ?? '--' }}</td>
                                    <td>{{ $imp->opening_date ?? '--' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucun impayé Leasing trouvée.
            </div>
        @endif
    </div>
</div>        