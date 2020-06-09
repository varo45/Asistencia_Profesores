<?php
$bd->bdConex();
$conex = $bd->conex;
$sql = "SELECT * FROM $bd->horarios";
$ejec = $conex->query($sql);
echo "<h2>Horarios</h2>";
echo "</br><div class='tablahorarios'>";
    echo "<div class='cabecerahorarios'>";
        echo "<div class='celdahorarios'>ID</div>";
        echo "<div class='celdahorarios'>ID_PROFESOR</div>";
        echo "<div class='celdahorarios'>Dia</div>";
        echo "<div class='celdahorarios'>Hora</div>";
        echo "<div class='celdahorarios'>Aula</div>";
        echo "<div class='celdahorarios'>Grupo</div>";
        echo "<div class='celdahorarios'>Hora_salida</div>";
    echo "</div>";
while ($fila = $ejec->fetch_assoc())
    {
        echo "<div class='fila'>";
            echo "<div class='celdahorarios'>$fila[ID]</div>";
            echo "<div class='celdahorarios'>$fila[ID_PROFESOR]</div>";
            echo "<div class='celdahorarios'>$fila[Dia]</div>";
            echo "<div class='celdahorarios'>$fila[Hora]</div>";
            echo "<div class='celdahorarios'>$fila[Aula]</div>";
            echo "<div class='celdahorarios'>$fila[Grupo]</div>";
            echo "<div class='celdahorarios'>$fila[Hora_salida]</div>";
        echo "</div>";
    }
echo "</div>";