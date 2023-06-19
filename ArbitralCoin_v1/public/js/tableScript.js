
$(document).ready(function(){

    function updateTable()
    {
    $.ajax('\ajaxUpdateTable',{

       
        type:'GET',
        success: function(data){
            
            
            $('#pairTable tbody').empty();

            $.each(data,function(index,pair){

                var newRow = '<tr>' +
                   '<td>' + pair[0]+ '</td>' +
                   '<td>' + pair[1] + '</td>' +
                   '<td>' + pair[2] + '</td>' +
                   '<td>' + pair[3]+ '</td>' +
                  '</tr>';

                $('#pairTable tbody').append(newRow);
                
        });
        
    },
    error: function() {
        console.log('Si è verificato un errore durante la richiesta.');
      }
    });
    }

    


    setInterval(updateTable,8000);

});
