<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Incidents de paiment (non régularisé)</h5>
    </div>
    <div class="card-body">
        @if(!empty($incidents))
            <div class="form-group">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>Référence</th>
                                <th>Numéro chèque</th>
                                <th>Code présentation</th>
                                <th>Montant</th>
                                <th>Devise</th>
                                <th>Date d'emission</th>
                                <th>RIB Bénéficiaire</th>
                                <th>Nom Bénéficiaire</th>
                                <th>Motif rejet</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($incidents as $incident)
                                <tr>
                                    <td>{{ $incident->ref ?? '--' }}</td>
                                    <td>{{ $incident->num_chq ?? '--' }}</td>
                                    <td>{{ $incident->code_presentation ?? '--' }}</td>
                                    <td>{{ $incident->montant ?? '--' }}</td>
                                    <td>{{ $incident->currency ?? '--' }}</td>
                                    <td>{{ $incident->date_emission ?? '--' }}</td>
                                    <td>{{ $incident->rib_benef ?? '--' }}</td>
                                    <td>{{ $incident->nom_benef ?? '--' }}</td>
                                    <td>{{ $incident->motif_rejet ?? '--' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
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