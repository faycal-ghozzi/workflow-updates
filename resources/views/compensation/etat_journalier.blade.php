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
                Aucun état trouvée pour cette date.
            </div>
        @else
            <table id="liste-compensation" class="table table-bordered table-striped table-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Code client</th>
                        <th>Num compte</th>
                        <th>Nom client</th>
                        <th>Secteur</th>
                        <th>Classement</th>
                        <th>Solde actuel</th>
                        <th>Date de création</th>
                        <th>Date de validation</th>
                        <th>Agence</th>
                        <th>Total débit (compensation + impayé à payer)</th>
                        <th>Status</th>
                        <th>Dernier avis</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($compensations as $comp)
                        @php
                            $status = \App\Helpers\StatusHelper::getStatusLabel($comp->status);
                        @endphp
                        <tr>
                            <td>{{ $comp->code_client }}</td>
                            <td>{{ $comp->account_number }}</td>
                            <td>{{ $comp->nom_client }}</td>
                            <td>{{ $comp->name_secteur }}</td>
                            <td>{{ $comp->classement_client }}</td>
                            <td>{{ $comp->solde_compensation }}</td>
                            @if($comp->date_compensation !== NULL)
                                <td>{{ $comp->date_compensation->format('d-m-Y') }}</td>
                            @else                        
                                <td>**-**-****</td>
                            @endif
                            <td>{{ $comp->updated_at }}</td>
                            <td>
                                <x-agency-designation :agenceId="$comp->code_agence" />
                            </td>
                            <td>
                                @php
                                    $val_compensation = $comp->val_compensation;
                                    $impaye_client = $comp->impaye_client()->sum('montant_impaye');
                                    $total = $val_compensation + $impaye_client;
                                @endphp
                                @if($total)
                                    {{ $total }}
                                @endif
                            </td>
                            <td>
                                @if($status)
                                    <span class="badge text-bg-{{ $status['badge'] }}">
                                        {{ $status['label'] }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @php
                                $lastAvisBeforeDate = $comp->avis_comp
                                    ->where('created_at', '<=', $comp->updated_at)
                                    ->sortByDesc('created_at')
                                    ->first();
                                @endphp
                                
                                @if($lastAvisBeforeDate)
                                    {{ $lastAvisBeforeDate->text_avis }}
                                @endif
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        @endif
    </div>

</div>
@endsection

@push('scripts')
    @vite('resources/js/compensation.js')
@endpush
