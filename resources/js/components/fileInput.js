import $ from 'jquery';

$(document).ready(function () {
    $('.file-upload').on('change', function () {
        let fileName = this.files[0]?.name || 'Aucun fichier choisi';
        $(this).closest('.file-input-wrapper').find('.file-name-display').val(fileName);
    });
});