@php

    $fileInputs = [
            ['label' => 'Engagement sur le SED', 'name' => 'engagement_sed_ben'],
            ['label' => 'Classement', 'name' => 'classement_ben']
        ];
@endphp

<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i>Informations sur le Client</h5>
    </div>
    <div class="card-body">
        <div class="row gy-3">
            <div class="col-md-12">
                <label class="form-label fw-bold"><span class="text-danger">*</span>Est-ce que le client a d'autres sociétés ?</label>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="interdit_chq_ben" id="interdit_chq_ben_oui" value="oui" required>
                        <label class="form-check-label" for="interdit_chq_ben_oui">Oui</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="interdit_chq_ben" id="interdit_chq_ben_non" value="non">
                        <label class="form-check-label" for="interdit_chq_ben_non">Non</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Situation des sociétés du client avec la banque</label>
                <input type="text" name="situation_banque_ben" class="form-control" />
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Situation du gérant et le client avec la banque</label>
                <input type="text" name="situation_agent_benf" class="form-control" />
            </div>
        </div>

        <div class="row gy-3 mt-3 autres-societes-fields d-none flex-wrap">
            <div class="col-md-4">
                <label class="form-label fw-bold">Code</label>
                <input type="text" name="code_autre_sc" class="form-control" id="code_autre_sc" disabled />
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Nom</label>
                <input type="text" name="nom_autre_sc" class="form-control" id="nom_autre_sc" disabled />
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Activité</label>
                <input type="text" name="activite_autre_sc" class="form-control" id="activite_autre_sc" disabled />
            </div>

            @foreach($fileInputs as $file)
                <div class="col-md-6">
                    <label for="{{ $file['name'] }}" class="form-label fw-bold mb-2">{{ $file['label'] }}</label>
                    <x-file-input :name="$file['name']" :disabled="true" />
                </div>
            @endforeach
        </div>
    </div>
</div>
