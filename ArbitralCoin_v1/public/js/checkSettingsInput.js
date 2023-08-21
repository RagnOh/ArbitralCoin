function checkSettingsInput() {

    binanceInput= $("form[id=user-pref] input[name=Binance]");
    krakenInput= $("form[id=user-pref] input[name=Kraken]");
    cryptoInput= $("form[id=user-pref] input[name=Crypto]");
    depositInput=$("form[id=user-pref] input[name=depositAmount]");
    valutaInput=$("form[id=user-pref] input[name=favoriteValute]");
    minGainInput=$("form[id=user-pref] input[name=minGain]");
    
    regSwitch_msg = $("#invalid-Switch");
    regDeposit_msg = $("#invalid-deposit");
    regValuta_msg = $("#invalid-valuta");
    regGain_msg = $("#invalid-gain");

    switchvalue=0;

    error= false;
    if (depositInput.val().trim() === "")
    {
        regDeposit_msg.html("The deposit field must not be empty");
        depositInput.focus();
        error = true;
    } else {
        regDeposit_msg.html("");
    }

    if (valutaInput.val().trim() === "")
    {
        regValuta_msg.html("The valuta field must not be empty");
        valutaInput.focus();
        error = true;
    } else {
        regValuta_msg.html("");
    }

    if (minGainInput.val().trim() === "")
    {
        regGain_msg.html("The min guadagno field must not be empty");
        minGainInput.focus();
        error = true;
    } else {
        regGain_msg.html("");
    }

    if (binanceInput.is(':checked'))
    {
        
        switchvalue=switchvalue+1;
    }
    if (krakenInput.is(':checked'))
    {
        
        switchvalue=switchvalue+1;
    }
    if (cryptoInput.is(':checked'))
    {
        switchvalue=switchvalue+1;
        
    }

    if (switchvalue < 3)
    {
        regSwitch_msg.html("you need at least 2 exchanges");
        
        error = true;
    } else {
        regSwitch_msg.html("");
        console.log('no' + switchvalue); 
    }

    if(!error)
    {
        $('form[id=user-pref]').submit();
    }
    

    

    



}