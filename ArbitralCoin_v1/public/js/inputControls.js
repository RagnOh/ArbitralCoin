function checkPreferences(button)
{
    deposito = $("#depositAmount");
    valutaPreferita = $("#favooriteValute");
    minGuadagno = $("#minGain");

    console.log('ok1');

    if(button=="Save")
    {
    

        console.log('ok');
            $('form[name=userPreferences]').submit();

      
}

}