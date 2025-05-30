@extends('layout.app')

@section('title', 'Informations Utilisateur')

@push('styles')
  @vite('resources/css/searchabledropdown.css')   
@endpush

@section('content')

<div class="container-fluid">
    <div class="card mt-4">
      <div class="card-body">
        <form action="{{url('user/'.$user->id.'/agence')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <h3 class="text-center mb-4">Informations Personelles</h3>
          <div class="form-section">
            <div class="form-row">
                <div class="row g-4">
                    <div class="col-4">
                        <label class="form-label fw-bold">Nom d'utilisateur :</label>
                        <input type="text" class="form-control-plaintext" readonly value="{{ $user->name }}" readonly>
                    </div>
                    <div class="col-4">
                        <label class="form-label fw-bold">Matricule : </label>
                        <input type="text" class="form-control-plaintext" name="username" value="{{$user->username}}" readonly>              
                    </div>
                    <div class="col-4">
                        <label class="form-label fw-bold">Email :</label>
                        <input type="email" class="form-control-plaintext" name="mail" value="{{$user->mail}}" readonly>
                    </div>
                </div>
            </div>
          </div>
          <hr>
          <h3 class="text-center mb-4">Agence</h3>
          <div class="form-section">
            <div class="form-row">
                <div class="row g-3">
                    <div class="col-3"></div>
                    <div class="col-6">
                      <div class="custom-select-wrapper" data-name="agence_id">
                        <input type="text" class="form-control custom-select-input" placeholder="Rechercher une agence..." readonly value="{{ optional($user->agence)->designation }}">
                        <div class="custom-select-options d-none">
                          <div class="custom-option" data-value="">Aucune agence</div>
                          @foreach($agences as $ag)
                            <div class="custom-option" data-value="{{ $ag->id }}">{{ $ag->designation }}</div>
                          @endforeach
                        </div>
                        <input type="hidden" name="agence_id" value="{{ $user->agence_id }}">
                      </div>                                     
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
          </div>
            
            
            <div class="form-row">
              
          </div>

          <div class="form-section">
            <h5>Dates</h5>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Créé le</label>
                <input type="text" class="form-control" value="{{$user->created_at}}" readonly>
              </div>
              <div class="form-group col-md-4">
                <label>Mis à jour le</label>
                <input type="text" class="form-control" value="{{$user->updated_at}}" readonly>
              </div>
              <div class="form-group col-md-4">
                <label>Dernière connexion</label>
                <input type="text" class="form-control" value="{{$user->last_seen}}" readonly>
              </div>
            </div>
          </div>

          <div class="form-section">
            <h5>Rôles & Permissions</h5>
            <div class="form-group">
              <label>Rôles</label>
              <select class="form-control select2" multiple name="roles[]">
                @foreach($roles as $role)
                  <option value="{{$role->name}}" @if($user->hasRole($role->name)) selected @endif>{{$role->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Permissions via rôles</label>
              <select class="form-control select2" multiple disabled>
                @foreach($user->getPermissionsViaRoles() as $perm)
                  <option selected>{{$perm->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Permissions directes</label>
              <select class="form-control select2" multiple name="permissions[]">
                @foreach($permissions as $permission)
                  <option value="{{$permission->name}}" @if($user->hasAnyDirectPermission($permission->name)) selected @endif>{{$permission->name}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
          </div>
        </form>

      </div>
    </div>
  </div>


@endsection
@push('scripts')
    @vite('resources/js/users.js')
@endpush