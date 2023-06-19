
$(document).ready(function(){

function updateBestPairsTable()
    {
        $.ajax('\ajaxUpdateBestPairs',{

       
            type:'GET',
            success: function(data){

                $('#bestTable tbody').empty();
                $.each(data,function(index,pair){

                    var newRow = '<tr>' +
                    '<td>' + pair[0]+ '</td>' +
                    '<td>' + pair[0] + '</td>' +
                    '<td>' + pair[2] + '</td>' +
                   '</tr>';
 
                 $('#bestTable tbody').append(newRow);
                

                    console.log(pair);

                });
            },
            error: function(){
                console.log('error');
                
            }
            });
    }

    setInterval(updateBestPairsTable,5000);
});