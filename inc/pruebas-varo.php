<?php
if($lect = $class->selectFrom("SELECT Fecha FROM Lectivos WHERE Festivo = 'no'"))
{
    while($fila = $lect->fetch_assoc())
    {
        // var_dump("INSERT INTO Marcajes SELECT DISTINCT '$fila[Fecha]' as Fecha, ID_PROFESOR, Dia, HORA_TIPO, 0
        // FROM Horarios INNER JOIN Diasemana ON Horarios.Dia=Diasemana.ID
        // WHERE Dia = WEEKDAY('$fila[Fecha]')+1");
        if($respose = $class->selectFrom("INSERT INTO Marcajes SELECT DISTINCT ID_PROFESOR,'$fila[Fecha]' as Fecha, HORA_TIPO, Dia, 0
        FROM Horarios INNER JOIN Diasemana ON Horarios.Dia=Diasemana.ID
        WHERE Dia = WEEKDAY('$fila[Fecha]')+1"))
        {
            $MSG = 'Insertados correctamente.';
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