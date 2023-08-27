


$(document).ready(function(){


    function checkStatus(){

        $.ajax('\ajaxCheckUpdate',{

       
            type:'GET',
            success: function(data){
                
               
                console.log(data);
                $.each(data,function(index,p){
                    console.log(p['done']);
                    if(p['done']==1){
                        updateTable();
                    }
                });
            },
            error: function() {
                console.log('Si è verificato un errore durante la richiesta.');
              }
            });
    }
    
    function updateTable()
    {
    $.ajax('\ajaxUpdateTable',{

       
        type:'GET',
        success: function(data){
            
           
           
            $('#pairTable tbody').empty();

            
            $.each(data,function(index,pair){

                
                var newRow= '<tr>'+'<td>' + pair['pair']+ '</td>';

                if (pair['binance'] !== 0) {
                    newRow += '<td>' + pair['binance'] + '</td>';
                } else {
                    $('#pairTable th[id="binancehead"]').remove();
                }
        
                if (pair['kraken'] !== 0) {
                    newRow += '<td>' + pair['kraken'] + '</td>';
                } else {
                    $('#pairTable th[id="krakenhead"]').remove();
                }
        
                if (pair['crypto'] !== 0) {
                    newRow += '<td>' + pair['crypto'] + '</td>';
                } else {
                    $('#pairTable th[id="cryptohead"]').remove();
                }
        
                newRow += '<td>' + pair['mockup'] + '</td>';
                newRow += '</tr>';
                
               


                
                $('#pairTable tbody').append(newRow);
                
        });
        
    },
    error: function() {
        console.log('Si è verificato un errore durante la richiesta.');
      }
    });
    }

    


    setInterval(checkStatus,1000);

});
