<script>
    $('.btn-select').on('click', function(event) {
        event.preventDefault(),
        enlace = $(this).attr('href'),
        $('#btn-response').load(enlace)
    });
</script>