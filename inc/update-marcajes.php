<?php
if($class->updateSet("UPDATE Marcajes SET Asiste=$_GET[Valor] WHERE ID_PROFESOR='$_GET[Profesor]' AND Fecha='$_GET[Fecha]' AND Hora='$_GET[Hora]'"))
{
    if($_GET['valor'] == 1)
    {
        $msg = "Ha modificado el registro del día $_GET[Fecha] como Asistido.";
    }
    elseif($_GET['valor'] == 0)
    {
        $msg = "Ha modificado el registro del día $_GET[Fecha] como Ausente.";
    }
    elseif($_GET['valor'] == 2)
    {
        $msg = "Ha modificado el registro del día $_GET[Fecha] como Actividad Extraescolar.";
    }
    else
    {
        $msg = "";
    }

    $notificacion = "INSERT INTO Notificaciones VALUES ('$_GET[Profesor]', $msg)";
    if(! $class->query($notificacion))
    {
        echo $class->ERR_NETASYS;
        return false;
    }
    return true;
}
else
{
    echo $class->ERR_NETASYS;
    return false;
}