<script>
$('#fechainicio, #fechafin').keypress(function(e) {
    e.preventDefault()
});
var hrefmarcajes = $('#filtromarcaje').attr('enlace');
var hrefasistencias = $('#filtroasistencias').attr('enlace');
var hreffaltas = $('#filtrofaltas').attr('enlace');
var hreffichajes = $('#filtrofichajes').attr('enlace');
var fecha = $('#fechainicio').attr('enlace');
var fecha2 = $('#fechafin').attr('enlace');
$('#fechainicio').on('change', function() {
    fecha = $(this).val(),
    $(function (){
        $('#fechafin').datepicker().focus();
    });
});
$('#fechafin').on('change', function() {
    fecha2 = $(this).val(),
    $('#filtromarcaje').attr('enlace', hrefmarcajes+'&fechainicio='+fecha+'&fechafin='+fecha2),
    $('#filtroasistencias').attr('enlace', hrefasistencias+'&fechainicio='+fecha+'&fechafin='+fecha2),
    $('#filtrofaltas').attr('enlace', hreffaltas+'&fechainicio='+fecha+'&fechafin='+fecha2),
    $('#filtrofichajes').attr('enlace', hreffichajes+'&fechainicio='+fecha+'&fechafin='+fecha2)
});
</script>