<div class="container" style="margin-top:50px">
</div>
<?php
//--------------------------------------------------------
echo "<h2>Guardias Disponibles</h2>";
if ($fila = $bd->getGuardias())
{
    echo "</br><table class='table table-striped'>";
        echo "<thead>";
            echo "<tr>";
                echo "<th>Aula</th>";
                echo "<th>Grupo</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
            while ($fila = $ejec->fetch_assoc())
                {
                    echo "<tr>";
                        echo "<td>$fila[Aula]</td>";
                        echo "<td>$fila[Grupo]</td>";
                    echo "</tr>";
                }
        echo "</tbody>";
    echo "</table>";
}
else
{
    echo $bd->ERR_BD;
}