<script>
$('#fichafeini, #fichafefin').keypress(function(e) {
    e.preventDefault()
});
var href = $('#fichafe').attr('enlace');
var fecha = $('#fichafeini').attr('enlace');
var fecha2 = $('#fichafefin').attr('enlace');
$('#fichafeini').on('change', function() {
    fecha = $(this).val(),
    $(function (){
        $('#fichafefin').datepicker().focus();
    });
});
$('#fichafefin').on('change', function() {
    fecha2 = $(this).val(),
    $('#fichafe').attr('enlace', href+'&fichafeini='+fecha+'&fichafefin='+fecha2).click()
});
$('#fichafe').on('click', function(event) {
    if($('#fichafeini').val() == '')
    {
        $(function (){
            $('#fichafeini').datepicker().focus();
        });
    }
});
</script>