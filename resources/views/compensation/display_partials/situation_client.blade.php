<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Situation Client</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label fw-bold">Interdit de chéquier ?</label>
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="interdit_chq_client" id="interdit_chq_client_oui" value="oui" @if($view_comp->interdit_chq_client =='oui') checked @endif disabled>
                                <label class="form-check-label">Oui</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="interdit_chq_client" id="interdit_chq_client_non" value="non" @if($view_comp->interdit_chq_client =='non') checked @endif disabled>
                                <label class="form-check-label">Non</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 conditional-inputs d-none interdit-fields row">
                        <div class="col-6">
                            <label class="form-label fw-bold">Date d'interdiction</label>
                            <input type="text" name="interdit_chq_client_date" placeholder="jj/mm/AAAA" class="form-control" value="{{ $view_comp->interdit_chq_client_date}}" disabled>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold">Nombre</label>
                            <input type="number" name="interdit_chq_client_nombre" class="form-control" value="{{ $view_comp->interdit_chq_client_nombre}}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label fw-bold">Impayé dans le secteur ?</label>
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="montant_non_paye" id="montant_non_paye_oui" value="oui" @if($view_comp->montant_non_paye =='oui') checked @endif disabled>
                                <label class="form-check-label">Oui</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="montant_non_paye" id="montant_non_paye_non" value="non" @if($view_comp->montant_non_paye =='non') checked @endif disabled>
                                <label class="form-check-label">Non</label>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label fw-bold">Dépassement sur les engagements ?</label>
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="depassement" id="depassement_oui" value="oui" @if($view_comp->depassement =='oui') checked @endif disabled>
                                <label class="form-check-label">Oui</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="depassement" id="depassement_non" value="non" @if($view_comp->depassement =='non') checked @endif disabled>
                                <label class="form-check-label">Non</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label fw-bold">Etat Financier fournie ?</label>
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="liste_finance_final" id="liste_finance_final_oui" value="oui" @if($view_comp->liste_finance_final =='oui') checked @endif disabled>
                                <label class="form-check-label">Oui</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="liste_finance_final" id="liste_finance_final_non" value="non"  @if($view_comp->liste_finance_final =='non') checked @endif disabled>
                                <label class="form-check-label">Non</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 conditional-inputs finance-fields d-none row">
                        <div class="col-6">
                            <label class="form-label fw-bold">Année</label>
                            <input type="number" name="annee_etat_financier" id="annee_etat_financier" value="{{ $view_comp->annee_etat_financier}}" class="form-control" disabled>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold">Type</label>
                            <select class="form-control" name="type_etat_financier" id="type_etat_financier" value="{{ $view_comp->type_etat_financier}}" disabled>
                                <option value=""> </option>
                                <option value="provisoire">Provisoire</option>
                                <option value="certifié">Certifié</option>
                                <option value="définitif">Définitif</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label fw-bold">Rapport commissaire au compte ?</label>
                        <div class="form-group">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="liste_finance_rapport" id="liste_finance_rapport_oui" value="oui" @if($view_comp->liste_finance_rapport =='oui') checked @endif disabled>
                                <label class="form-check-label">Oui</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="radio" name="liste_finance_rapport" id="liste_finance_rapport_non" value="non" @if($view_comp->liste_finance_rapport =='non') checked @endif disabled>
                                <label class="form-check-label">Non</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 conditional-inputs rapport-fields d-none row">
                        <div class="col-6">
                            <label class="form-label fw-bold">Année</label>
                            <input type="number" name="anneecommissaire" id="anneecommissaire" class="form-control" value="{{ $view_comp->anneecommissaire}}" disabled>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold">Réserve</label>
                            <div class="form-group">
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="liste_finance_rapport_reserve" id="liste_finance_rapport_reserve_oui" value="oui"  @if($view_comp->liste_finance_rapport_reserve =='oui') checked @endif disabled>
                                    <label class="form-check-label">Oui</label>
                                </div>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="liste_finance_rapport_reserve" id="liste_finance_rapport_reserve_non" value="non"  @if($view_comp->liste_finance_rapport_reserve =='oui') checked @endif disabled>
                                    <label class="form-check-label">Non</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mt-4">
                <label class="form-label fw-bold">Chiffre d'affaire global N</label>
                <input type="number" step="any" name="nb_transaction" id="nb_transaction" value="{{ $view_comp->nb_transaction }}" class="form-control" disabled>

                <label class="form-label fw-bold" class="mt-3">Résultat net N</label>
                <input type="number" step="any" name="resultat_brut" id="resultat_brut" value="{{ $view_comp->resultat_brut }}" class="form-control" disabled>
            </div>

            <div class="col-md-6 mt-4">
                <label class="form-label fw-bold">Chiffre d'affaire global N-1</label>
                <input type="number" step="any" name="chiffre_n" id="chiffre_n" value="{{ $view_comp->chiffre_n }}" class="form-control" disabled>

                <label class="form-label fw-bold" class="mt-3">Résultat net N-1</label>
                <input type="number" step="any" name="resultat_n" id="resultat_n" value="{{ $view_comp->resultat_n }}" class="form-control" disabled>
            </div>
        </div>
    </div>
</div>