@if (Auth::user()->hasRole($role) && $showIf)
    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal_decision_{{ $key }}_{{ $compensation->id }}">
        Avis
    </button>
@endif