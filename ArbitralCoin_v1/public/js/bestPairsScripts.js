
$(document).ready(function(){

function updateBestPairsTable()
    {
        $.ajax('\ajaxUpdateBestPairs',{

       
            type:'GET',
            success: function(data){

                $.each(data,function(index,pair){

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