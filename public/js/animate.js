<script>
$("#message").hover(
    function () {
      $("#message-icon").addClass('message-jump')
    }, 
    function () {
      $("#message-icon").removeClass('message-jump')
    }
);
$("#admon").hover(
    function () {
      $("#admon-icon").addClass('glyphicon-folder-open')
    }, 
    function () {
      $("#admon-icon").removeClass('glyphicon-folder-open')
    }
);
$("#cambio-pass").hover(
    function () {
      $("#cambio-pass-icon").addClass('rotate-pass')
    }, 
    function () {
      $("#cambio-pass-icon").removeClass('rotate-pass')
    }
);
</script>