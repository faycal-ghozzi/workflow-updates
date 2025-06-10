@extends('layout.app')

@section('title', 'Informations Utilisateur')

@push('styles')
  @vite('resources/css/users.css')   
@endpush

@section('content')

<div class="container-fluid">
    <div class="card mt-4">
      <div class="card-body">
        <form action="{{ url('user/'.$user->id.'/update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ url('/users') }}" class="btn btn-outline-secondary">
                ← Retour
            </a>
            <h3 class="m-0 text-center flex-grow-1">Informations Personelles</h3>
            <div style="width: 90px;"></div> 
        </div>
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
            
          <hr>
          <h3 class="text-center mb-4">Rôles & Permissions</h3>
          <div class="form-section">
            <h5 class="text-center mb-4">Rôles</h5>
            <div class="form-group">
              <div class="custom-multiselect" id="role-selector">
                <div class="available-items">
                  @foreach($roles as $role)
                    @if(!$user->hasRole($role->name))
                      <span class="custom-pill" data-value="{{ $role->name }}">{{ $role->name }}</span>
                    @endif
                  @endforeach
                </div>
                <hr>
                <div class="selected-items mt-2">
                  @foreach($user->roles as $role)
                    <span class="custom-pill selected" data-value="{{ $role->name }}">
                      {{ $role->name }} <span class="remove">&times;</span>
                      <input type="hidden" name="roles[]" value="{{ $role->name }}">
                    </span>
                  @endforeach
                </div>
              </div>
            </div>
            <br>
            <h5 class="text-center mb-4">Permissions</h5>
            <div class="form-group">
              <div class="custom-multiselect readonly">
                <div class="selected-items">
                  @foreach($user->getPermissionsViaRoles() as $perm)
                    <span class="custom-pill readonly">{{ $perm->name }}</span>
                  @endforeach
                </div>
              </div>
            </div>
            <br>
            <h5 class="text-center mb-4">Permissions directes</h5>
            <div class="form-group">
              <div class="custom-multiselect" id="permission-selector">
                <div class="available-items">
                  @foreach($permissions as $perm)
                    @if(!$user->hasAnyDirectPermission($perm->name))
                      <span class="custom-pill" data-value="{{ $perm->name }}">{{ $perm->name }}</span>
                    @endif
                  @endforeach
                </div>
                <div class="selected-items mt-2">
                  @foreach($user->getDirectPermissions() as $perm)
                    <span class="custom-pill selected" data-value="{{ $perm->name }}">
                      {{ $perm->name }} <span class="remove">&times;</span>
                      <input type="hidden" name="permissions[]" value="{{ $perm->name }}">
                    </span>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          <br><br>
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
          </div>
          <br><br>
        </form>

      </div>
    </div>
  </div>


@endsection
@push('scripts')
    @vite('resources/js/users.js')
@endpush