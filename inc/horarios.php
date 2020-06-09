<?php
$bd->bdConex();
$conex = $bd->conex;
$sql = "SELECT * FROM $bd->horarios INNER JOIN $bd->profesores ON $bd->horarios.ID_PROFESOR=$bd->profesores.ID WHERE DNI='$_SESSION[user]' ORDER BY Hora";
$ejec = $conex->query($sql);
echo "<h2>Horarios</h2>";
if ($row_cnt_horarios = $ejec->num_rows >=1)
{
    echo "</br><table class='table table-striped'>";
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
            while ($fila = $ejec->fetch_assoc())
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
            for ($i = 0; $i < 6; $i++)
            {
                $count=$i+1;
                echo "<tr>";
                    echo "<td>" . $count . "</td>";
                    if ($lunes[$i]['Hora'] == $count && $lunes[$i]['Aula'] != null && $lunes[$i]['Grupo'] != null)
                    {
                        echo "<td>" . "Aula: " . $lunes[$i]['Aula'] . "<br>" . "Grupo: " . $lunes[$i]['Grupo'] . "</td>";
                    }
                    else
                    {
                        echo "<td></td>";
                    }                 
                    if ($martes[$i]['Hora'] == $count && $martes[$i]['Aula'] != null && $martes[$i]['Grupo'] != null)
                    {
                        echo "<td>" . "Aula: " . $martes[$i]['Aula'] . "<br>" . "Grupo: " . $martes[$i]['Grupo'] . "</td>";
                    }
                    else
                    {
                        echo "<td></td>";
                    }   
                    if ($miercoles[$i]['Hora'] == $count && $miercoles[$i]['Aula'] != null && $miercoles[$i]['Grupo'] != null)
                    {
                        echo "<td>" . "Aula: " . $miercoles[$i]['Aula'] . "<br>" . "Grupo: " . $miercoles[$i]['Grupo'] . "</td>";
                    }
                    else
                    {
                        echo "<td></td>";
                    }   
                    if ($jueves[$i]['Hora'] == $count && $jueves[$i]['Aula'] != null && $jueves[$i]['Grupo'] != null)
                    {
                        echo "<td>" . "Aula: " . $jueves[$i]['Aula'] . "<br>" . "Grupo: " . $jueves[$i]['Grupo'] . "</td>";
                    }
                    else
                    {
                        echo "<td></td>";
                    }   
                    if ($viernes[$i]['Hora'] == $count && $viernes[$i]['Aula'] != null && $viernes[$i]['Grupo'] != null)
                    {
                        echo "<td>" . "Aula: " . $viernes[$i]['Aula'] . "<br>" . "Grupo: " . $viernes[$i]['Grupo'] . "</td>";
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
    echo "No existen registros de horarios.";
}