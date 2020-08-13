<?php

$sql = "SELECT Horarios.*,
Profesores.Nombre,
Profesores.Iniciales,
Diasemana.Diasemana
FROM
(Horarios INNER JOIN Profesores ON Horarios.ID_PROFESOR=Profesores.ID)
INNER JOIN Diasemana ON Diasemana.ID=Horarios.Dia
ORDER BY ID_PROFESOR, Dia, HORA_TIPO";

$result = $class->query($sql);
if (! empty($result)) 
{
echo "<h2>Registros de Horarios</h2>"; 
echo "<table id='userTable' class='table'>
<thead>
    <tr>
        <th>ID</th>
        <th>Curso</th>
        <th>Abreviatura profesor</th>
        <th>Profesor</th>
        <th>Aula</th>
        <th>Diasemana</th>
        <th>Hora</th>
    </tr>
</thead>
";
    foreach ($result as $row) 
    {
echo "
    <tbody>
        <tr>
            <td>$row[ID]</td>
            <td>$row[Grupo]</td>
            <td>$row[Iniciales]</td>
            <td>$row[Nombre]</td>
            <td>$row[Aula]</td>
            <td>$row[Diasemana]</td>
            <td>$row[HORA_TIPO]</td>
        </tr>
    ";
    }
}
 echo "
    </tbody>
    </table>  
    ";  