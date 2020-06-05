<?php
@session_start();
require_once('../inc/dir_config.php');
require_once($dirs['class'] . 'Login.php');
require_once($dirs['class'] . 'Database.php');

$login = new Login;
$bd = new DataBase;

if(isset($_GET['ACTION']) && $_GET['ACTION'] == 'logout')
{
  include_once($dirs['inc'] . 'logout.php');
}
if(isset($_POST['user']) || isset($_POST['pass']))
{
  require_once($dirs['inc'] . 'login_valida.php');
}
if($login->isLogged())
{
  $bd->bdConex();
    include($dirs['inc'] . 'home.php');
}
else
{
    include_once($dirs['inc'] . 'login_form.php');
}