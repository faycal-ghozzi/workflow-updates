@extends('layout.app')
@section('title', 'Tableau de Bord')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Tableau de Bord</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h5>Bienvenue, {{ Auth::user()->name }}!</h5>
                            <p>Voici un aperçu de vos activités récentes.</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <p>Date actuelle : {{ now()->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <hr>
                    {{-- @include('dashboard.partials.overview') --}}
                    <hr>
                    {{-- @include('dashboard.partials.recent_activities') --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
            
