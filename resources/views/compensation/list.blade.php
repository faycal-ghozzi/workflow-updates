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
        <table id="liste-compensation" class="table table-bordered table-striped table-sm">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Nom / Raison sociale</th>
                    <th>Date</th>
                    <th>Agence</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($compensations as $comp)
                   @php
                        $status = \App\Helpers\StatusHelper::getStatusLabel($comp->status);
                    @endphp

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $comp->code_client }}</td>
                        <td>{{ $comp->nom_client }}</td>
                        @if($comp->date_compensation !== NULL)
                            <td>{{ $comp->date_compensation->format('d-m-Y') }}</td>
                        @else                        
                            <td>**-**-****</td>
                        @endif
                        <td>{{ $comp->Agence_function->designation ?? '-' }}</td>
                        <td>
                            @if($status)
                                <span class="badge badge-{{ $status['badge'] }}">
                                    {{ $status['label'] }}
                                </span>
                            @endif
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
    {{-- <div class="d-flex justify-content-center mt-3">
        {{ $compensations->links() }}
    </div> --}}
</div>
@endsection

@push('scripts')
    @vite('resources/js/compensation.js')
@endpush