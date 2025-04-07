import 'datatables.net';
import 'datatables.net-bs5'
import { datatableFrConfig } from './datatables/config';
import $ from 'jquery';

$(document).ready(function() {
    $("#liste-compensation").DataTable(datatableFrConfig);
})
