<?php
if($response = $class->selectFrom("SELECT $class->horarios.*, Diasemana.Diasemana as Dia FROM ($class->horarios INNER JOIN $class->profesores ON $class->horarios.ID_PROFESOR=$class->profesores.ID) INNER JOIN Diasemana ON Diasemana.ID=$class->horarios.Dia WHERE $class->profesores.ID='$_SESSION[ID]' ORDER BY $class->horarios.HORA_TIPO"))
{
    if ($response->num_rows > 0)
    {
        echo "<h2>Horario</h2>";
        echo "</br><table class='table'>";
        echo "<thead>";
            echo "<tr>";
                echo "<th>Horas</th>";
                echo "<th>Lunes</th>";
                echo "<th>Martes</th>";
                echo "<th>Miercoles</th>";
                echo "<th>Jueves</th>";
                echo "<th>Viernes</th>";
                echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
            while ($fila = $response->fetch_assoc())
                {
                    if ($fila['Dia'] == 'Lunes')
                    {
                        $lunes[] = $fila;
                    }
                    elseif ($fila['Dia'] == 'Martes')
                    {
                        $martes[] = $fila;
                    }                   
                    elseif ($fila['Dia'] == 'Miercoles')
                    {
                        $miercoles[] = $fila;
                    }
                    elseif ($fila['Dia'] == 'Jueves')
                    {
                        $jueves[] = $fila;
                    }
                    elseif ($fila['Dia'] == 'Viernes')
                    {
                        $viernes[] = $fila;
                    }
                }
                // var_dump($lunes);
                // var_dump($martes);
                // var_dump($miercoles);
                // var_dump($jueves);
                // var_dump($viernes);
            for ($i = 0; $i < 6; $i++)
            {
                $dia = $class->getDate();
                $count=$i+1;
                $horas = $count . 'M';
                echo "<tr>";
                    echo "<td>" . $count . "</td>";
                    if ($lunes[$i]['HORA_TIPO'] == $horas && $lunes[$i]['Edificio'] && $lunes[$i]['Aula'] != null && $lunes[$i]['Grupo'] != null)
                    {
                        strlen($lunes[$i]['Aula']) == 1 ? $lunes[$i]['Aula'] = 0 . $lunes[$i]['Aula'] : $lunes[$i]['Aula'];
                        $dia['weekday'] === 'Lunes' ? $dia['color'] = "success" : $dia['color'] = '';
                        echo "<td class='$dia[color]'>" . "Aula: " . $lunes[$i]['Edificio'] . $lunes[$i]['Aula'] . "<br>" . "Grupo: " . $lunes[$i]['Grupo'] . "</td>";
                    }
                    else
                    {
                        echo "<td></td>";
                    }                 
                    if ($martes[$i]['HORA_TIPO'] == $horas && $martes[$i]['Edificio'] && $martes[$i]['Aula'] != null && $martes[$i]['Grupo'] != null)
                    {
                        strlen($martes[$i]['Aula']) == 1 ? $martes[$i]['Aula'] = 0 . $martes[$i]['Aula'] : $martes[$i]['Aula'];
                        $dia['weekday'] === 'Martes' ? $dia['color'] = "success" : $dia['color'] = '';
                        echo "<td class='$dia[color]'>" . "Aula: " . $martes[$i]['Edificio'] . $martes[$i]['Aula'] . "<br>" . "Grupo: " . $martes[$i]['Grupo'] . "</td>";
                    }
                    else
                    {
                        echo "<td></td>";
                    }   
                    if ($miercoles[$i]['HORA_TIPO'] == $horas && $miercoles[$i]['Edificio'] && $miercoles[$i]['Aula'] != null && $miercoles[$i]['Grupo'] != null)
                    {
                        strlen($miercoles[$i]['Aula']) == 1 ? $miercoles[$i]['Aula'] = 0 . $miercoles[$i]['Aula'] : $miercoles[$i]['Aula'];
                        $dia['weekday'] === 'Miercoles' ? $dia['color'] = "success" : $dia['color'] = '';
                        echo "<td class='$dia[color]'>" . "Aula: " . $miercoles[$i]['Edificio'] . $miercoles[$i]['Aula'] . "<br>" . "Grupo: " . $miercoles[$i]['Grupo'] . "</td>";
                    }
                    else
                    {
                        echo "<td></td>";
                    }   
                    if ($jueves[$i]['HORA_TIPO'] == $horas && $jueves[$i]['Edificio'] && $jueves[$i]['Aula'] != null && $jueves[$i]['Grupo'] != null)
                    {
                        strlen($jueves[$i]['Aula']) == 1 ? $jueves[$i]['Aula'] = 0 . $jueves[$i]['Aula'] : $jueves[$i]['Aula'];
                        $dia['weekday'] === 'Jueves' ? $dia['color'] = "success" : $dia['color'] = '';
                        echo "<td class='$dia[color]'>" . "Aula: " . $jueves[$i]['Edificio'] . $jueves[$i]['Aula'] . "<br>" . "Grupo: " . $jueves[$i]['Grupo'] . "</td>";
                    }
                    else
                    {
                        echo "<td></td>";
                    }   
                    if ($viernes[$i]['HORA_TIPO'] == $horas && $viernes[$i]['Edificio'] && $viernes[$i]['Aula'] != null && $viernes[$i]['Grupo'] != null)
                    {
                        strlen($viernes[$i]['Aula']) == 1 ? $viernes[$i]['Aula'] = 0 . $viernes[$i]['Aula'] : $viernes[$i]['Aula'];
                        $dia['weekday'] === 'Viernes' ? $dia['color'] = "success" : $dia['color'] = '';
                        echo "<td class='$dia[color]'>" . "Aula: " . $viernes[$i]['Edificio'] . $viernes[$i]['Aula'] . "<br>" . "Grupo: " . $viernes[$i]['Grupo'] . "</td>";
                    }
                    else
                    {
                        echo "<td></td>";
                    }
                echo "</tr>";
            }
        echo "</tbody>";
        echo "</table>";
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