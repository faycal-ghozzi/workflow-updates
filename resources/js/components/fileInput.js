import $ from 'jquery';

$(document).on('change', '.file-upload', function () {
    const fileName = $(this).val().split('\\').pop();
    const fileInputId = $(this).attr('id');
    const labelInput = $(`#label_${fileInputId}`);

    if(labelInput.length) {
        labelInput.val(fileName);
    }else{
        console.warn('no match', fileInputId);
    }
});