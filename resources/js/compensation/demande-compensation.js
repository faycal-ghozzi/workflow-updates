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

    const table = document.getElementById('tableGerant');
    const cardGerant = document.getElementById('cardGerant');
    const hrGerant = document.getElementById('hrGerant');

    if (table && cardGerant) {
        if (table.rows.length !== 1) {
            hrGerant.classList.remove('d-none').add('d-flex');
            cardGerant.classList.remove('d-none').add('d-flex');
        } else {
            cardGerant.classList.remove('d-flex').add('d-none');
            hrGerant.classList.remove('d-flex').add('d-none');
        }
    }
});