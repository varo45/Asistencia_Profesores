<?php
$bd->bdConex();
$conex = $bd->conex;
$sql = "SELECT * FROM $bd->horarios";
$ejec = $conex->query($sql);
echo "<h2>Horarios</h2>";
echo "</br><table class='table table-striped'>";
    echo "<thead>";
        echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>ID_PROFESOR</th>";
            echo "<th>Dia</th>";
            echo "<th>Hora</th>";
            echo "<th>Aula</th>";
            echo "<th>Grupo</th>";
            echo "<th>Hora_salida</th>";
            echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
        while ($fila = $ejec->fetch_assoc())
            {
                echo "<tr>";
                    echo "<td>$fila[ID]</td>";
                    echo "<td>$fila[ID_PROFESOR]</td>";
                    echo "<td>$fila[Dia]</td>";
                    echo "<td>$fila[Hora]</td>";
                    echo "<td>$fila[Aula]</td>";
                    echo "<td>$fila[Grupo]</td>";
                    echo "<td>$fila[Hora_salida]</td>";
                echo "</tr>";
            }
    echo "</tbody>";
echo "</table>";