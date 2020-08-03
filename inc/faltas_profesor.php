<?php

if($resp = $class->query("SELECT Nombre FROM $class->profesores WHERE ID='$_GET[ID]'"))
{
    $n = $resp->fetch_assoc();
    $n = $n['Nombre'];
    $f = $class->getDate();
    $fecha = $f['year'] . "-" . $f['mon'] . "-" . $f['mday'];
    $fecha = '2020-10-22';
    if($response = $class->query("SELECT Marcajes.*, Diasemana FROM Marcajes INNER JOIN Diasemana ON Marcajes.Dia=Diasemana.ID WHERE ID_PROFESOR='$_GET[ID]' AND Fecha <= '$fecha' ORDER BY Fecha DESC, Dia, Hora"))
    {
        echo '<div class="container" style="margin-top:50px">';
            echo "<h1>Asistencias de <b>$n</b></h1>";
            echo "<input id='busca_asiste' calss='fadeIn' type='text' placeholder='Buscar registro...' autocomplete='off'>";
            echo "<div id='marcaje-response'></div>";
            echo "<div id='table-container'>";
                echo "<div id='full-table'>";
                    echo "<table class='table'>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>Fecha</th>";
                                echo "<th>Dia</th>";
                                echo "<th>Hora</th>";
                                echo "<th>Asistencia</th>";
                                echo "<th>Faltado</th>";
                                echo "<th>Asistido</th>";
                                echo "<th>Act. Extra.</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($datos = $response->fetch_assoc())
                        {
                            echo "<tr>";
                            echo "<td>$datos[Fecha]</td>";
                            echo "<td>$datos[Diasemana]</td>";
                            echo "<td>$datos[Hora]</td>";
                            if($datos['Asiste'] == 1)
                            {
                                echo "<td>Si</td>";
                                echo "<td></td>";
                                echo "<td><a title='Haz clic aquí si ha faltado esta hora.'  asiste='$datos[ID_PROFESOR],$datos[Fecha],$datos[Hora],0' class='actualiza' ><span class='glyphicon glyphicon-ok'></span></a></td>";
                                echo "<td><a title='Has clic aqui si tiene Actividad Extraescolar.' asiste='$datos[ID_PROFESOR],$datos[Fecha],$datos[Hora],2' class='actualiza' ><span class='glyphicon glyphicon-unchecked'></span></a></td>";
                            }
                            elseif($datos['Asiste'] == 2)
                            {
                                echo "<td>Si</td>";
                                echo "<td></td>";
                                echo "<td><a title='Haz clic aquí si ha faltado esta hora.'  asiste='$datos[ID_PROFESOR],$datos[Fecha],$datos[Hora],0' class='actualiza' ><span class='glyphicon glyphicon-ok'></span></a></td>";
                                echo "<td><a title='Has clic aqui si tiene Actividad Extraescolar.' asiste='$datos[ID_PROFESOR],$datos[Fecha],$datos[Hora],1' class='actualiza' ><span class='glyphicon glyphicon-check'></span></a></td>";
                            }
                            else
                            {
                                echo "<td>No</td>";
                                echo "<td><a title='Haz clic aquí si ha asistido esta hora.' asiste='$datos[ID_PROFESOR],$datos[Fecha],$datos[Hora],1' class='actualiza'><span class='glyphicon glyphicon-remove'></span></a></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                            }
                            echo "</tr>";
                        }
                        echo "</tbody>";
                    echo "</table>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
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