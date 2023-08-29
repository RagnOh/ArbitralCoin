function checkMailInput(){

    mailInput=$("form[id=rinnovoAbbo] input[name=insertMail]");
    
    regMailInput_msg = $("#invalid-Input");

    error= false;
    if (mailInput.val().trim() === "")
    {
        regMailInput_msg.html("The mail field must not be empty");
        mailInput.focus();
        error = true;
    } else {
        regMailInput_msg.html("");
    }

    if(!error) {
        $.ajax('/checkMail-transaction', {

            method: 'GET',

            data: {userMail: mailInput.val().trim()},

            success: function (result) {

                if (result.found)
                {
                    $('form[id=rinnovoAbbo]').submit();
                   
                } else {
                    error = true;
                    regMailInput_msg.html("This mail doesnt exist");
                }
            }

        });   
    }




}