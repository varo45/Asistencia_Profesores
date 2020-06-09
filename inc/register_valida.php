<?php

//Validación del formulario de registro

if($login->validNameRegister($_POST['Nombre']))
{

}
else
{
    $ERR_REG_FORM .= $login->ERR_REG_FORM;
}
if($login->validFormUser($_POST['DNI']))
{

}
else
{
    $ERR_REG_FORM .= $login->ERR_REG_FORM;
}
if($login->encryptPassword($_POST['pass1']) == $login->encryptPassword($_POST['pass2']))
{
  
}
else
{
  $ERR_REG_FORM .= "Las contraseñas no coinciden <br>";
}
if(! isset($ERR_REG_FORM))
{
    if($bd->searchDuplicate($_POST['DNI']))
    {
        if($bd->insertNewUser($_POST['Nombre'], $_POST['DNI'], $login->encryptPassword($_POST['pass1'])))
        {
            $MSG = "Te has registrado correctamente.";
            header("Refresh:2; url=index.php");
            include_once($dirs['inc'] . 'msg_modal.php');
        }
        else
        {
            $ERR_REG_FORM = $bd->ERR_BD;
            include_once($dirs['inc'] . 'register_form.php');
        }
    }
    else
    {
        $ERR_REG_FORM = "El usuario con DNI: $_POST[DNI] ya existe.";
        include_once($dirs['inc'] . 'register_form.php');
    }
}
else
{
    include_once($dirs['inc'] . 'register_form.php');
}