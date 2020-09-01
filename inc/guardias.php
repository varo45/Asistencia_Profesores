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
        //var_dump($datos);
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
                    $ultimahora = $datos[$i][4];
                    $i++;
                    // $m -> Contador de pares para saltar línea o añadir espacio
                    $m = 1;

                    /*
                    * Comprobamos si el siguiente objeto (Registro) coincide con el mismo Aula
                    * Esta comprobación se realizará hasta que ya no coincida
                    * Ya que pertenecerá al siguiente registro
                    */
                    while($datos[$i][1] == $aula && $datos[$i][4] == $ultimahora)
                    {
                        if($m % 2 == 0)
                        {
                            echo "<br>";
                        }
                        else
                        {
                            echo " ";
                        }
                        echo $datos[$i][2];
                        $ultimahora = $datos[$i][4];
                        $m++;
                        $i++;
                    }
                    $i--;
                    echo "</b></td>";
            echo "</tr>";
        }
        echo "</tbody>";
    echo "</table>";
}
else
{
    echo $ERR_MSG = $class->ERR_ASYSTECO;
}