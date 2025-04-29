<div class="d-flex align-items-center gap-1"></div>
    <a class="btn btn-info btn-sm me-1" href="{{ url('/compensation/display/'.$comp->id) }}" title="Voir">
        <i class="fa fa-eye"></i>
    </a>
    
    <a class="btn btn-warning btn-sm me-1" href="{{ url('/compensation/edit/'.$comp->id) }}" title="Modifier">
        <i class="fa fa-pen"></i>
    </a>
    
    @if (Auth::user()->hasRole('Chef_agence') || Auth::user()->hasRole('admin'))
        <button class="btn btn-danger btn-sm me-1" data-toggle="modal" data-target="#compensation_delete_{{$comp->id}}" title="Supprimer">
            <i class="fa fa-trash"></i>
        </button>
    @endif
    <div class="btn-group">
        <button class="btn btn-default btn-sm dropdown-toggle dropdown-toggle-split"
            data-bs-toggle="dropdown"
        >
            <span>Plus d'options</span>
        </button>
        <ul class="dropdown-menu">
            <li>
                <a class="btn btn-default btn-sm me-1" href="{{-- url('/viewCompensation/print/'.$comp->id) --}}">Vision Global</a>
            </li>
            <li>
                <a class="btn btn-default btn-sm me-1" href="{{-- url('/viewCompensation/print_fiche/'.$comp->id) --}}">Fiche détaillée</a>
            </li>
        </ul>
    </div>
</div>