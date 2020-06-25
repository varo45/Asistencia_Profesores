<?php
if(isset($_POST['boton']))
{
    if(! $class->validFormName($_POST['nombre']))
    {
        $ERR_MSG = "Formato de nombre incorrecto.";
    }
    elseif(! $class->validFormName($_POST['Iniciales']))
    {
        $ERR_MSG = "Formato de iniciales incorrecto.";
    }
    else
    {
        if($class->insertInto("INSERT INTO $class->profesores VALUES ('$_POST[nombre]', '$_POST[Iniciales]')"))
        {
            $MSG = "Profesor añadido correctamente.";
        }
        else
        {
            $ERR_MSG = $class->ERR_NETASYS;
        }
    }
    echo "<div>";
        echo "<form action='$_SERVER[REQUEST_URI]' method='POST'>";
        echo "<input type='text' name='nombre' value='$_POST[nombre]' placeholder='Nombre y Apellidos'><br><br>";
        echo "<input type='text' name='iniciales' value='$_POST[iniciales]' placeholder='Iniciales'><br><br>";
        echo "<button value='registrar_prof' name='boton' class='btn btn-default' onclick='return confirm(\"¿Desea registrar a este profesor?\")'>Registrar</button>";
        echo "</form>";
    echo "</div>";
}
else
{
echo "<div>";
    echo "<form action='$_SERVER[REQUEST_URI]' method='POST'>";
    echo "<input type='text' name='nombre' value='$_POST[nombre]' class='btn btn-default' placeholder='Nombre y Apellidos'><br><br>";
    echo "<input type='text' name='iniciales' value='$_POST[iniciales]' class='btn btn-default' placeholder='Iniciales'><br><br>";
    echo "<button value='registrar_prof' name='boton' class='btn btn-default' onclick='return confirm(\"¿Desea registrar a este profesor?\")'>Registrar</button>";
    echo "</form>";
echo "</div>";
}

?>