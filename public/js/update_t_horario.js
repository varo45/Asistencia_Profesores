
<script>
$('.entrada').hide();

$(window).click(function() {
	$('.entrada').hide(),
	$('.txt').show()
});

$('.entrada').click(function(event){
    event.stopPropagation()
});

$('.txt').on('dblclick', function(){
	texto=$(this).html(),
	datos=$(this).attr('id').split('_'),
	id=datos[1],
	columna=datos[2],
	$(this).hide();
	if(columna == 'Aula')
	{
		tx='#in_'+id+'_'+columna
	}
	else
	{
		tx='#in2_'+id+'_'+columna
	}
	$(tx).val(texto),
	$(tx).show().focus()
});

$('.entrada').on('change', function(){
	texto=$(this).val(),
	datos=$(this).attr('id').split('_'),
	id=datos[1],
	columna=datos[2],
	$(this).hide();
	if(columna == 'Aula')
	{
		sp='#sp_'+id+'_'+columna
	}
	else
	{
		sp='#sp2_'+id+'_'+columna
	}

    if(! confirm('¿Modificar?'))
    {
        $(sp).show();
        return
    }

	$(sp).html(texto),
	$(sp).show(),
	enlace="index.php?ACTION=update-t-horario&id="+id+"&columna="+columna+"&texto="+texto,
	$('#response').load(encodeURI(enlace)),
	location.reload()
	
});

</script>
<script>
$(document).ready(function () {
	$('#loading').hide(),
	$("#loading-msg").hide()
});
$('.act').on('click', function(event) {
	id = $(this).parent().attr('id'),
	event.preventDefault(),
	$("#loading-msg").html("Aplicando cambios...").show(),
	$('#loading').show(),
	enlace = $(this).attr('enlace'),
	$('#response').load(encodeURI(enlace)),
	$('#tabla_t_horario').html(''),
	location.reload()
});
</script>