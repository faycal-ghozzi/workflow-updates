import 'datatables.net';
import 'datatables.net-bs5'
import { datatableFrConfig } from './datatables/config';
import $ from 'jquery';

// $(document).ready(function() {
//     $("#liste-compensation").DataTable(datatableFrConfig);
// })

$('#liste-compensation').DataTable({
    ...datatableFrConfig,
    rowCallback: function(row, data, index){
        if ($(row).hasClass('no-search')) {
            return;
        }
    }
});

