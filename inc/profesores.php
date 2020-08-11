<?php
if($_SESSION['Perfil'] === 'Admin')
{ 
 if ($response = $class->selectFrom("SELECT $class->profesores.ID, $class->profesores.Nombre, $class->profesores.Iniciales, $class->perfiles.Tipo, $class->profesores.Activo, $class->profesores.Sustituido FROM $class->profesores INNER JOIN $class->perfiles ON $class->profesores.TIPO=$class->perfiles.ID"))
 {
   if ($response->num_rows > 0)
   {
    echo "<div id='horario'></div>";
    echo "<h2>Profesores</h2>";
    include_once($dirs['inc'] . 'registrar-profesor.php');
    echo "<br><span class='glyphicon glyphicon-search'></span> <h4 style='display: inline-block; margin-right: 15px;'>Buscar profesor: </h4>
    <input style='width: 25%; display: inline-block;' id='busca_prof' class='form-control' type='text' placeholder='Buscar Profesor...' autocomplete='off'><br>";
    echo "</br><table class='table table-hover'>";
    echo "<thead>";
        echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nombre</th>";
            echo "<th>Iniciales</th>";
            echo "<th>Tipo</th>";
            echo "<th>Activo</th>";
            echo "<th>Sustituido</th>";
            echo "<th>Editar</th>";
            echo "<th>Asistencias</th>";
        echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
        while ($fila = $response->fetch_assoc())
        {  
            if($fila['Activo'] == 1)
            {
              $fila['Activo'] = 'Si';
            }
            else
            {
              $fila['Activo'] = 'No';
            }
            if($fila['Sustituido'] == 0)
            {
              $fila['Sustituido'] = 'No';
            }
            else
            {
              $fila['Sustituido'] = 'Si';
            }
            echo "<tr id='profesor_$fila[ID]' class='row_show'>";
            echo "<td>$fila[ID]</td>";
            echo "<td>$fila[Nombre]</td>";
            echo "<td>$fila[Iniciales]</td>";
            echo "<td>$fila[Tipo]</td>";
            echo "<td>$fila[Activo]</td>";
            echo "<td>$fila[Sustituido]</td>";
            echo "<td><a href='index.php?ACTION=editar_profesor&ID=$fila[ID]'><span class='glyphicon glyphicon-pencil'></span></a></td>";
            echo "<td><a href='index.php?ACTION=faltas_profesor&ID=$fila[ID]'><span class='glyphicon glyphicon-list'></span></a></td>";
        }
    echo "</tbody>";
    echo "</table>";
    include_once($dirs['public'] . 'js/profesores.js');
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
}
else
{
  $ERR_MSG = "No tiene permisos de administrador.";
}
include_once "js/filtro_prof.js";
?>
