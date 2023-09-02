$(document).ready(function(){
    $("input[type=text]").keyup(function(){
      $.ajax("/ajaxPairAssistant",{data: {nome: $(this).val()}, success: function(result) {
        $("#risultati").html(result);
      }});
    });
  });