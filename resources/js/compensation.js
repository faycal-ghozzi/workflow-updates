import 'datatables.net';
import 'datatables.net-bs5'
import { datatableLanguage } from './datatables/config';
import $ from 'jquery';

$('#liste-compensation').DataTable({
    language: datatableLanguage
});

$('#liste-extrait').DataTable({
    processing: true,
    serverSide: true,
    ajax: '/compensation/extrait/data',
    columns:[
        {data: 'code_client'},
        {data: 'nom_client'},
        {data: 'date_compensation'},
        {data: 'code_agence'},
        {data: 'status', orderable: false, searchable: false},
    ],
    language: datatableLanguage
})

$('#liste-etat-journalier').DataTable({
    processing: true,
    serverSide: true,
    ajax: 'compensation/etat_journalier/data',
    columns: [
        { data: 'code_client' },
        { data: 'account_number' },
        { data: 'nom_client' },
        { data: 'name_secteur' },
        { data: 'classement_client' },
        { data: 'solde_compensation' },
        { data: 'date_compensation' },
        { data: 'val_compensation' },
        { data: 'status', orderable: false, searchable: false },
        { data: 'code_agence' }
    ],
    language: datatableLanguage
});
