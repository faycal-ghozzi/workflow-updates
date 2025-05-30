@extends('layout.app')

@section('title', 'Liste des Utilisateurs')

@section('content')

<div class="container mt-4">
    <h4 class="mb-3">Liste des Utilisateurs</h4>

    <div class="table-responsive">
        <table id="liste-utilisateurs" class="table table-bordered table-striped table-sm">
            <thead class="table-dark">
                <tr>
                    <th>Nom & Prénom</th>
                    <th>Agence</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            {{ $user->name . ' ' . $user->last_name }}
                        </td>
                        <td>{{ $agencyHelper->getAgencyName(Auth::user()->agence_id) }}</td>
                        <td>
                            <a href="{{ route('users.show', ['id' => $user->id]) }}" class="btn btn-sm btn-info">Show</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
