<?php
if($response4 = $class->query("SELECT $class->lectivos.Fecha FROM $class->lectivos"))
{
    if($response4->num_rows > 0)
    {
        if($lectivos = $class->query("SELECT $class->lectivos.Fecha FROM $class->lectivos WHERE $class->lectivos.Festivo='no'"))
        {
            while($fila = $lectivos->fetch_assoc())
            {
                if($respose = $class->query("INSERT INTO Marcajes SELECT DISTINCT ID_PROFESOR,'$fila[Fecha]' as Fecha, HORA_TIPO, Dia, 0
                FROM Horarios INNER JOIN Diasemana ON Horarios.Dia=Diasemana.ID
                WHERE Dia = WEEKDAY('$fila[Fecha]')+1"))
                {
                    $MSG = "<span style='color: green;'>Marcajes por horas actualizados correctamente</span>";
                    include_once($dirs['inc'] . 'msg_modal.php');
                }
                else
                {
                    $ERR_MSG = $class->ERR_NETASYS;
                }
            }
        }
        else
        {
            $ERR_MSG = $class->ERR_NETASYS;
        }
    }
    else
    {   
        $ERR_MSG ="Debe registrar primero el listado de profesores.";
    }
}
else
{
    $ERR_MSG = $class->ERR_NETASYS;
}