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
if (! empty($result)) {
   
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
</thead>";
    foreach ($result as $row) {
        ?>
        
    <tbody>
    <tr>
        <td><?php  echo $row['ID']; ?></td>
        <td><?php  echo $row['Grupo']; ?></td>
        <td><?php  echo $row['Iniciales']; ?></td>
        <td><?php  echo $row['Nombre']; ?></td>
        <td><?php  echo $row['Aula']; ?></td>
        <td><?php  echo $row['Diasemana']; ?></td>
        <td><?php  echo $row['HORA_TIPO']; ?></td>
    </tr>
        <?php
    }
    ?>
    </tbody>
</table>
<?php } ?>