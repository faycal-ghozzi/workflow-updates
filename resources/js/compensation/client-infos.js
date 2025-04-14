function openModalWithClientData(clientCode, isSuccess = true) {
    const searchButton = $('#modalSearchButtonContainer button');
    const clientCodeInput = $('#clientCodeInput');
    const accountNumber = document.getElementById('accountNumber').value;
    document.getElementById('accountNumberInput').value = accountNumber;

    if (isSuccess) {
        $('#modalMessage').html('<div class="alert alert-success">Client trouvé avec succès !</div>');
        clientCodeInput.val(clientCode);  
        $('#clientCodeContainer').show();  
        $('#modalSearchButtonContainer').show();  
        searchButton.prop('disabled', false);
    } else {
        $('#modalMessage').html('<div class="alert alert-danger">Aucun client trouvé pour ce numéro de compte.</div>');
        clientCodeInput.val('');  
        $('#clientCodeContainer').hide();  
        $('#modalSearchButtonContainer').hide(); 
    }

    const modal = new bootstrap.Modal(document.getElementById('clientModal'));
    modal.show();
}

async function getClientIDWebserviceCall(accountNumber) {
    if (!accountNumber || accountNumber.length !== 10 || isNaN(accountNumber)) {
        throw new Error('Le numéro de compte doit être un nombre à 10 chiffres.');
    }

    try {
        const response = await fetch(`/compensation/get_client/check/${encodeURIComponent(accountNumber)}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
        });

        if (!response.ok) {
            throw new Error(`Erreur serveur: ${response.status}`);
        }

        const data = await response.json();

        console.log('SOAP Response:', data);

        if (data && data.CUSTOMER) {
            return { success: true, clientCode: data.CUSTOMER };
        } else {
            return { success: false };
        }
    } catch (error) {
        console.error('Erreur AJAX :', error.message);
        throw new Error('Erreur serveur.');
    }
}

function handleSearch() {
    const accountNumber = $('#accountNumber').val().trim();

    if (!accountNumber) {
        alert('Veuillez entrer un numéro de compte.');
        return;
    }

    if (accountNumber.length !== 10 || isNaN(accountNumber)) {
        alert('Le numéro de compte doit être un nombre à 10 chiffres.');
        return;
    }

    getClientIDWebserviceCall(accountNumber).then(response => {
        if (response.success) {
            openModalWithClientData(response.clientCode, true);
        } else {
            openModalWithClientData('', false);
        }
    }).catch(error => {
        console.error('Error during fetch:', error);
        openModalWithClientData('', false);
    });
}

$('#searchButton').on('click', function() {
    handleSearch();
});

$('#accountNumber').on('blur', function() {
    const value = $(this).val().trim();
    if (value !== '') {
        handleSearch();
    }
});
