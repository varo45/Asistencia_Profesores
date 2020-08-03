<script>
$(function(){
  $('#busca_prof').keyup(function(){
    var val = $(this).val().toLowerCase();

    $(".row_show").hide();

    $(".row_show").each(function(){

      var text = $(this).text().toLowerCase();

      if(text.indexOf(val) != -1)
      {
        $(this).show();
      }
    });
  });
});
</script>