<?php
if($class->query("UPDATE Marcajes SET Asiste=$_GET[Valor] WHERE ID_PROFESOR='$_GET[Profesor]' AND Fecha='$_GET[Fecha]' AND Hora='$_GET[Hora]'"))
{
    if($_GET['Valor'] == 1)
    {
        $msg = "Ha modificado el registro del Día: $_GET[Fecha] Hora: $_GET[Hora] como Asistido.";
    }
    elseif($_GET['Valor'] == 0)
    {
        $msg = "Ha modificado el registro del Día: $_GET[Fecha] Hora: $_GET[Hora] como Ausente.";
    }
    elseif($_GET['Valor'] == 2)
    {
        $msg = "Ha modificado el registro del Día: $_GET[Fecha] Hora: $_GET[Hora] como Actividad Extraescolar.";
    }
    else
    {
        $msg = "";
    }

    $notificacion = "INSERT INTO Notificaciones (ID_PROFESOR, Modificacion) VALUES ('$_GET[Profesor]', '$msg')";
    if(! $class->query($notificacion))
    {
        echo $class->ERR_ASYSTECO;
        return false;
    }
    return true;
}
else
{
    echo $class->ERR_ASYSTECO;
    return false;
}