<?php
if(isset($_POST['boton']))
{
    if(! $class->validFormName($_POST['Nombre']))
    {
        $ERR_MSG = "Formato de Nombre incorrecto.";
    }
    elseif(! $class->validFormIni($_POST['Iniciales']))
    {
        $ERR_MSG = "Formato de iniciales incorrecto.";
    }
    else
    {
        if($class->searchDuplicateField($_POST['Iniciales'], 'Iniciales', $class->profesores))
        {
            if($class->insertInto("INSERT INTO $class->profesores (Nombre, Iniciales, Password, TIPO, Instituto) 
            VALUES ('$_POST[Nombre]', '$_POST[Iniciales]', 'f36c0d6388963313095f349dabd4c2e9f730868e', '2', 'IES Bezmiliana')"))
            {
                $MSG = "Profesor añadido correctamente.";
            }
            else
            {
                $ERR_MSG = $class->ERR_NETASYS;
            }
        }
        else
        {
            $ERR_MSG = "No se pueden duplicar las iniciales.";
        }

    }
    echo "<div>";
        echo "<form action='$_SERVER[REQUEST_URI]' method='POST'>";
        echo "<input type='text' name='Nombre' value='$_POST[Nombre]' placeholder='Nombre y Apellidos'><br><br>";
        echo "<input type='text' name='Iniciales' value='$_POST[Iniciales]' placeholder='Iniciales'><br><br>";
        echo "<button value='registrar_prof' name='boton' class='btn btn-default' onclick='return confirm(\"¿Desea registrar a este profesor?\")'>Registrar</button>";
        echo "</form>";
    echo "</div>";
}
else
{
echo "<div>";
    echo "<form action='$_SERVER[REQUEST_URI]' method='POST'>";
    echo "<input type='text' name='Nombre' value='$_POST[Nombre]' class='btn btn-default' placeholder='Nombre y Apellidos'><br><br>";
    echo "<input type='text' name='Iniciales' value='$_POST[Iniciales]' class='btn btn-default' placeholder='Iniciales'><br><br>";
    echo "<button value='registrar_prof' name='boton' class='btn btn-default' onclick='return confirm(\"¿Desea registrar a este profesor?\")'>Registrar</button>";
    echo "</form>";
echo "</div>";
}

?>