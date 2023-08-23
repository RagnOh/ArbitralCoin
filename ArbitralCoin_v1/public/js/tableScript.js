


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

    


    setInterval(checkStatus,1000);

});
