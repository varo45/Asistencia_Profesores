<?php

if($response = $class->selectFrom("SELECT ID, Iniciales, Nombre, Tutor FROM $class->profesores WHERE ID='$_GET[ID]'"))
{
    $datos = $response->fetch_assoc();
    echo '<div class="container" style="margin-top:50px">';
        echo '<div class="wrapper fadeInDown">';
            echo '<div id="formContent">';
                echo '<h1>Edición de Profesor</h1>';
                echo "<form action='$_SERVER[REQUEST_URI]'>";
                    echo "<input type='text' class='hidden' name='ID' value='$datos[ID]'>";
                    echo "<label>Iniciales</label></br>";
                    echo "<input type='text' name='Iniciales' value='$datos[Iniciales]'></br>";
                    echo "<label>Nombre</label></br>";
                    echo "<input type='text' name='Nombre' value='$datos[Nombre]'></br>";
                    echo "<label>Tutor</label></br>";
                    echo "<input type='text' name='Tutor' value='$datos[Tutor]'></br></br>";
                    echo "<input type='submit' name='editar_profesor' value='Actulizar Datos'>";
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