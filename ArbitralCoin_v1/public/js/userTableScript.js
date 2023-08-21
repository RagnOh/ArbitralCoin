$(document).ready(function(){

    function updateTable()
    {
    $.ajax('\ajaxUpdateUserTable',{

       
        type:'GET',
        success: function(data){
            
            
            $('#userTable tbody').empty();

            $.each(data,function(index,user){

                var newRow = '<tr>' +
                   '<td>' + user["username"]+ '</td>' +
                   '<td>' + user["email"] + '</td>' +
                   '<td>' + user["pagante"] + '</td>' +
                   '<td><button class="delete-button">Delete</button></td>'+
                  '</tr>';

                $('#userTable tbody').append(newRow);
               // $('.delete-button').on('click', function() {
                   // $(this).closest('tr').remove();
                //});

                $('.delete-button').on('click', function() {
                    var row = $(this).closest('tr');
                    var username = row.find('td:first').text(); // Assuming the first column is the username
                    
                    $.ajax({
                        
                        url: "/adminUserList/" + username + "/destroy/confirm",
                        method: "GET",

                        data:{userName: username},
                        
                        success: function(response) {
                            window.location.href = "/adminUserList/" + username + "/destroy/confirm";
                            row.remove();
                        },
                        error: function(error) {
                            console.log("Error deleting user: " + error.responseText);
                        }
                    });
                });
                
        });
        
    },
    error: function() {
        console.log('Si è verificato un errore durante la richiesta.');
      }
    });
    }

    setInterval(updateTable,1000);

});