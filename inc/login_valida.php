<?php

// Validación del formulario

require_once($dirs['class'] . 'login.php');

$valida = new Login;

if ($valida->filledLogin($_POST['user'], $_POST['pass']))
{
    if($valida->validFormUser($_POST['user']))
    {
        echo "usuario válido";
    }
    else
    {
        echo "Usuario no válido";
    }
}
else
{
    echo "rellenar campos";
}