import 'datatables.net';
import 'datatables.net-bs5'
import { datatableLanguage } from './datatables/config';
import $ from 'jquery';

$('#liste-compensation').DataTable({
    language: datatableLanguage
});

$('#historique-compensation').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '/compensation/historique',
        type: 'GET',
        error: function(xhr, error, thrown) {
            console.error('DataTables AJAX error:', xhr.status, xhr.responseText);
            alert('Erreur AJAX : ' + xhr.status + ' - ' + xhr.statusText);
        }
    },
    columns: [
        { data: 'code_client' },
        { data: 'nom_client' },
        { data: 'date_compensation' },
        { data: 'agency_name' },
        { data: 'status', orderable: false, searchable: false },
        { data: 'actions', orderable: false, searchable: false }
    ],
    language: datatableLanguage
});

let table = $('#liste-extrait').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '/compensation/extrait',
        data: function (d) {
            d.start_date = $('#start_date').val();
            d.end_date = $('#end_date').val();
        }
    },
    columns:[
        {data: 'code_client'},
        {data: 'nom_client'},
        {data: 'date_compensation'},
        {data: 'code_agence'},
        {data: 'status', orderable: false, searchable: false},
    ],
    language: datatableLanguage
});

$('#filterBtn').on('click', function () {
    table.ajax.reload();
});

$('#resetBtn').on('click', function () {
    $('#start_date').val('');
    $('#end_date').val('');
    table.ajax.reload();
});


$('#liste-etat-journalier').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '/compensation/etat_journalier',
        type: 'GET',
        error: function (xhr, error, thrown) {
            console.error('DataTables error:', error, thrown);
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'code_client', name: 'code_client' },
        { data: 'account_number', name: 'account_number' },
        { data: 'nom_client', name: 'nom_client' },
        { data: 'name_secteur', name: 'name_secteur' },
        { data: 'classement_client', name: 'classement_client' },
        { data: 'solde_compensation', name: 'solde_compensation' },
        { data: 'date_compensation', name: 'date_compensation' },
        { data: 'updated_at', name: 'updated_at' },
        { data: 'code_agence', name: 'code_agence' },
        { data: 'total_debit', name: 'total_debit' },
        { data: 'status', name: 'status', orderable: false },
        { data: 'dernier_avis', name: 'dernier_avis' }
    ],
    dom: 'Bfrtip',
    buttons: ['print', 'excel'],
    language: datatableLanguage
});
