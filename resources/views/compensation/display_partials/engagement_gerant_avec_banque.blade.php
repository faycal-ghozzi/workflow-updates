<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Engagement du Gérant avec la Banque</h5>
    </div>
    <div class="card-body">
        @if(!empty($engagement_gerant))
            <div class="form-group">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>Code</th>
                                <th>Nom</th>
                                <th>Client de la banque</th>
                                <th>Classement</th>
                                <th>Engagement</th>
                                <th>Libelle</th>
                                <th>Date d'echeance</th>
                                <th>Encours</th>
                                <th>Devise</th>
                                <th>Encours en TND</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($engagement_gerant as $item)
                                <tr>
                                    <td>{{ $item->code_gerant ?? '--' }}</td>
                                    <td>{{ $item->nom_gerant ?? '--' }}</td>
                                    <td>{{ $item->client ?? '--' }}</td>
                                    <td>{{ $item->classement ?? '--' }}</td>
                                    <td>{{ $item->engagement ?? '--' }}</td>
                                    <td>{{ $item->type_eng_gerant ?? '--' }}</td>
                                    <td>{{ $item->date_eng_gerant ?? '--' }}</td>
                                    <td>{{ $item->montant_eng_gerant ?? '--' }}</td>
                                    <td>{{ $item->devise ?? '--' }}</td>
                                    <td>{{ $item->encours_tnd ?? '--' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucun engagement gérant trouvée.
            </div>
        @endif
    </div>
</div>
        