<div class="modal fade" id="modal_decision_{{ $role }}_{{ $compensation->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Avis par {{ $label }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url($action) }}" method="POST" class="forms-sample">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="compensation_id" value="{{ $compensation->id }}">
                    <textarea class="form-control" name="text_avis" rows="3" placeholder="Donner votre avis .." required></textarea>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" name="{{ $submitName }}" value="favorable" class="btn btn-success">Favorable</button>
                    <button type="submit" name="{{ $submitName }}" value="defavorable" class="btn btn-danger">Défavorable</button>
                </div>
            </form>
        </div>
    </div>
</div>
