<?php

if($response = $class->query("SELECT ID, Iniciales, Nombre, Tutor, Activo, Sustituido FROM $class->profesores WHERE ID='$_GET[ID]'"))
{
    
    $datos = $response->fetch_assoc();
    echo '<div class="container" style="margin-top:50px">';
        echo '<div class="wrapper fadeInDown">';
            echo '<div id="formContent">';
                echo '<h1>Edición de Profesor</h1>';
                echo "<form  method='POST' action='$_SERVER[REQUEST_URI]'>";
                    echo "<input type='text' class='hidden' name='ID' value='$datos[ID]'>";
                    echo "<label>Iniciales</label></br>";
                    echo "<input type='text' name='Iniciales' value='$datos[Iniciales]'></br>";
                    echo "<label>Nombre</label></br>";
                    echo "<input type='text' name='Nombre' value='$datos[Nombre]'></br>";
                    echo "<label>Tutor</label></br>";
                    echo "<input type='text' name='Tutor' value='$datos[Tutor]'></br>";
                    echo "<label>Activo</label></br>";
                    echo "<input type='text' class='hidden' id='Activo' name='Activo' value='$datos[Activo]'>";
                    if($response == true)
                    {
                        if($datos['Activo'] == 1)
                        {
                            $datos['Activo'] = 'Si';
                        }
                        else
                        {
                            $datos['Activo'] = 'No';
                        }

                    }
                    echo "<h4>$datos[Activo]</h4>";
                    echo "<label>Sustituido</label></br>";
                    echo "<input type='text' class='hidden' name='Sustituido' value='$datos[Sustituido]'>";
                    if($response == true)
                    {
                        if($datos['Sustituido'] == 1)
                        {
                            $datos['Sustituido'] = 'Si';
                        }
                        else
                        {
                            $datos['Sustituido'] = 'No';
                        }

                    }
                    echo "<h4>$datos[Sustituido]</h4>";
                    echo "<a href='index.php?ACTION=formulario-sustituto&ID=$datos[ID]' class='btn btn-info'>Sustituir</a><br><br>";
                    echo "<button class='btn btn-info' name='ACTION' value='editar_profesor'>Actualizar Profesor</button></br></br>";
                echo "</form>";
            echo '</div>';
        echo '</div>';
    echo '</div>';
    
}
 
else
{
    $ERR_MSG = $class->ERR_NETASYS;
}

?>