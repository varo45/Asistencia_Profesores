<?php
// Iniciamos las variables de sesión con @ para que no nos devuelva warnings si la sesión ya estaba iniciada
@session_start();

// Requerimos el fichero de configuración de directorios
// Requerimos los ficheros de las clases que hemos creado
require_once('../inc/dir_config.php');
require_once($dirs['class'] . 'Login.php');
require_once($dirs['class'] . 'Database.php');
require_once($dirs['class'] . 'Users.php');

// iniciamos las clases y las guardamos en variables
$login = new Login;
$bd = new DataBase;
$user = new User;

// Comprobamos si está seteada la variable ACTION en la URL (Método GET)
// Si no es así, procedemos a validar el login, si este es correcto cargamos el fichero home.php
// En su defecto cargaremos el formulario de login
if(isset($_GET['ACTION']))
{
  if ($_GET['ACTION'] == 'logout')
  {
    include_once($dirs['inc'] . 'logout.php');
  }
  elseif ($_GET['ACTION'] == 'horarios') {
    include_once($dirs['inc'] . 'top-nav.php');
    include_once($dirs['inc'] . 'contenido-horarios.php');
    include_once($dirs['inc'] . 'footer.php');
  }
  elseif ($_GET['ACTION'] == 'asistencias') {
    include_once($dirs['inc'] . 'asistencias.php');
  }
  else
  {
    unset($_GET['ACTION']);
  }
}
else
{
  if(isset($_POST['user']) || isset($_POST['pass']))
  {
    require_once($dirs['inc'] . 'login_valida.php');
  }
  if($login->isLogged())
  {
      $ERR_BD = "No ha sido posible fichar.";
      include($dirs['inc'] . 'home.php');
  }
  else
  {
      include_once($dirs['inc'] . 'login_form.php');
  }
}