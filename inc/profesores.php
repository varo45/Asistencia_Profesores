<?php
$bd->bdConex();
$conex = $bd->conex;
$sql = "SELECT * FROM $bd->profesores";
$ejec = $conex->query($sql);
echo "<h2>Profesores</h2>";
echo "</br><table class='table table-striped'>";
    echo "<thead>";
    echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nombre</th>";
        echo "<th>DNI</th>";
        echo "<th>Admin</th>";
    echo "</thead";
    echo "<tbody>";
        while ($fila = $ejec->fetch_assoc())
        {  
            echo "<tr>";
            echo "<td>$fila[ID]</td>";
            echo "<td>$fila[Nombre]</td>";
            echo "<td>$fila[DNI]</td>";
            echo "<td>$fila[Admin]</td>";
            echo "</tr>";
        }
    echo "</tbody>";
echo "</table>";