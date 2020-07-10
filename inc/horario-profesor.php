<?php
if($response = $class->selectFrom("SELECT $class->horarios.*, Diasemana.Diasemana 
                                    FROM ($class->horarios INNER JOIN $class->profesores ON $class->horarios.ID_PROFESOR=$class->profesores.ID) 
                                    INNER JOIN Diasemana ON Diasemana.ID=$class->horarios.Dia WHERE $class->profesores.ID='$_GET[profesor]' 
                                    ORDER BY $class->horarios.HORA_TIPO, $class->horarios.Dia"))
{
    if ($response->num_rows > 0)
    {
        if(! $nombre = $class->selectFrom("SELECT Nombre FROM $class->profesores WHERE ID='$_GET[profesor]'"))
        {
            $ERR_MSG = $class->ERR_NETASYS;
        }
        else
        {
            $n = $nombre->fetch_assoc();
        }
        echo "<h2>Horario: $n[Nombre]</h2>";
        echo "</br><table class='table'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th style='text-align: center;'>Horas</th>";
                    echo "<th style='text-align: center;'>Lunes</th>";
                    echo "<th style='text-align: center;'>Martes</th>";
                    echo "<th style='text-align: center;'>Miercoles</th>";
                    echo "<th style='text-align: center;'>Jueves</th>";
                    echo "<th style='text-align: center;'>Viernes</th>";
                    echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
                    for ($i = 0; $i < 6; $i++)
                    {
                        $dia = $class->getDate();
                        $hora = $i+1;
                        if($response = $class->selectFrom("SELECT $class->horarios.*, Diasemana.Diasemana, Diasemana.ID, $class->horas.Inicio, $class->horas.Fin 
                        FROM (($class->horarios INNER JOIN $class->profesores ON $class->horarios.ID_PROFESOR=$class->profesores.ID) 
                        INNER JOIN Diasemana ON Diasemana.ID=$class->horarios.Dia)
                        INNER JOIN $class->horas ON $class->horas.Hora=$class->horarios.HORA_TIPO
                        WHERE $class->profesores.ID='$_GET[profesor]' AND $class->horarios.HORA_TIPO=" . "'" . $hora ."M'
                        ORDER BY $class->horarios.HORA_TIPO, $class->horarios.Dia"))
                        {
                            $k = 0;
                            $filahora = $response->fetch_all();
                            echo "<tr>";
                            echo "<td style='vertical-align: middle; text-align: center;'><b>$hora</b></td>";
                            for($j = 1; $j <= 5; $j++)
                            {
                                if($filahora[$k][10] == $j)
                                {
                                    $dia['weekday'] === $filahora[$k][9] ? $dia['color'] = "success" : $dia['color'] = '';
                                    echo "<td style='vertical-align: middle; padding-left: 55px;' class='$dia[color]'><b>Aula:</b> " . $filahora[$k][5] . "<br><b>Grupo:</b> " . $filahora[$k][6];
                                    $k++;
                                    if($filahora[$k][10] == $j)
                                    {
                                        $k--;
                                        if($resp = $class->selectFrom("SELECT DISTINCT Grupo FROM ($class->horarios INNER JOIN $class->profesores ON $class->horarios.ID_PROFESOR=$class->profesores.ID) 
                                        INNER JOIN Diasemana ON Diasemana.ID=$class->horarios.Dia WHERE $class->profesores.ID='$_GET[profesor]' AND $class->horarios.HORA_TIPO=" . "'" . $hora ."M'
                                        AND $class->horarios.Aula=" . "'" . $filahora[$k][5] . "' AND $class->horarios.Grupo<>" . "'" . $filahora[$k][6] . "'"))
                                        {
                                            $m = 2;
                                            while($masgrupos = $resp->fetch_assoc())
                                            {
                                                if($m % 2 == 0)
                                                {
                                                    echo "<br>";
                                                }
                                                else
                                                {
                                                    echo " ";
                                                }
                                                echo $masgrupos['Grupo'];
                                                $m++;
                                            }
                                            echo "</td>";
                                        }
                                        else
                                        {
                                            $ERR_MSG = $class->ERR_NETASYS;
                                        }
                                    }
                                    else
                                    {
                                        echo "</td>";
                                    }
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