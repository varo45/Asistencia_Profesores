<?php

// Validación del formulario

if($_POST['DNI'] != '' && $_POST['pass'] != '')
{
    if($class->validFormDni($_POST['DNI']))
    {
        if($class->Login($_POST['DNI'], $_POST['pass']))
        {
            header("Location: index.php");
        }
        else
        {
            $ERR_LOGIN_FORM = $class->ERR_NETASYS;
        }
    }
    else
    {
        $ERR_LOGIN_FORM = $class->ERR_NETASYS;
    }
}
else
{
    $ERR_LOGIN_FORM = "· Rellene los campos vacíos </br>";
}