$(document).ready(function(){

    function updateBestPairsTable()
        {
            $.ajax('\ajaxGetFavList',{
    
           
                type:'GET',
                success: function(data){
    
                    $('#favTable tbody').empty();
                    $.each(data,function(index,pair){
    
                        var newRow = '<tr>' +
                        '<td>' + pair['pair']+ '</td>' +
                        '<td>' + pair['binance'] + '</td>' +
                        '<td>' + pair['kraken'] + '</td>' +
                        '<td>' + pair['crypto'] + '</td>' +
                        '<td><button class="delete-button">Delete</button></td>'+
                       '</tr>';
     
                     $('#favTable tbody').append(newRow);
                     

                    $('.delete-button').on('click', function() {
                        var row = $(this).closest('tr');
                        var favPair = row.find('td:first').text(); // Assuming the first column is the username
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            
                            url: "/favPairs/" + favPair + "/destroy/confirm",
                            method: "GET",
                            data:{pairName: favPair},
                            success: function(response) {
                                window.location.href = "/favPairs/" + favPair + "/destroy/confirm";
                                row.remove();
                            },
                            error: function(error) {
                                console.log("Error deleting favPair: " + error.responseText);
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