function checkRegistrationData() {
    registrationName = $("form[id=register-form] input[name=name]");
    registrationEmail = $("form[id=register-form] input[name=email]");
    registrationPasswd = $("form[id=register-form] input[name=password]");
    registrationPasswdRepeat = $("form[id=register-form] input[name=confirm-password]");

    regName_msg = $("#invalid-registrationName");
    regEmail_msg = $("#invalid-registrationEmail");
    regPasswd_msg = $("#invalid-registrationPasswd");
    passwdConfirm_msg = $("#invalid-passwdConfirm");

    var emailRegularExpression = new RegExp(/^[A-Za-z0-9]+(\.[A-Za-z0-9]+)*@[A-Za-z0-9-]+\.[A-Za-z]{2,3}$/, "g");
    error = false;

    if (registrationName.val().trim() === "")
    {
        regName_msg.html("The registration name field must not be empty");
        registrationName.focus();
        error = true;
    } else {
        regName_msg.html("");
    }

    if (registrationEmail.val().trim() === "")
    {
        regEmail_msg.html("The registration email field must not be empty");
        error = true;
    } else if(!registrationEmail.val().trim().match(emailRegularExpression))
    {
        regEmail_msg.html("Wrong registration email");
        error = true;
    } else {
        regEmail_msg.html("");
    }

    if (registrationPasswd.val().trim() === "")
    {
        regPasswd_msg.html("The password field must not be empty");
        error = true;
    } else if(registrationPasswd.val().length < 8) {
        regPasswd_msg.html("The password must have a length of at least 8 characters");
        error = true;
    } else {
        regPasswd_msg.html("");
    }

    if((registrationPasswdRepeat.val().trim === "")||(registrationPasswdRepeat.val() != registrationPasswd.val()))
    {
        passwdConfirm_msg.html("This field does not match with the password field");
        error = true;
    } else {
        passwdConfirm_msg.html("");
    }

    if(!error) {
        var controllo=0;
        $.ajax('/registrationEmailCheck', {

            method: 'GET',

            data: {email: registrationEmail.val().trim()},

            success: function (result) {

                if (result.found)
                {
                    error = true;
                    regEmail_msg.html("This email already exists in the database");
                } else {
                    controllo=controllo+1;
                }
            }

        });   

        $.ajax('/registrationUsernameCheck', {

            method: 'GET',

            data: {email: registrationName.val().trim()},

            success: function (result) {

                if (result.found)
                {
                    error = true;
                    regName_msg.html("This username already exists in the database");
                } else {
                    if(controllo==1){
                        $('form[id=register-form]').submit();
                    }
                }
            }

        }); 
        
        
    }
}