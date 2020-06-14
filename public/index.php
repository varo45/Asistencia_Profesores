<?php
// Iniciamos las variables de sesión con @ para que no nos devuelva warnings si la sesión ya estaba iniciada
@session_start();

// Requerimos el fichero de configuración de directorios
// Requerimos los ficheros de las clases que hemos creado
require_once('../inc/dir_config.php');
require_once($dirs['class'] . 'Netasys.php');

// iniciamos las clases y las guardamos en variables
$class = new Netasys;

// Comprobamos si está seteada la variable ACTION en la URL (Método GET)
// Si no es así, procedemos a validar el login, si este es correcto cargamos el fichero home.php
// En su defecto cargaremos el formulario de login
if(isset($_GET['ACTION']))
{
  if ($_GET['ACTION'] == 'logout')
  {
    include_once($dirs['inc'] . 'logout.php');
  }
  elseif ($_GET['ACTION'] == 'registrarse') 
  {
    if(isset($_POST['Nombre']) || isset($_POST['DNI']) || isset($_POST['pass1']) || isset($_POST['pass2']))
    {
      include_once($dirs['inc'] . 'register_valida.php');
    }
    else
    {
      include_once($dirs['inc'] . 'register_form.php');
    }
  }
  elseif ($_GET['ACTION'] == 'horarios')
  {
    if($class->isLogged())
    {
      include_once($dirs['inc'] . 'top-nav.php');
      include_once($dirs['inc'] . 'contenido-horarios.php');
      include_once($dirs['inc'] . 'footer.php');
    }
    else
    {
      $MSG = "Debes iniciar sesión para ver los horarios.";
      header("Refresh:2; url=index.php");
      include_once($dirs['inc'] . 'msg_modal.php');
    }
  }
  elseif ($_GET['ACTION'] == 'asistencias')
  {
      include_once($dirs['inc'] . 'top-nav.php');
      include_once($dirs['inc'] . 'contenido-asistencias.php');
      include_once($dirs['inc'] . 'footer.php');
  }
  elseif ($_GET['ACTION'] == 'profesores')
  {
      if($class->isLogged())
      {
        include_once($dirs['inc'] . 'top-nav.php');
        include_once($dirs['inc'] . 'contenido-profesores.php');
        include_once($dirs['inc'] . 'footer.php');
      }
      else
      {
        $MSG = "Debes iniciar sesión para acceder a la lista de profesores.";
        header("Refresh:2; url=index.php");
        include_once($dirs['inc'] . 'msg_modal.php');
      }
  }
  elseif ($_GET['ACTION'] == 'guardias')
  {
    if($class->isLogged())
    {
      include_once($dirs['inc'] . 'top-nav.php');
      include_once($dirs['inc'] . 'contenido-guardias.php');
      include_once($dirs['inc'] . 'footer.php');
    }
    else
    {
      $MSG = "Debes iniciar sesión para acceder a la lista de profesores.";
      header("Refresh:2; url=index.php");
      include_once($dirs['inc'] . 'msg_modal.php');
    }
  }
  elseif ($_GET['ACTION'] == 'fichar')
  {
    if($class->isLogged())
    {
      if($bd->searchDuplicateDay())
      {
        if($bd->FicharWeb())
        {
          $MSG_BD = "Has fichado correctamente";
        }
        else
        {
          $ERR_BD .= "Ha ocurrido un error, no has podido fichar. <br>";
          $ERR_BD .= "Debes tener un horario para poder fichar. <br>";
        }
      }
      else
      {
        $MSG_BD = "Ya has fichado hoy.";
      }
      header("Refresh:2; url=index.php");
      include_once($dirs['inc'] . 'top-nav.php');
      include_once($dirs['inc'] . 'contenido-home.php');
      include_once($dirs['inc'] . 'contenido-fichajes.php');
      include_once($dirs['inc'] . 'footer.php');
    }
    else
    {
      $MSG = "Debes iniciar sesión para fichar.";
      header("Refresh:2; url=index.php");
      include_once($dirs['inc'] . 'msg_modal.php');
    }
  }
  elseif ($_GET['ACTION'] == 'fichar_salida')
  {
    if($class->isLogged())
    {
      header("Refresh:2; url=index.php");
      include_once($dirs['inc'] . 'top-nav.php');
      include_once($dirs['inc'] . 'fichar-salida.php');
      include_once($dirs['inc'] . 'contenido-home.php');
      include_once($dirs['inc'] . 'contenido-fichajes.php');
      include_once($dirs['inc'] . 'footer.php');
    }
    else
    {
      $MSG = "Debes iniciar sesión para fichar.";
      header("Refresh:2; url=index.php");
      include_once($dirs['inc'] . 'msg_modal.php');
    }
  }
  else
  {
    header("Refresh:0; url=index.php");
  }
}
else
{
  if(isset($_POST['DNI']) || isset($_POST['pass']))
  {
    require_once($dirs['inc'] . 'login_valida.php');
  }
  if($class->isLogged())
  {
      include($dirs['inc'] . 'home.php');
  }
  else
  {
      include_once($dirs['inc'] . 'login_form.php');
  }
}