function checkPairInput() {

    pairInput= $("form[id=favPairInsert] input[name=insertPair]");
    
    regInput_msg = $("#invalid-Input");

    error= false;
    if (pairInput.val().trim() === "")
    {
        regInput_msg.html("The pair name field must not be empty");
        pairInput.focus();
        error = true;
    } else {
        regInput_msg.html("");
    }

    if(!error) {
        $.ajax('/favPairsCheckPair', {

            method: 'GET',

            data: {insertPair: pairInput.val().trim()},

            success: function (result) {

                if (result.found)
                {
                    $('form[id=favPairInsert]').submit();
                   
                } else {
                    error = true;
                    regInput_msg.html("The pair doesnt exist or is already inside the table");
                }
            }

        });   
    }


}