@extends('layout.app')

@section('title', 'État Journalier')

@section('content')
<div class="container mt-4">

    <h4 class="mb-3">
        État Journalier
    </h4>

    <div class="table-responsive">
        @if($compensations->isEmpty())
            <div class="alert alert-info text-center">
                Aucun extrait trouvée.
            </div>
        @else
            <table id="liste-compensation" class="table table-bordered table-striped table-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Code client</th>
                        <th>Nom client</th>
                        <th>Date</th>
                        <th>Agence</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($compensations as $comp)
                        @php
                            $status = \App\Helpers\StatusHelper::getStatusLabel($comp->status);
                        @endphp
                        <tr>
                            <td>{{ $comp->code_client }}</td>
                            <td>{{ $comp->nom_client }}</td>
                            @if($comp->date_compensation !== NULL)
                                <td>{{ $comp->date_compensation->format('d-m-Y') }}</td>
                            @else                        
                                <td>**-**-****</td>
                            @endif
                            <td>
                                <x-agency-designation :agenceId="$comp->code_agence" />
                            </td>
                            <td>
                                @if($status)
                                    <span class="badge text-bg-{{ $status['badge'] }}">
                                        {{ $status['label'] }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $compensations->onEachSide(1)->links('pagination::bootstrap-5') }}  <!-- This renders the pagination links 
            </div>
        @endif
    </div>

</div>
@endsection

@push('scripts')
    @vite('resources/js/compensation.js')
@endpush
