<?php
@session_start();
require_once('../inc/dir_config.php');
require_once($dirs['class'] . 'Login.php');

$login = new Login;
$login->proceedLogout();
if(isset($_POST['user']) || isset($_POST['pass']))
{
  require_once($dirs['inc'] . 'login_valida.php');
}
if($login->isLogged())
{
    include($dirs['inc'] . 'home.php');
}
else
{
    include_once($dirs['inc'] . 'login_form.php');
}