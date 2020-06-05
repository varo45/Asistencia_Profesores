<?php
$conex = $bd->conex;
$sql = "SELECT * FROM $bd->fichajes";
$ejec = $conex->query($sql);
echo "<h2>Fichajes</h2>";
echo "</br><div class='tablafichajes'>";
    echo "<div class='cabecerafichajes'>";
        echo "<div class='celdafichajes'>ID</div>";
        echo "<div class='celdafichajes'>ID_PROFESOR</div>";
        echo "<div class='celdafichajes'>Fecha</div>";
        echo "<div class='celdafichajes'>Hora_entrada</div>";
        echo "<div class='celdafichajes'>Hora_salida</div>";
    echo "</div>";
while ($fila = $ejec->fetch_assoc())
    {
        echo "<div class='fila'>";
            echo "<div class='celdafichajes'>$fila[ID]</div>";
            echo "<div class='celdafichajes'>$fila[ID_PROFESOR]</div>";
            echo "<div class='celdafichajes'>$fila[Fecha]</div>";
            echo "<div class='celdafichajes'>$fila[Hora_entrada]</div>";
            echo "<div class='celdafichajes'>$fila[Hora_salida]</div>";
        echo "</div>";
    }
echo "</div>";