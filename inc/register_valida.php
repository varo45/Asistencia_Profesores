<?php

//Validación del formulario de registro

if ($login->validNameRegister($_POST['Nombre']) && $login->validFormUser($_POST['DNI']))
{
    if ($login->encryptPassword($_POST['pass1']) == $login->encryptPassword($_POST['pass2']))
    {
        
    }
    else
    {
        $ERR_REG_FORM .= "Las contraseñas no coinciden <br>";
    }
}
else
{
    $ERR_REG_FORM .= $login->$ERR_REG_FORM;
}
