<script>
    $('.btn-select').on('click', function(event) {
        event.preventDefault(),
        enlace = $(this).attr('enlace'),
        $('#btn-response').load(enlace)
    });
</script>