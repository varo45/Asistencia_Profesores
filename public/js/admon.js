<script>
    $("#loading").hide(),
    $('.btn-select').on('click', function(event) {
        $('#btn-response').html(''),
        $("#loading-msg").html("Cargando..."),
        $("#loading").show(),
        event.preventDefault(),
        enlace = $(this).attr('enlace'),
        $('#btn-response').load(enlace),
        $("#loading").delay().fadeOut()
    });
    $('.btn-export').on('click', function(event) {
        $('#btn-response').html(''),
        $("#loading-msg").html("Cargando..."),
        $("#loading").show(),
        event.preventDefault(),
        enlace = $(this).attr('enlace'),
        window.open(enlace),
        $("#loading").delay().fadeOut()
    });
</script>