<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Chiffre d'affaires confié</h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="chiffre_ans_preced" class="form-label fw-bold">Année Précédente :</label>
                <input type="text" name="chiffre_ans_preced" id="chiffre_ans_preced" class="form-control-plaintext" value="{{ $ca_n_1 }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="chiffre_ans_encours" class="form-label fw-bold">Année Courante :</label>
                <input type="text" name="chiffre_ans_encours" id="chiffre_ans_encours" class="form-control-plaintext" value="{{ $ca_n }}" readonly>
            </div>
        </div>
    </div>
</div>