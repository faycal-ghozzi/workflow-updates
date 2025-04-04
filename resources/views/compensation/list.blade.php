@extends('layout.app')

@section('title', 'Liste des Compensations')

@section('content')
<div class="container mt-4">

    <h4 class="mb-3">
        @if($hasAgency)
            Compensations de votre agence
        @else
            Toutes les compensations
        @endif
    </h4>

    {{-- Résumé des Statuts --}}
    <div class="mb-4">
        <strong>Total :</strong> {{ $counts->total }} |
        <span class="text-warning">🕓 Attente : {{ $counts->attent }}</span> |
        <span class="text-success">✔ Accepté : {{ $counts->accept }}</span> |
        <span class="text-danger">❌ Refusé : {{ $counts->refuse }}</span>
    </div>

    {{-- Tableau des Compensations --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Référence</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>Agence</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($compensations as $comp)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $comp->ref_comp }}</td>
                        <td>{{ $comp->nom_client }}</td>
                        <td>{{ number_format($comp->montant, 2, ',', ' ') }}</td>
                        <td>{{ $comp->Agence_function->nom_agence ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($comp->date_compensation)->format('d/m/Y') }}</td>
                        <td>
                            @switch($comp->status_final)
                                @case(1)
                                    <span class="badge bg-warning text-dark">En attente</span>
                                    @break
                                @case(2)
                                    <span class="badge bg-success">Accepté</span>
                                    @break
                                @case(3)
                                    <span class="badge bg-danger">Refusé</span>
                                    @break
                                @default
                                    <span class="badge bg-secondary">-</span>
                            @endswitch
                        </td>
                        <td>
                            {{-- <a href="{{ route('compensation.show', $comp->id) }}" class="btn btn-sm btn-outline-primary">Voir</a> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Aucune compensation trouvée pour cette date.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $compensations->links() }}
    </div>
</div>
@endsection

