<?php

// Validación del formulario

require_once($dirs['class'] . 'Login.php');
require_once($dirs['class'] . 'Database.php');

$valida = new Login;
$bd = new DataBase;

if ($valida->filledLogin($_POST['user'], $_POST['pass']))
{
    if(! $valida->validFormUser($_POST['user']))
    {
        $ERR_LOGIN_FORM .= "· Nombre de usuario no válido";
    }
    else
    {
        $bd->bdConex();
    }
}
else
{
    $ERR_LOGIN_FORM .= "· Rellene los campos vacíos";
}