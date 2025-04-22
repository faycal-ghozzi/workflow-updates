<h5>Informations sur le Client</h5>

<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-4">
                <label><span class="text-danger">*</span>Est-ce qu'il a d'autres sociétés :</label>
                <div class="form-group">
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="interdit_chq_ben" id="interdit_chq_ben_oui" value="oui" required>
                        <label class="form-check-label">Oui</label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="interdit_chq_ben" id="interdit_chq_ben_non" value="non">
                        <label class="form-check-label">Non</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Situation des sociétés du client avec la banque :</label>
                    <input type="text" name="situation_banque_ben" class="form-control" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Situation du gérant et le client avec la banque :</label>
                    <input type="text" name="situation_agent_benf" class="form-control" />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" id="addSC">
    <div class="col-4">
        <label>code :</label>
        <input type="text" name="code_autre_sc" class="form-control " id="code_autre_sc" disabled/>
    </div>
    <div class="col-4">
        <label>Nom :</label>
        <input type="text" name="nom_autre_sc" class="form-control " id="nom_autre_sc" disabled/>
    </div>
    <div class="col-4">
        <label>Activité :</label>
        <input type="text" name="activite_autre_sc" class="form-control " id="activite_autre_sc" disabled/>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>Engagement sur le SED :</label>
            <div class="custom-file">
                <input type="file" name="engagement_sed_ben" class="custom-file-input" id="engagement_sed_ben" accept=".pdf" disabled>
                <label class="custom-file-label" for="engagement_sed_ben"></label>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>Classement :</label>
            <div class="custom-file">
                <input type="file" name="classement_ben" class="custom-file-input" id="classement_ben" accept=".pdf" disabled>
                <label class="custom-file-label" for="classement_ben"></label>
            </div>
        </div>
    </div>
</div>