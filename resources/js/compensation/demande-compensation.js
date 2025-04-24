import $ from 'jquery';

$(document).ready(function() {
    const STORAGE_KEY = 'compensation_form_data';

    let savedData = {}

    try {
        const rawData = localStorage.getItem(STORAGE_KEY);
        savedData = rawData ? JSON.parse(rawData) : {};
    }catch(e) {
        console.error('Error parsing JSON:', e);
        savedData = {}
    }

    for(const key in savedData){
        const field = document.querySelector(`[name=${key}]`);
        if(field){
            field.value = savedData[key];
        }
    }

    $('#submit_form').on('input change', 'input select, textarea', function() {
        const key = this.name;
        const value = this.value;
        let currentData = JSON.parse(localStorage.getItem(STORAGE_KEY) || '{}');
        currentData[key] = value;
        localStorage.setItem(STORAGE_KEY, JSON.stringify(currentData));
    });

    $('#ws-tabs .nav-link').on('click', function () {
        const targetId = $(this).attr('href').substring(1);
        const type = $(this).data('type');
        const container = $('#' + targetId);

        if(!container.hasClass('loaded')){
            const clientCode = $('[name="client_code"]').val();
            const accountNumber = $('[name="account_number"]').val();
            
            container.html('<div class="text-center py-4"><div class="spinner-border"></div><p>Chargement...</p></div>');

            $.ajax({
                url: `/compensation/wsdata/${type}`,
                method: 'GET',
                data: {
                    id_client: clientCode,
                    account: accountNumber
                },
                success: function(data){
                    container.html(data);
                    container.addClass('loaded');
                },
                error: function(){
                    container.html('<p class="text-danger">Erreur de chargement des données.</p>');
                }
            });
        }
    });

    $('#submit_form').submit(function() {
        $('#submit_button').attr('disabled', true).text('Veuillez patienter...');
        localStorage.removeItem(STORAGE_KEY);
    });

});

// import $ from 'jquery';

// $('#submit_form').submit(function(){
//     // Disable the submit button
//     $('#submit_button').attr('disabled', true);
//     // Change the "Submit" text
//     $('#submit_button').prop('value', 'Please wait...');
//     return true;
// });

// $(document).ready(function () {

//     const dateInput = document.getElementById('dateSys');

//     // ✅ Using the visitor's timezone
//     dateInput.value = formatDate();

//     console.log(formatDate());

//     function padTo2Digits(num) {
//     return num.toString().padStart(2, '0');
//     }

//     function formatDate(date = new Date()) {
//     return [
//         date.getFullYear(),
//         padTo2Digits(date.getMonth() + 1),
//         padTo2Digits(date.getDate()),
//     ].join('-');
//     }
//     //document.getElementById('dateSys').value = formatDate();

//     function numStr(a, b) {
//     a = '' + a;
//     b = b || ' ';
//     var c = '',
//     d = 0;
//     while (a.match(/^0[0-9]/)) {
//        a = a.substr(1);
//     }
//     for (var i = a.length-1; i >= 0; i--) {
//        c = (d != 0 && d % 3 == 0) ? a[i] + b + c : a[i] + c;
//        d++;
//     }
//     return c;
// }
// // a = numStr(1000000000);
// // console.log(a);

// //gérant
// if(document.getElementById('tableGerant').rows.length !== 1){
//     document.getElementById('credit_particulier_gerant').disabled = false;
//     document.getElementById('classement_gerant').disabled = false;
//     document.getElementById('cheque_impaye_gerant').disabled = false;
//     }else{
//     document.getElementById('credit_particulier_gerant').disabled = true;
//     document.getElementById('classement_gerant').disabled = true;
//     document.getElementById('cheque_impaye_gerant').disabled = true;
// }

// //interdit de chèquier client
// $(function () {
//     $("input[name='interdit_chq_client']").click(function () {
//         console.log("radio checked !");
//         if($("#interdit_chq_client_oui").is(":checked")) {
//             document.getElementById('interdit_chq_client_date').disabled = false;
//             document.getElementById('interdit_chq_client_nombre').disabled = false;
//         }else{
//             document.getElementById('interdit_chq_client_date').disabled = true;
//             document.getElementById('interdit_chq_client_nombre').disabled = true;
//         }
//     });
// });


// //Etat financier
// $(function () {
//     $("input[name='liste_finance_final']").click(function () {
//         console.log("radio checked !");
//         if($("#liste_finance_final_oui").is(":checked")) {
//             document.getElementById('annee_etat_financier').disabled = false;
//             document.getElementById('type_etat_financier').disabled = false;
//         }else{
//             document.getElementById('annee_etat_financier').disabled = true;
//             document.getElementById('type_etat_financier').disabled = true;
//         }
//     });
// });

// //Etat financier
// document.getElementById('liste_finance_rapport_reserve_oui').disabled = true;
// document.getElementById('liste_finance_rapport_reserve_non').disabled = true;

// $(function () {
//     $("input[name='liste_finance_rapport']").click(function () {
//         console.log("radio checked !");
//         if($("#liste_finance_rapport_oui").is(":checked")) {
//             document.getElementById('anneecommissaire').disabled = false;
//             document.getElementById('liste_finance_rapport_reserve_oui').disabled = false;
//             document.getElementById('liste_finance_rapport_reserve_non').disabled = false;

//         }else{
//             document.getElementById('anneecommissaire').disabled = true;
//             document.getElementById('liste_finance_rapport_reserve_oui').disabled = true;
//             document.getElementById('liste_finance_rapport_reserve_non').disabled = true;
//         }
//     });
// });


// //d'autre société ?
// $(function () {
//     $("input[name='interdit_chq_ben']").click(function () {
//         console.log("radio checked !");
//         if($("#interdit_chq_ben_oui").is(":checked")) {
//             document.getElementById('code_autre_sc').disabled = false;
//             document.getElementById('nom_autre_sc').disabled = false;
//             document.getElementById('activite_autre_sc').disabled = false;
//             document.getElementById('engagement_sed_ben').disabled = false;
//             document.getElementById('classement_ben').disabled = false;

//         }else{
//             document.getElementById('code_autre_sc').disabled = true;
//             document.getElementById('nom_autre_sc').disabled = true;
//             document.getElementById('activite_autre_sc').disabled = true;
//             document.getElementById('engagement_sed_ben').disabled = true;
//             document.getElementById('classement_ben').disabled = true;
//         }
//     });
// });


//     function sumCount() {
//         var sum = 0;
//         $('.net').each(function () {
//             sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
//         });
//         document.getElementById('Total_TTC').value = sum;
//     }

//     function sumCountJustif() {
//         var sum1 = 0;
//         $('.justif').each(function () {
//             sum1 += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
//         });
//         document.getElementById('Total_justif').value = sum1;
//     }

//     if (!i) {
//         var i = 0;
//     }

//     $("#add_row").on('click', function () {
//         $('#addr' + i).append("<td><input type='text' name='type_compensation[" + i + "][name]' class='form-control input-md' placeholder='Type de compensation' required/></td>");
//         $('#addr' + i).append("<td><input type='text' name='type_compensation[" + i + "][beneficiare]' class='form-control input-md' placeholder='Bénéficiare' required/></td>");
//         $('#addr' + i).append("<td><input type='number' step='any' name='type_compensation[" + i + "][value]' class='form-control input-md net' placeholder='Montant' id='value' required/></td>");
//         $('#addr' + i).append("<td><button class=\"btn btn-danger\" id='delete" + i + "'><i class='fa fa-trash'></i></button></td>");

//         $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');

//         $('.net').on("change", function() {
//             var sum = 0;
//             $('.net').each(function () {
//                 sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
//             });
//             document.getElementById('Total_TTC').value = sum;
//             document.getElementById('compensation_val').value = sum;
//             console.log(sum);


//         solde_actu = document.getElementById('solde_comp').value;
//         document.getElementById('solde_apres').value = solde_actu - sum;
//         });


//         $('#delete' + i).on('click', function () {
//             $(this).parent().parent().remove();
//             sumCount();
//         });
//         i++;
//     });


//     if (!j) {
//         var j = 0;
//     }

//     $("#add_row_just").on('click', function () {
//         $('#just' + j).append("<td><textarea type='text' name='justification_comp[" + j + "][name_justification_update]' class='form-control input-md' placeholder='Justification'></textarea></td>");
//         $('#just' + j).append("<td><input type='number' step='any' name='justification_comp[" + j + "][value]' class='form-control input-md justif' placeholder='Montant' id='value'/></td>");
//         $('#just' + j).append("<td><button class=\"btn btn-danger\" id='delete_just" + j + "'><i class='fa fa-trash'></i></button></td>");

//         $('#tab_justif').append('<tr id="just' + (j + 1) + '"></tr>');

//         $('.justif').on("change", function() {
//             var sum1 = 0;
//             $('.justif').each(function () {
//                 sum1 += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
//             });
//             document.getElementById('Total_justif').value = sum1;
//             console.log(sum1);
//         });

//         $('#delete_just' + j).on('click', function () {
//             $(this).parent().parent().remove();
//             sumCountJustif();
//         });
//         j++;
//     });


//     if (!m) {
//         var m = 0;
//     }

//     $("#add_row_impaye").on('click', function () {
//         $('#impaye' + m).append("<td><input type='text' name='impaye_client[" + m + "][nature_impaye]' class='form-control input-md' placeholder='Nature'/></td>");
//         $('#impaye' + m).append("<td><input type='number' name='impaye_client[" + m + "][montant_impaye]' class='form-control input-md' placeholder='Montant'/></td>");
//         $('#impaye' + m).append("<td><input type='text' name='impaye_client[" + m + "][devise_impaye]' class='form-control input-md' placeholder='Devise' id='value'/></td>");
//         $('#impaye' + m).append("<td><button class=\"btn btn-danger\" id='delete" + m + "'><i class='fa fa-trash'></i></button></td>");

//         $('#tab_impaye').append('<tr id="impaye' + (m + 1) + '"></tr>');

//         $('#delete' + m).on('click', function () {
//             $(this).parent().parent().remove();
//         });
//         m++;
//     });

// });