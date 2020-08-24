<script>
$(document).ready(function(){
    $('#mostrar').hide();
    $("#show").click(function(){
        $('#mostrar').toggle(),
        atributo = $('#listado_mensajes').attr('class');
        if(atributo == 'col-xs-12')
        {
            $('#listado_mensajes').attr('class', atributo+' col-md-8')
        }
        else
        {
            $('#listado_mensajes').attr('class', 'col-xs-12')
        }
     })
});
</script>