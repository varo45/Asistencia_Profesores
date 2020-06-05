<?php

// Validación del formulario

if ($login->filledLogin($_POST['user'], $_POST['pass']))
{
    if(! $login->validFormUser($_POST['user']))
    {
        $ERR_LOGIN_FORM .= "· Nombre de usuario no válido </br>";
    }
    else
    {
        if($bd->bdConex() == 1)
        {
            $conex = $bd->conex;
            $sql = $login->proceedLogin($_POST['user'], $_POST['pass'], $bd->bdConex());
            if($bd->bdCompareLogin($conex, $sql) == 1)
            {
                $_SESSION['logged'] = true;
                $_SESSION['user'] = $_POST['user'];
            }
            else
            {
                $ERR_LOGIN_FORM .= "Nombre de Usuario o Contraseña incorrectos.";
            }
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