$(document).ready(function() {

    function validateEmail(email){
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email)
    }

    function toggleButtonState(){
        const emailValue = $('#email-benef').val();
        const isValid = validateEmail(emailValue);

        if(isValid){
            $('#check-email').prop('disabled', false);
        }else{
            $('#check-email').prop('disabled', true);
        }
    }

    $('#email-benef').on('blur', function(){
        const emailClient = $(this).val();
        const codeClient = $('#code_client').val();

        if(emailClient.trim() === "" || !validateEmail(emailClient)){
            alert("Entrer une adresse e-mail s'il vous plaît")
            return;
        }

        toggleButtonState();

        $.ajax({
            url: '/update-client-email',
            type: 'POST',
            data: {
                email_client: emailClient,
                code_client: codeClient
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                console.log(response.success);
            },
            error : function(xhr, status, error){
                console.log(xhr.responseJSON);
                console.log(xhr.responseText);
            }
        })
    })
})