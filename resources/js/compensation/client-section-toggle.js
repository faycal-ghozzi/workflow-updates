import $ from 'jquery';

$(document).ready(function () {
    console.log('Client section toggle script loaded.');
    function toggleFields(radioName, wrapperSelector) {
        $(document).on('change', `input[name="${radioName}"]`, function () {
            const isYes = $(this).val() === 'oui';

            console.log(`Radio "${radioName}" changed to "${isYes ? 'oui' : 'non'}"`);

            const $wrapper = $(wrapperSelector);
            const $inputs = $wrapper.find('input, select');

            if(isYes){
                $wrapper.removeClass('d-none').addClass('d-flex');
                $inputs.prop('disabled', false);
            }else{
                $wrapper.removeClass('d-flex').addClass('d-none');
                $inputs.prop('disabled', true);
            }
        });
    }

    toggleFields('interdit_chq_client', '.interdit-fields');

    toggleFields('liste_finance_final', '.finance-fields');

    toggleFields('liste_finance_rapport', '.rapport-fields');

    toggleFields('interdit_chq_ben', '.autres-societes-fields');

    $('input[type="radio"]:checked').trigger('change');
});


