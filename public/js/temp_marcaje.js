<script>
$('#marcajefeini, #marcajefefin').keypress(function(e) {
    e.preventDefault()
});
var hrefmarc = $('#marcajefe').attr('enlace');
var fechamarc = $('#marcajefeini').attr('enlace');
var fecha2marc = $('#marcajefefin').attr('enlace');
$('#marcajefeini').on('change', function() {
    fechamarc = $(this).val(),
    $(function (){
        $('#marcajefefin').datepicker().focus();
    });
});
$('#marcajefefin').on('change', function() {
    fecha2marc = $(this).val(),
    $('#marcajefe').attr('enlace', hrefmarc+'&marcajefeini='+fechamarc+'&marcajefefin='+fecha2marc).click()
});
$('#marcajefe').on('click', function(event) {
    if($('#marcajefeini').val() == '')
    {
        $(function (){
            $('#marcajefeini').datepicker().focus();
        });
    }
});
</script>