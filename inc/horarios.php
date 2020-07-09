<?php
if($response = $class->selectFrom("SELECT $class->horarios.*, Diasemana.Diasemana as Dia 
                                    FROM ($class->horarios INNER JOIN $class->profesores ON $class->horarios.ID_PROFESOR=$class->profesores.ID)
                                    INNER JOIN Diasemana ON Diasemana.ID=$class->horarios.Dia
                                    WHERE $class->profesores.ID='$_SESSION[ID]'
                                    ORDER BY $class->horarios.HORA_TIPO"))
{
    if ($response->num_rows > 0)
    {
        echo "<h2>Horario</h2>";
        echo "</br><table class='table'>";
        echo "<thead>";
            echo "<tr>";
                echo "<th>Horas</th>";
                echo "<th>Lunes</th>";
                echo "<th>Martes</th>";
                echo "<th>Miercoles</th>";
                echo "<th>Jueves</th>";
                echo "<th>Viernes</th>";
                echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        for ($i = 0; $i < 6; $i++)
        {
            $dia = $class->getDate();
            $hora = $i+1;
            if($response = $class->selectFrom("SELECT $class->horarios.*, Diasemana.Diasemana, Diasemana.ID as ndia 
            FROM ($class->horarios INNER JOIN $class->profesores ON $class->horarios.ID_PROFESOR=$class->profesores.ID) 
            INNER JOIN Diasemana ON Diasemana.ID=$class->horarios.Dia WHERE $class->profesores.ID='$_SESSION[ID]' AND $class->horarios.HORA_TIPO=" . "'" . $hora ."M'
            ORDER BY $class->horarios.HORA_TIPO, $class->horarios.Dia"))
            {
                $filahora = $response->fetch_all();
                echo "<tr>";
                echo "<td>$hora</td>";
                $k = 0;
                for($j = 1; $j <= 5; $j++)
                {
                    if($filahora[$k][10] == $j)
                    {
                        $dia['weekday'] === $filahora[$k][9] ? $dia['color'] = "success" : $dia['color'] = '';
                        echo "<td class='$dia[color]'>Aula: " . $filahora[$k][5] . "<br>Grupo: " . $filahora[$k][6] . "</td>";
                        $k++;
                    }
                    else
                    {
                        echo "<td></td>";
                    }
                }
                echo "</tr>";
            }
            else
            {
                $ERR_MSG = $class->ERR_NETASYS;
            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }
    else
    {
        $ERR_MSG = $class->ERR_NETASYS;
    }
}
else
{
    $ERR_MSG = $class->ERR_NETASYS;
}