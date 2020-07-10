<?php

if($resp = $class->selectFrom("SELECT Nombre FROM $class->profesores WHERE ID='$_GET[ID]'"))
{
    $n = $resp->fetch_assoc();
    $n = $n['Nombre'];
    if($response = $class->selectFrom("SELECT Ausencias.ID, Dia, Motivo, Justificada FROM Ausencias WHERE ID_PROFESOR='$_GET[ID]'"))
    {
        echo '<div class="container" style="margin-top:50px">';
                    echo "<h1>Faltas del Profesor: <b>$n</b></h1>";
                    echo "<table class='table'>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>ID</th>";
                                echo "<th>Dia</th>";
                                echo "<th>Motivo</th>";
                                echo "<th>Justificada</th>";
                                echo "<th>Justificar</th>";
                                echo "<th>Descuido</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($datos = $response->fetch_assoc())
                        {
                            echo "<tr>";
                            echo "<td>$datos[ID]</td>";
                            echo "<td>$datos[Dia]</td>";
                            if($datos['Motivo'] === 'No se ha especificado ningún motivo')
                            {
                                echo "<td style='color: #ddd;'><i>$datos[Motivo]</i></td>";
                            }
                            else
                            {
                                echo "<td>$datos[Motivo]</td>";
                            }
                            if($datos['Justificada'] == 0)
                            {
                                echo "<td>No</td>";
                                echo "<td><a href='index.php?ACTION=faltas_profesor&ID=$fila[ID]'><span class='glyphicon glyphicon-ok'></span></a></td>";
                                echo "<td><a href='index.php?ACTION=faltas_profesor&ID=$fila[ID]'><span class='glyphicon glyphicon-remove'></span></a></td>";
                            }
                            else
                            {
                                echo "<td>Si</td>";
                                echo "<td></td>";
                                echo "<td></td>";
                            }
                            echo "</tr>";
                        }
                        echo "</tbody>";
                    echo "</table>";
        echo '</div>';
    }
    else
    {
        $ERR_MSG = $class->ERR_NETASYS;
    }
}
else
{
    $ERR_MSG = $class->ERR_NETASYS;
}

?>