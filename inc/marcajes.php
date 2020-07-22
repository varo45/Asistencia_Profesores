<?php
if($response4 = $class->selectFrom("SELECT $class->lectivos.Fecha FROM $class->lectivos"))
{
    if($response4->num_rows > 0)
    {
        if($lectivos = $class->selectFrom("SELECT $class->lectivos.Fecha FROM $class->lectivos WHERE $class->lectivos.Festivo='no'"))
        {
            while($fila = $lectivos->fetch_assoc())
            {
                if($response6 = $class->selectFrom("INSERT INTO $class->marcajes SELECT DISTINCT $class->horarios.ID_PROFESOR, '$fila[Fecha]' as $class->horarios.Fecha, $class->horarios.HORA_TIPO, $class->horarios.Dia, 0
                FROM $class->horarios INNER JOIN $class->diasemana ON $class->horarios.ID=$class->diasemana.ID WHERE $class->horarios.Dia = WEEKDAY('$fila[Fecha]')+1"))
                {
                    $MSG = 'Marcajes insertados correctamente.';
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