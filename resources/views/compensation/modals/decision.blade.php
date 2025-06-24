<div class="modal fade" id="modal_decision_{{ $role }}_{{ $compensation->id }}" tabindex="-1" aria-labelledby="modalLabel_{{ $role }}_{{ $compensation->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content rounded-3 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="modalLabel_{{ $role }}_{{ $compensation->id }}">Avis par {{ $label }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url($action) }}" method="POST" class="forms-sample">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="compensation_id" value="{{ $compensation->id }}">
                    <textarea class="form-control" name="text_avis" rows="3" placeholder="Donner votre avis .." required></textarea>
                </div>
                <div class="modal-footer justify-content-between border-0">
                    <button type="submit" name="{{ $submitName }}" value="favorable" class="btn btn-success">Favorable</button>
                    <button type="submit" name="{{ $submitName }}" value="defavorable" class="btn btn-danger">Défavorable</button>
                </div>
            </form>
        </div>
    </div>
</div>
