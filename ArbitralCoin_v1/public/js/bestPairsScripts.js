
$(document).ready(function(){

    var alertShown = false;

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

    setInterval(updateBestPairsTable,1000);
});