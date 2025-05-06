<div class="card shadow-sm rounded-4 mb-4">
    <div class="card-header bg-success bg-gradient text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-info-circle-fill me-2"></i>Justifications d'agence pour payer la compensation
        </h5>
        <button type="button" class="btn btn-light btn-sm text-primary d-none add-justif-row">
            <i class="fa fa-plus me-1"></i> Ajouter
        </button>
    </div>
    <div class="card-body">
        <div id="justif_empty_state" class="text-center my-4">
            <button type="button" class="btn btn-primary bg-gradient add-justif-row">
                <i class="fa fa-plus me-1"></i> Ajouter une justification
            </button>
        </div>

        <div class="table-responsive d-none" id="justif_table_container">
            <table class="table align-middle" id="tab_justif">
                <thead>
                    <tr>
                        <th>Promesses</th>
                        <th>Montant</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="justif_body">
                    <!-- Rows dynamically added here -->
                </tbody>
                <tfoot>
                    <tr>
                        <td class="text-center text-danger fw-bold">Total des justifications</td>
                        <td colspan="2">
                            <input id="Total_justif" name="justification" type="text"
                                   class="form-control input-md" placeholder="0" readonly>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
