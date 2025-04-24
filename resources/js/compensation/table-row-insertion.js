// Impayé

let impayeIndex = 0;

function createImpayeRow(index) {
    return `
        <tr id="impaye${index}">
            <td><input type="text" name="impaye_client[${index}][nature_impaye]" class="form-control" placeholder="Nature"></td>
            <td><input type="number" name="impaye_client[${index}][montant_impaye]" class="form-control" placeholder="Montant"></td>
            <td><input type="text" name="impaye_client[${index}][devise_impaye]" class="form-control" placeholder="Devise"></td>
            <td><button type="button" class="btn btn-danger btn-sm remove-impaye" data-id="${index}">
                <i class="fa fa-trash"></i>
            </button></td>
        </tr>
    `;
}

function toggleImpayeTableVisibility() {
    const hasRows = $('#impaye_body tr').length > 0;
    $('#impaye_table_container').toggleClass('d-none', !hasRows);
    $('#impaye_empty_state').toggleClass('d-none', hasRows);
    $('#add_row_impaye').toggleClass('d-none', !hasRows);
}

function addImpayeRow() {
    $('#impaye_body').append(createImpayeRow(impayeIndex));
    impayeIndex++;
    toggleImpayeTableVisibility();
}

$(document).on('click', '#add_row_impaye, #add_row_impaye_empty', addImpayeRow);

$(document).on('click', '.remove-impaye', function () {
    const rowId = $(this).data('id');
    $(`#impaye${rowId}`).remove();
    toggleImpayeTableVisibility();
});

// Compensation

let compensationIndex = 0;

function updateCompUIState() {
    const hasRows = $('#comp_body tr').length > 0;
    $('#comp_empty_state').toggleClass('d-none', hasRows);
    $('#comp_table_container').toggleClass('d-none', !hasRows);
    $('.add-comp-row').first().toggleClass('d-none', !hasRows);
}

function sumCompensation() {
    let sum = 0;
    $('.net').each(function () {
        const val = parseFloat($(this).val());
        if (!isNaN(val)) sum += val;
    });

    $('#Total_TTC').val(sum);

    const soldeActuel = parseFloat($('#solde_comp').val() || 0);
    const soldeApres = soldeActuel - sum;
    $('#solde_apres').val(soldeApres);
}

function createCompensationRow(index) {
    return `
        <tr id="addr${index}">
            <td>
                <input type="text" name="type_compensation[${index}][name]"
                       class="form-control" placeholder="Type de compensation" required>
            </td>
            <td>
                <input type="text" name="type_compensation[${index}][beneficiare]"
                       class="form-control" placeholder="Bénéficiaire" required>
            </td>
            <td>
                <input type="number" step="any" name="type_compensation[${index}][value]"
                       class="form-control net" placeholder="Montant" required>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-comp-row" data-id="${index}">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    `;
}

$(document).on('click', '.add-comp-row', function () {
    $('#comp_body').append(createCompensationRow(compensationIndex++));
    updateCompUIState();
    sumCompensation();
});

$(document).on('input', '.net', sumCompensation);

$(document).on('click', '.remove-comp-row', function () {
    $(this).closest('tr').remove();
    updateCompUIState();
    sumCompensation();
});

// Commentaires

let justifIndex = 0;

function updateJustifUIState() {
    const hasRows = $('#justif_body tr').length > 0;
    $('#justif_empty_state').toggleClass('d-none', hasRows);
    $('#justif_table_container').toggleClass('d-none', !hasRows);
    $('.add-justif-row').first().toggleClass('d-none', !hasRows);
}

function sumJustif() {
    let sum = 0;
    $('.justif').each(function () {
        const val = parseFloat($(this).val());
        if (!isNaN(val)) sum += val;
    });
    $('#Total_justif').val(sum);
}

function createJustifRow(index) {
    return `
        <tr id="just${index}">
            <td>
                <textarea name="justification_comp[${index}][name_justification_update]"
                          class="form-control" placeholder="Justification"></textarea>
            </td>
            <td>
                <input type="number" step="any" name="justification_comp[${index}][value]"
                       class="form-control justif" placeholder="Montant" required>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-justif-row" data-id="${index}">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    `;
}

$(document).on('click', '.add-justif-row', function () {
    $('#justif_body').append(createJustifRow(justifIndex++));
    updateJustifUIState();
    sumJustif();
});

$(document).on('input', '.justif', sumJustif);

$(document).on('click', '.remove-justif-row', function () {
    $(this).closest('tr').remove();
    updateJustifUIState();
    sumJustif();
});
