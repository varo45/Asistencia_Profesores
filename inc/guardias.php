<?php

//--------------------------------------------------------
echo "<h2>Guardias Disponibles</h2>";
if ($fila = $class->getGuardias())
{
    echo "</br><table class='table table-hover'>";
        echo "<thead>";
            echo "<tr>";
                echo "<th>Edificio</th>";
                echo "<th>Aula</th>";
                echo "<th>Grupo</th>";
                echo "<th>Hora</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
            while ($fila2 = $fila->fetch_assoc())
                {
                    echo "<tr>";
                        echo "<td>$fila2[Aula]</td>";
                        echo "<td>$fila2[Aula]</td>";
                        echo "<td>$fila2[Grupo]</td>";
                        echo "<td>$fila2[Hora]</td>";
                    echo "</tr>";
                }
        echo "</tbody>";
    echo "</table>";
}
else
{
    $ERR_MSG = $class->ERR_NETASYS;
}