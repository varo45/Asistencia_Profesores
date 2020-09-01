<?php

// Validación del formulario

if($_POST['Iniciales'] != '' && $_POST['pass'] != '')
{
    if($class->validFormIni($_POST['Iniciales']))
    {
        if($class->Login($_POST['Iniciales'], $_POST['pass']))
        {
            if($_SESSION['Perfil'] === 'Admin')
            {
                header("Location: index.php");
            }
            else
            {
                header("Location: index.php?ACTION=horarios");
            }
        }
        else
        {
            $ERR_LOGIN_FORM = $class->ERR_ASYSTECO;
        }
    }
    else
    {
        $ERR_LOGIN_FORM = $class->ERR_ASYSTECO;
    }
}
else
{
    $ERR_LOGIN_FORM = "· Rellene los campos vacíos </br>";
}