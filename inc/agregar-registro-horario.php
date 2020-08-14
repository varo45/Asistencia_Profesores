<div class="container-fluid" style="margin-top:50px">
</div>
<?php
if(isset($_POST['Enviar']) && $_POST['Enviar'] == 'Agregar')
{
    if($class->query("INSERT INTO $class->horarios (ID_PROFESOR, Dia, HORA_TIPO, Aula, Grupo, Hora_entrada, Hora_salida) VALUES ('$_POST[ID_PROFESOR]', '$_POST[Dia]', '$_POST[Hora]M', '$_POST[Aula]', '$_POST[Grupo]', '08:00:00', '15:00:00')"))
    {
        $MSG = "Cambios realizados correctamente.";
    }
    else
    {
        $MSG = $class->ERR_NETASYS;
    }
}