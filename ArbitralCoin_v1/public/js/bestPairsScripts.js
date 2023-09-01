
$(document).ready(function(){

    var alertShown = false;

    function checkStatus(){

        $.ajax('\ajaxCheckUpdate',{

       
            type:'GET',
            success: function(data){
                
                
               
                console.log(data);
                $.each(data,function(index,p){
                    console.log(p['done']);
                    if(p['done']==1){
                        updateBestPairsTable();
                    }
                    /*else{
                        $('#bestTable tbody').empty();
                        var loading= '<div class="spinner-border" role="status">'+
                        '<span class="visually-hidden">Loading...</span>'+
                      '</div>';
                        $('#bestTable tbody').append(loading);
                    }*/
                });
            },
            error: function() {
                console.log('Si è verificato un errore durante la richiesta.');
              }
            });
    }


function updateBestPairsTable()
    {
        $.ajax('\ajaxUpdateBestPairs',{

       
            type:'GET',
            success: function(data){

                if (!alertShown && data.length === 0) {
                    alert('Nessun risultato, modifica le tue preferenze');
                    alertShown = true; // Imposta la variabile su true per evitare ulteriori alert
                    return;
                }

                $('#bestTable tbody').empty();
                $.each(data,function(index,pair){

                    var newRow = '<tr>' +
                    '<td>' + pair['pair']+ '</td>' +
                    '<td>' + pair['primo'] + '</td>' +
                    '<td>' + pair['ultimo'] + '</td>' +
                    '<td>' + pair['guadagno'] + '</td>' +
                   '</tr>';
 
                 $('#bestTable tbody').append(newRow);
                

                    

                });
            },
            error: function(){
                console.log('error');
                
            }
            });
    }

    setInterval(checkStatus,1000);
});