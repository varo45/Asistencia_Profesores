<?php
if($_SESSION['Perfil'] === 'Admin')
{ 
 if ($response = $class->selectFrom("SELECT $class->profesores.ID, $class->profesores.Nombre, $class->profesores.Iniciales, $class->perfiles.Tipo FROM $class->profesores INNER JOIN $class->perfiles ON $class->profesores.TIPO=$class->perfiles.ID"))
 {
   if ($response->num_rows > 0)
   {
    echo "<div id='horario'></div>";
    echo "<h2>Profesores</h2>";
    echo "</br><table class='table table-hover'>";
    echo "<thead>";
        echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nombre</th>";
            echo "<th>Iniciales</th>";
            echo "<th>Tipo</th>";
        echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
        while ($fila = $response->fetch_assoc())
        {  
            echo "<tr id='profesor_$fila[ID]' class='row_show'>";
            echo "<td>$fila[ID]</td>";
            echo "<td>$fila[Nombre]</td>";
            echo "<td>$fila[Iniciales]</td>";
            echo "<td>$fila[Tipo]</td>";
        }
    echo "</tbody>";
    echo "</table>";
    include_once($dirs['public'] . 'js/profesores.js');
    include_once($dirs['inc'] . 'registrar-profesor.php');
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
