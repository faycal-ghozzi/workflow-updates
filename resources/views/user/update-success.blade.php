@extends('layout.app')

@section('title', 'Modification Réussie')

@section('content')
<div class="container mt-5">
    <div class="alert alert-success text-center">
        <h4 class="mb-3">✅ {{ $message }}</h4>
        <p>Les informations de l'utilisateur <strong>{{ $user->name }}</strong> ont été mises à jour avec succès.</p>
        <button class="btn btn-outline-secondary mt-3" id="go-back">Retour</button>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('go-back').addEventListener('click', function () {
        window.location.href = "{{ url('/users') }}";
    });

    setTimeout(() => {
        window.location.href = "{{ url('/users') }}";
    }, 5000);
</script>
@endpush
