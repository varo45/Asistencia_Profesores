<?php

// Validación del formulario

require_once($dirs['class'] . 'login.php');

$valida = new Login;

if ($valida->filledLogin($_POST['user'], $_POST['pass']))
{
    if(! $valida->validFormUser($_POST['user']))
    {
        $ERR_LOGIN_FORM .= "· Nombre de usuario no válido";
    }
    else
    {
        return true;
    }
}
else
{
    $ERR_LOGIN_FORM .= "· Rellene los campos vacíos";
}