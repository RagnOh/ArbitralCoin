$(document).ready(function(){

    function updateBestPairsTable()
        {
            $.ajax('\ajaxGetFavList',{
    
           
                type:'GET',
                success: function(data){
    
                    $('#bestTable tbody').empty();
                    $.each(data,function(index,pair){
    
                        var newRow = '<tr>' +
                        '<td>' + pair['pair']+ '</td>' +
                        '<td>' + pair['binance'] + '</td>' +
                        '<td>' + pair['kraken'] + '</td>' +
                        '<td>' + pair['cryptocom'] + '</td>' +
                        '<td><button class="delete-button">Delete</button></td>'+
                       '</tr>';
     
                     $('#bestTable tbody').append(newRow);
                     $('.delete-button').on('click', function() {
                        $(this).closest('tr').remove();
                    });

                    $('.delete-button').on('click', function() {
                        var row = $(this).closest('tr');
                        var pair = row.find('td:first').text(); // Assuming the first column is the username
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "/favPairs/" + pair,
                            method: "DELETE",
                            data: {
                                _token: csrfToken
                            },
                            success: function(response) {
                                row.remove();
                            },
                            error: function(error) {
                                console.log("Error deleting user: " + error.responseText);
                            }
                        });
                    });
                    
    
                        console.log(pair);
    
                    });
                },
                error: function(){
                    console.log('error');
                    
                }
                });
        }
    
        setInterval(updateBestPairsTable,1000);
    });