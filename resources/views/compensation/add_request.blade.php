@extends('layout.app')

@section('title', 'Ajout Nouvelle Fiche Compensation')

@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <form class="forms-sample" action="{{url('/compensation/store/ws')}}" method="POST" enctype="multipart/form-data" id="submit_form">
        @csrf
            <input type="hidden" name="client_code" value="{{ $id_client }}">
            <input type="hidden" name="account_number" value="{{ $account }}">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Noveau Fichier</h4>
                <button type="submit" class="btn btn-success" id="submit_button">
                    Enregistrer
                </button>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <ul class="nav nav-tabs" id="ws-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#informations_generales"  data-type="informations_generales">Informations Générales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#compensation"  data-type="compensation">Compensation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#client"  data-type="client">Client</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#derniere_compensation"  data-type="derniere_compensation">Dernière Compensation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#beneficiaire"  data-type="beneficiaire">Bénéficiaire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#commentaires"  data-type="commentaires">Commentaires</a>
                    </li>
                    {{-- Web service ne retourne pas les comptes du client --}}
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#comptes_client"  data-type="comptes_client">Comptes Client</a>
                    </li>
                </ul>

                <div class="tab-content mt-3">
                    <div class="tab-pane fade" id="informations_generales">
                    </div>
        
                    <div class="tab-pane fade" id="compensation">
                    </div>
        
                    <div class="tab-pane fade" id="client">
                    </div>
        
                    <div class="tab-pane fade" id="derniere_compensation">
                    </div>
        
                    <div class="tab-pane fade" id="beneficiaire">
                    </div>
        
                    <div class="tab-pane fade" id="commentaires">
                    </div>
        
                    <div class="tab-pane fade" id="comptes_client">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    @vite('resources/js/compensation/demande-compensation.js')
    @vite('resources/js/components/fileInput.js')
    @vite('resources/js/compensation/client-section-toggle.js')
    @vite('resources/js/compensation/table-row-insertion.js')
@endpush
