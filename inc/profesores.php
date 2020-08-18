<?php
if($_SESSION['Perfil'] === 'Admin')
{ 
 if ($response = $class->query("SELECT $class->profesores.ID, $class->profesores.Nombre, $class->profesores.Iniciales, $class->perfiles.Tipo, $class->profesores.Activo, $class->profesores.Sustituido FROM $class->profesores INNER JOIN $class->perfiles ON $class->profesores.TIPO=$class->perfiles.ID"))
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
            echo "<th>Desactivar/Activar Profesor</th>";
            echo "<th>Reset Contraseña Profesor</th>";
        echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
        while ($fila = $response->fetch_assoc())
        {  
            if($fila['Activo'] == 1)
            {
              $activo = 'Si';
            }
            else
            {
              $activo = 'No';
            }

            if($fila['Sustituido'] == 0)
            {
              $sustituido = 'No';
            }
            else
            {
              $sustituido = 'Si';
            }
            
            echo "<tr id='profesor_$fila[ID]' class='row_show'>";
            echo "<td>$fila[ID]</td>";
            echo "<td>$fila[Nombre]</td>";
            echo "<td>$fila[Iniciales]</td>";
            echo "<td>$fila[Tipo]</td>";
            echo "<td>$activo</td>";
            echo "<td>$sustituido</td>";
            echo "<td><a href='index.php?ACTION=editar_profesor&ID=$fila[ID]'><span class='glyphicon glyphicon-pencil'></span></a></td>";
            echo "<td><a href='index.php?ACTION=faltas_profesor&ID=$fila[ID]'><span class='glyphicon glyphicon-list'></span></a></td>";
            if($fila['Activo'] == 1)
            {
              echo "<td>
                <a href='index.php?ACTION=desactivar-profesor&ID=$fila[ID]'
                    onclick=\"return confirm('¿Seguro que desea realizar este cambio? Utilice solo esta opción si el profesor deja el centro por motivos de jubilación, fin de una sustitución o similares.')\">
                    <span class='glyphicon glyphicon-remove'></span>
                </a>
              </td>";
            }
            else
            {
              echo "<td>
                <a href='index.php?ACTION=reactivar-profesor&ID=$fila[ID]'
                    onclick=\"return confirm('¿Seguro que desea realizar este cambio? Utilice solo esta opción si el profesor deja el centro por motivos de jubilación, fin de una sustitución o similares.')\">
                    <span class='glyphicon glyphicon-ok'></span>
                </a>
              </td>";
            }
            echo "<td><a href='index.php?ACTION=reset_pass&ID=$fila[ID]' onclick=\"return confirm('Va a reicicializar la contraseña de $fila[Nombre]  ¿Es correcto?.')\"><span class='glyphicon glyphicon-refresh'></span></a></td>";
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
