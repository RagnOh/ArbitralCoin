function checkPairInput() {

    pairInput= $("form[id=addMockup] input[name=pairName]");
    priceInput=$("form[id=addMockup] input[name=price]");
    
    regInput_msg = $("#invalid-Input");
    regPrice_msg = $("#invalid-price");
    error= false;
    if (pairInput.val().trim() === "")
    {
        regInput_msg.html("The pair name field must not be empty");
        pairInput.focus();
        error = true;
    } else {
        regInput_msg.html("");
    }

    if (!jQuery.isNumeric(priceInput.val()))
    {
        regPrice_msg.html("The price field must be positive");
        priceInput.focus();
        error = true;
    } else {
        regPrice_msg.html("");
    }

    if (priceInput.val().trim() === "")
    {
        regPrice_msg.html("The price field must not be empty");
        priceInput.focus();
        error = true;
    } else {
        regPrice_msg.html("");
    }

    if(!error) {
        $.ajax('/adminMockupCheck', {

            method: 'GET',

            data: {pairName: pairInput.val().trim()},

            success: function (result) {

                if (result.found)
                {
                    $('form[id=addMockup]').submit();
                   
                } else {
                    error = true;
                    regInput_msg.html("This pair doesnt exist");
                }
            }

        });   
    }


}