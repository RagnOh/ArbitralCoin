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
                   '<td><button class="delete-button">Delete</button></td>'+
                  '</tr>';

                $('#userTable tbody').append(newRow);
                $('.delete-button').on('click', function() {
                    $(this).closest('tr').remove();
                });

                $('.delete-button').on('click', function() {
                    var userId = $(this).data('user-id');
                    var $row = $(this).closest('tr'); // Memorizza la riga da eliminare
                
                    var csrfToken = '<?php echo $_SESSION[csrf_token]; ?>'; // Ottieni il token dalla sessione
                    $.ajax({
                        url: '/deleteUser', // Inserisci il percorso del tuo file PHP
                        method: 'POST',
                        data: { user_id: userId },
                        success: function(username) {
                            // Utilizza l'username ottenuto dalla risposta
                            $row.remove();
                            console.log('User deleted:', username);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
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