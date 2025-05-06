<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Encours impayé client</h5>
    </div>
    <div class="card-body">
        @if(!empty($engagement_gerant))
            <div class="form-group">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="table-dark">
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
                            @foreach($impaye_besoin as $imp)
                                <tr>
                                    <td>{{ $imp->ref ?? '--' }}</td>
                                    <td>{{ $imp->nature_besoin ?? '--' }}</td>
                                    <td>{{ $imp->valeur_besoin ?? '--' }}</td>
                                    <td>{{ $imp->devise ?? '--' }}</td>
                                    <td>{{ $imp->mantant_tnd ?? '--' }}</td>
                                    <td>{{ $imp->echeance_besoin ?? '--' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucun impayé trouvée.
            </div>
        @endif
    </div>
</div>

{{-- TODO : ajouter total impayé en dessous du tableau --}}
        