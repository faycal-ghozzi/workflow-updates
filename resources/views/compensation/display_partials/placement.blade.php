<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Placement</h5>
    </div>
    <div class="card-body">
        @if(!empty($placement))
            <div class="form-group">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>Référence</th>
                                <th>Nature</th>
                                <th>Montant</th>
                                <th>Devise</th>
                                <th>Du</th>
                                <th>Au</th>
                                <th>Taux</th>
                                <th>Base TMM</th>
                                <th>Marge Variable</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($placement as $plc)
                                <tr>
                                    <td>{{ $plc->reference ?? '--' }}</td>
                                    <td>{{ $plc->nature ?? '--' }}</td>
                                    <td>{{ $plc->montant ?? '--' }}</td>
                                    <td>{{ $plc->devise ?? '--' }}</td>
                                    <td>{{ $plc->du ?? '--' }}</td>
                                    <td>{{ $plc->au ?? '--' }}</td>
                                    <td>{{ $plc->taux ?? '--' }}</td>
                                    <td>{{ $plc->basetmm ?? '--' }}</td>
                                    <td>{{ $plc->marge ?? '--' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Aucun placement trouvée.
            </div>
        @endif
    </div>
</div>        