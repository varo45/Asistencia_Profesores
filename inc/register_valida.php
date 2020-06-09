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
    header('Location: index.php');
}
else
{
    include_once($dirs['inc'] . 'register_form.php');
}