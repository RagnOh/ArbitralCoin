


$(document).ready(function(){

    
    function updateTable()
    {
    $.ajax('\ajaxUpdateTable',{

       
        type:'GET',
        success: function(data){
            
           
            console.log(data);
            $('#pairTable tbody').empty();

            
            $.each(data,function(index,pair){

                console.log(pair);
                
                var newRow = '<tr>' +
                   '<td>' + pair['pair']+ '</td>' +
                   '<td>' + pair['binance'] + '</td>' +
                   '<td>' + pair['kraken'] + '</td>' +
                   '<td>' + pair['crypto']+ '</td>' +
                   '<td>' + pair['mockup']+ '</td>' +
                  '</tr>';


                
                $('#pairTable tbody').append(newRow);
                
        });
        
    },
    error: function() {
        console.log('Si è verificato un errore durante la richiesta.');
      }
    });
    }

    


    setInterval(updateTable,5000);

});
