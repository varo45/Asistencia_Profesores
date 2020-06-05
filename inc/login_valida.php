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
        $ERR_LOGIN_FORM .= "· Nombre de usuario no válido </br>";
    }
    else
    {
        if($bd->bdConex() == 1)
        {
            $_SESSION['logged'] = true;
            $_SESSION['user'] = $_POST['user'];
        }
        else
        {
            $ERR_LOGIN_FORM .= "· No ha sido posible conectar con la base de datos. </br>";
        }
    }
}
else
{
    $ERR_LOGIN_FORM .= "· Rellene los campos vacíos </br>";
}