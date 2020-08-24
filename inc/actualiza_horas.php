<?php

if($response = $class->query("SELECT DISTINCT ID_PROFESOR FROM $class->horarios"))
{
    $id = [];
    while($row = $response->fetch_assoc())
    {
        $id[] = $row['ID_PROFESOR'];
    }
    foreach($id as $profe)
    {
        // Por cada Día, comprobamos y actualizamos sus Hora_entrada y Hora_salida
        for($i=1;$i<=5;$i++)
        {
            // Conseguimos su primera Hora
            if($res = $class->query("SELECT HORA_TIPO FROM $class->horarios WHERE ID_PROFESOR='$profe' AND Dia='$i' ORDER BY HORA_TIPO ASC LIMIT 1"))
            {
                if($res->num_rows > 0)
                {
                    $primera = $res->fetch_assoc();
                    if(! $p = $class->query("SELECT Inicio FROM Horas WHERE Hora='$primera[HORA_TIPO]'")->fetch_assoc())
                    {
                        $ERR_MSG = $class->NETASYS;
                    }
                }
                else
                {
                    continue;
                }
            }
            else
            {
                $ERR_MSG = $class->NETASYS;
            }

            // Conseguimos su ultima Hora
            if($res = $class->query("SELECT HORA_TIPO FROM $class->horarios WHERE ID_PROFESOR='$profe' AND Dia='$i' ORDER BY HORA_TIPO DESC LIMIT 1"))
            {
                if($res->num_rows > 0)
                {
                    $ultima = $res->fetch_assoc();
                    if(! $u = $class->query("SELECT Fin FROM Horas WHERE Hora='$ultima[HORA_TIPO]'")->fetch_assoc())
                    {
                        $ERR_MSG = $class->NETASYS;
                    }
                }
                else
                {
                    continue;
                }
            }
            else
            {
                $ERR_MSG = $class->NETASYS;
            }

            // Modificamos Hora_entrada y Hora_salida de cada Horario
            if($class->query("UPDATE $class->horarios SET Hora_entrada='$p[Inicio]', Hora_salida='$u[Fin]' WHERE ID_PROFESOR='$profe' AND Dia='$i'"))
            {
                $MSG = "Horarios actualizados correctamente.";
            }
            else
            {
                $ERR_MSG = $class->NETASYS;
            }
        }
    }
}
else
{
    $ERR_MSG = $class->NETASYS;
}