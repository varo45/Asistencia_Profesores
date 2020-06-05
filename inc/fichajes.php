<?php
$conex = $bd->conex;
$sql = "SELECT * FROM $bd->fichajes";
$ejec = $conex->query($sql);
echo "<h2>Profesores</h2>";
echo "</br><div class='tablaprofesores'>";
    echo "<div class='cabeceraprofesores'>";
        echo "<div class='celdaprofesores'>ID</div>";
        echo "<div class='celdaprofesores'>Nombre</div>";
        echo "<div class='celdaprofesores'>DNI</div>";
        echo "<div class='celdaprofesores'>Admin</div>";
    echo "</div>";
while ($fila = $ejec->fetch_assoc())
    {
        echo "<div class='fila'>";
            echo "<div class='celdaprofesores'>$fila[ID]</div>";
            echo "<div class='celdaprofesores'>$fila[Nombre]</div>";
            echo "<div class='celdaprofesores'>$fila[DNI]</div>";
            echo "<div class='celdaprofesores'>$fila[Admin]</div>";
        echo "</div>";
    }
echo "</div>";