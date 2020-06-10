<?php
if($user->isAdmin($bd->conex))
{
    $bd->bdConex();
    $conex = $bd->conex;
    $sql = "SELECT * FROM $bd->profesores";
    $ejec = $conex->query($sql);
    echo "<h2>Profesores</h2>";
    if ($row_cnt_profesores = $ejec->num_rows >=1)
    {
        echo "</br><table class='table table-hover'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Nombre</th>";
                    echo "<th>DNI</th>";
                    echo "<th>Administrador</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
                while ($fila = $ejec->fetch_assoc())
                {  
                    echo "<tr class='row_show'>";
                    echo "<td>$fila[ID]</td>";
                    echo "<td>$fila[Nombre]</td>";
                    echo "<td><span class='glyphicon glyphicon-eye-close muestra'></span> <span class='muestra' style='background-color: black; color: black; border-radius: 4px; padding: 4px;'>XXXXXXXXX</span> 
                    <span class='glyphicon glyphicon-eye-open oculta'></span> <span class='oculta' style='border-radius: 4px; padding: 4px; margin-left: 4px;'>$fila[DNI]</span></td>";
                    if($fila['Admin'])
                        echo "<td>Sí</td>";
                    else
                        echo "<td>No</td>";
                    echo "</tr>";
                }
            echo "</tbody>";
        echo "</table>";
        include_once($dirs['public'] . 'js/show_dni.js');
    }
    else
    {
        echo "No existen registros de profesores.";
    }
}