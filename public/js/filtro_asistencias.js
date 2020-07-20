<script>
$(function(){
  $('#busca_asiste').keyup(function(){
    var val = $(this).val().toLowerCase();

    $("tr").hide();

    $("tr").each(function(){

      var text = $(this).text().toLowerCase();

      if(text.indexOf(val) != -1)
      {

        $(this).show();
      }
    });
  });
});
</script>