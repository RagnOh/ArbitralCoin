
$(document).ready(function(){

function updateBestPairsTable()
    {
        $.ajax('\ajaxUpdateBestPairs',{

       
            type:'GET',
            success: function(data){

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