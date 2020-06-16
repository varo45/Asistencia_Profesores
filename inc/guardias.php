<?php

//--------------------------------------------------------
echo "<h2>Guardias Disponibles</h2>";

if($response = $class->getGuardias())
{
    echo "</br><table class='table table-hover'>";
        echo "<thead>";
            echo "<tr>";
                echo "<th>Hora</th>";
                echo "<th>Profesor</th>";
                echo "<th>Aula</th>";
                echo "<th>Grupo</th>";
                echo "<th>Edificio</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
            while ($fila = $response->fetch_assoc())
                {
                    strlen($fila['Aula']) == 1 ? $fila['Aula'] = 0 . $fila['Aula'] : $fila['Aula'];
                    echo "<tr>";
                        echo "<td>$fila[HORA_TIPO]</td>";
                        echo "<td>$fila[Nombre]</td>";
                        echo "<td>$fila[Edificio]$fila[Aula]</td>";
                        echo "<td>$fila[Grupo]</td>";
                        echo "<td>$fila[Edificio]</td>";
                    echo "</tr>";
                }
        echo "</tbody>";
    echo "</table>";
}
else
{
    echo $ERR_MSG = $class->ERR_NETASYS;
}