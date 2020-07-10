<?php

//--------------------------------------------------------

if($response = $class->getGuardias())
{
    $j = $response->num_rows;
    echo "</br><table class='table table-hover'>";
        echo "<thead>";
            echo "<tr>";
                echo "<th>Hora</th>";
                echo "<th>Profesor</th>";
                echo "<th>Edificio</th>";
                echo "<th>Aula</th>";
                echo "<th>Grupo</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        $datos = $response->fetch_all();
        for($i = 0; $i < $j; $i++)
        {
            echo "<tr>";
                echo "<td>" . $datos[$i][4] . "</td>";
                echo "<td>" . $datos[$i][0] . "</td>";
                if(preg_match('/^[A-Z][A-Z][1-9][0-9]{2}$/i', $datos[$i][1]))
                {
                    $e = preg_split('//', $datos[$i][1], -1, PREG_SPLIT_NO_EMPTY);
                    $edificio = $e[2];
                    echo "<td>" . $edificio . "</td>";
                }
                else
                {
                    echo "<td></td>";
                }
                echo "<td><b>" . $datos[$i][1] . "</b></td>";
                echo "<td><b>";
                    echo $datos[$i][2];
                    $aula = $datos[$i][1];
                    $grupo = $datos[$i][2];
                    $i++;
                    if($datos[$i][1] == $aula)
                    {
                        $m = 1;
                        if($resp = $class->selectFrom("SELECT DISTINCT Grupo FROM $class->horarios
                                                        WHERE $class->horarios.ID_PROFESOR=". "'" . $datos[$i][5] . "'" . "AND $class->horarios.Aula=" . "'" . $aula . "'" . "AND $class->horarios.Grupo<>" . "'" . $grupo . "'"))
                        {
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
                                $i++;
                            }
                        }
                        else
                        {
                            echo $ERR_MSG = $class->ERR_NETASYS;
                        }
                        echo "</b></td>";
                    }
                    else
                    {
                        echo "</b></td>";
                    }
                    $i--;
            echo "</tr>";
        }
        echo "</tbody>";
    echo "</table>";
}
else
{
    echo $ERR_MSG = $class->ERR_NETASYS;
}