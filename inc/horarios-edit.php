<?php
if($response = $class->query("SELECT $class->horarios.* FROM $class->horarios INNER JOIN $class->profesores ON $class->horarios.ID_PROFESOR=$class->profesores.ID WHERE $class->profesores.ID='$_SESSION[ID]' ORDER BY $class->horarios.HORA_TIPO"))
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
                        echo "<td class='$dia[color]'>
                        Aula: <span id='sp_" . $lunes[$i]['ID'] . "_aula' class='txt'>" . $lunes[$i]['Edificio'] . $lunes[$i]['Aula'] . "</span>
                            <input id='in_" . $lunes[$i]['ID'] . "_aula' value='' class='entrada'>
                        <br>" . "
                        Grupo: <span id='sp_" . $lunes[$i]['ID'] . "_grupo' class='txt'>" . $lunes[$i]['Grupo'] . "</span>
                            <input id='in_" . $lunes[$i]['ID'] . "_grupo' value='' class='entrada'></td>";
                    }
                    else
                    {
                        echo "<td class='$dia[color]'>
                        Aula: <span id='sp_" . $lunes[$i]['ID'] . "_aula' class='txt'><i>No asignada</i></span>
                            <input id='in_" . $lunes[$i]['ID'] . "_aula' value='' class='entrada'>
                        <br>" . "
                        Grupo: <span id='sp_" . $lunes[$i]['ID'] . "_grupo' class='txt'><i>No asignado</i></span>
                            <input id='in_" . $lunes[$i]['ID'] . "_grupo' value='' class='entrada'></td>";

                    }                 
                    if ($martes[$i]['HORA_TIPO'] == $horas && $martes[$i]['Edificio'] && $martes[$i]['Aula'] != null && $martes[$i]['Grupo'] != null)
                    {
                        strlen($martes[$i]['Aula']) == 1 ? $martes[$i]['Aula'] = 0 . $martes[$i]['Aula'] : $martes[$i]['Aula'];
                        $dia['weekday'] === 'Martes' ? $dia['color'] = "success" : $dia['color'] = '';
                        echo "<td class='$dia[color]'>
                        Aula: <span id='sp_" . $martes[$i]['ID'] . "_aula' class='txt'>" . $martes[$i]['Edificio'] . $martes[$i]['Aula'] . "</span>
                            <input id='in_" . $martes[$i]['ID'] . "_aula' value='' class='entrada'>
                        <br>" . "
                        Grupo: <span id='sp_" . $martes[$i]['ID'] . "_grupo' class='txt'>" . $martes[$i]['Grupo'] . "</span>
                            <input id='in_" . $martes[$i]['ID'] . "_grupo' value='' class='entrada'></td>";
                    }
                    else
                    {
                        echo "<td class='$dia[color]'>
                        Aula: <span class='vacio'><i>No asignada</i></span>
                            <input id='in_" . $martes[$i]['ID'] . "_aula' value='' class='entrada'>
                        <br>" . "
                        Grupo: <span class='vacio'><i>No asignado</i></span>
                            <input id='in_" . $martes[$i]['ID'] . "_grupo' value='' class='entrada'></td>";
                    }   
                    if ($miercoles[$i]['HORA_TIPO'] == $horas && $miercoles[$i]['Edificio'] && $miercoles[$i]['Aula'] != null && $miercoles[$i]['Grupo'] != null)
                    {
                        strlen($miercoles[$i]['Aula']) == 1 ? $miercoles[$i]['Aula'] = 0 . $miercoles[$i]['Aula'] : $miercoles[$i]['Aula'];
                        $dia['weekday'] === 'Miercoles' ? $dia['color'] = "success" : $dia['color'] = '';
                        echo "<td class='$dia[color]'>
                        Aula: <span id='sp_" . $miercoles[$i]['ID'] . "_aula' class='txt'>" . $miercoles[$i]['Edificio'] . $miercoles[$i]['Aula'] . "</span>
                            <input id='in_" . $miercoles[$i]['ID'] . "_aula' value='' class='entrada'>
                        <br>" . "
                        Grupo: <span id='sp_" . $miercoles[$i]['ID'] . "_grupo' class='txt'>" . $miercoles[$i]['Grupo'] . "</span>
                            <input id='in_" . $miercoles[$i]['ID'] . "_grupo' value='' class='entrada'></td>";
                    }
                    else
                    {
                        echo "<td class='$dia[color]'>
                        Aula: <span class='vacio'><i>No asignada</i></span>
                            <input id='in_" . $miercoles[$i]['ID'] . "_aula' value='' class='entrada'>
                        <br>" . "
                        Grupo: <span class='vacio'><i>No asignado</i></span>
                            <input id='in_" . $miercoles[$i]['ID'] . "_grupo' value='' class='entrada'></td>";
                    }   
                    if ($jueves[$i]['HORA_TIPO'] == $horas && $jueves[$i]['Edificio'] && $jueves[$i]['Aula'] != null && $jueves[$i]['Grupo'] != null)
                    {
                        strlen($jueves[$i]['Aula']) == 1 ? $jueves[$i]['Aula'] = 0 . $jueves[$i]['Aula'] : $jueves[$i]['Aula'];
                        $dia['weekday'] === 'Jueves' ? $dia['color'] = "success" : $dia['color'] = '';
                        echo "<td class='$dia[color]'>
                        Aula: <span id='sp_" . $jueves[$i]['ID'] . "_aula' class='txt'>" . $jueves[$i]['Edificio'] . $jueves[$i]['Aula'] . "</span>
                            <input id='in_" . $jueves[$i]['ID'] . "_aula' value='' class='entrada'>
                        <br>" . "
                        Grupo: <span id='sp_" . $jueves[$i]['ID'] . "_grupo' class='txt'>" . $jueves[$i]['Grupo'] . "</span>
                            <input id='in_" . $jueves[$i]['ID'] . "_grupo' value='' class='entrada'></td>";
                    }
                    else
                    {
                        echo "<td class='$dia[color]'>
                        Aula: <span class='vacio'><i>No asignada</i></span>
                            <input id='in_" . $jueves[$i]['ID'] . "_aula' value='' class='entrada'>
                        <br>" . "
                        Grupo: <span class='vacio'><i>No asignado</i></span>
                            <input id='in_" . $jueves[$i]['ID'] . "_grupo' value='' class='entrada'></td>";
                    }   
                    if ($viernes[$i]['HORA_TIPO'] == $horas && $viernes[$i]['Edificio'] && $viernes[$i]['Aula'] != null && $viernes[$i]['Grupo'] != null)
                    {
                        strlen($viernes[$i]['Aula']) == 1 ? $viernes[$i]['Aula'] = 0 . $viernes[$i]['Aula'] : $viernes[$i]['Aula'];
                        $dia['weekday'] === 'Viernes' ? $dia['color'] = "success" : $dia['color'] = '';
                        echo "<td class='$dia[color]'>
                        Aula: <span id='sp_" . $viernes[$i]['ID'] . "_aula' class='txt'>" . $viernes[$i]['Edificio'] . $viernes[$i]['Aula'] . "</span>
                            <input id='in_" . $viernes[$i]['ID'] . "_aula' value='' class='entrada'>
                        <br>" . "
                        Grupo: <span id='sp_" . $viernes[$i]['ID'] . "_grupo' class='txt'>" . $viernes[$i]['Grupo'] . "</span>
                            <input id='in_" . $viernes[$i]['ID'] . "_grupo' value='' class='entrada'></td>";
                    }
                    else
                    {
                        echo "<td class='$dia[color]'>
                        Aula: <span class='vacio'><i>No asignada</i></span>
                            <input id='in_" . $viernes[$i]['ID'] . "_aula' value='' class='entrada'>
                        <br>" . "
                        Grupo: <span class='vacio'><i>No asignado</i></span>
                            <input id='in_" . $viernes[$i]['ID'] . "_grupo' value='' class='entrada'></td>";
                    }
                echo "</tr>";
            }
        echo "</tbody>";
        echo "</table>";
        echo "<div id='response'></div>";
    }
    else
    {
        $ERR_MSG = $class->ERR_ASYSTECO;
    }
}
else
{
    $ERR_MSG = $class->ERR_ASYSTECO;
}