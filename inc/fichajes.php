<?php
$conex = $bd->conex;
$sql = "SELECT * FROM $bd->fichaje";
$ejec = $conex->query($sql);
echo "<h2>Fichajes</h2>";
if ($row_cnt_fichajes = $ejec->num_rows >=1)
{
    echo "</br><table class='table table-striped'>";
        echo "<thead>";
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>ID_PROFESOR</th>";
                echo "<th>Fecha</th>";
                echo "<th>Hora_entrada</th>";
                echo "<th>Hora_salida</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
            while ($fila = $ejec->fetch_assoc())
                {
                    echo "<tr>";
                        echo "<td>$fila[ID]</td>";
                        echo "<td>$fila[ID_PROFESOR]</td>";
                        echo "<td>$fila[Fecha]</td>";
                        echo "<td>$fila[Hora_entrada]</td>";
                        echo "<td>$fila[Hora_salida]</td>";
                    echo "</tr>";
                }
        echo "</tbody>";
    echo "</table>";
}
else
{
    echo "No existen registros de fichajes.";
}