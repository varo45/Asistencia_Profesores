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
  switch($_GET['ACTION'])
  {
    default:
      if(isset($_POST['Iniciales']) || isset($_POST['pass']))
      {
        require_once($dirs['inc'] . 'login_valida.php');
      }
      if($class->isLogged())
      {
        $act_home = 'active';
        include($dirs['inc'] . 'home.php');
      }
      else
      {
          include_once($dirs['inc'] . 'login_form.php');
      }
    break;
  
    case 'logout':
      include_once($dirs['inc'] . 'logout.php');
    break;
  
    case 'pruebas':
      include_once($dirs['inc'] . 'top-nav.php');
      include_once($dirs['inc'] . 'pruebas.php');
      include_once($dirs['inc'] . 'footer.php');
    break;
  
    case 'cambio_pass':
      include_once($dirs['inc'] . 'top-nav.php');
      include_once($dirs['inc'] . 'new_pass.php');
      include_once($dirs['inc'] . 'errors.php');
      include_once($dirs['inc'] . 'footer.php');
    break;
  
    case 'lectivos':
      include_once($dirs['inc'] . 'top-nav.php');
      include_once($dirs['inc'] . 'lectivos.php');
      include_once($dirs['inc'] . 'errors.php');
      include_once($dirs['inc'] . 'footer.php');
    break;
  
    case 'qrcoder':
      if($class->isLogged())
      {
        include_once($dirs['inc'] . 'top-nav.php');
        include_once($dirs['inc'] . 'generate_code.php');
        include_once($dirs['inc'] . 'errors.php');
        include_once($dirs['inc'] . 'footer.php');
      }
      else
      {
        $MSG = "Debes iniciar sesión para ver la identificación.";
        header("Refresh:2; url=index.php");
        include_once($dirs['inc'] . 'msg_modal.php');
      }
    break;
  
    case 'registrarse':
      if(isset($_POST['Nombre']) || isset($_POST['Iniciales']) || isset($_POST['pass1']) || isset($_POST['pass2']))
      {
        include_once($dirs['inc'] . 'register_valida.php');
      }
      else
      {
        include_once($dirs['inc'] . 'register_form.php');
      }
    break;
  
    case 'horarios':
      if($class->isLogged())
      {
        $act_horario = 'active';
        include_once($dirs['inc'] . 'top-nav.php');
        include_once($dirs['inc'] . 'contenido-horarios.php');
        include_once($dirs['inc'] . 'errors.php');
        include_once($dirs['inc'] . 'footer.php');
      }
      else
      {
        $MSG = "Debes iniciar sesión para ver los horarios.";
        header("Refresh:2; url=index.php");
        include_once($dirs['inc'] . 'msg_modal.php');
      }
    break;
  
    case 'crear-horario':
      if($class->isLogged())
      {
        $act_horario = 'active';
        include_once($dirs['inc'] . 'top-nav.php');
        include_once($dirs['inc'] . 'contenido-horarios.php');
        include_once($dirs['inc'] . 'errors.php');
        include_once($dirs['inc'] . 'footer.php');
      }
      else
      {
        $MSG = "Debes iniciar sesión para ver los horarios.";
        header("Refresh:2; url=index.php");
        include_once($dirs['inc'] . 'msg_modal.php');
      }
    break;
      
    case 'modificar-horario':
      if($class->isLogged())
      {
        $act_horario = 'active';
        include_once($dirs['inc'] . 'top-nav.php');
        include_once($dirs['inc'] . 'modificar-horario.php');
        include_once($dirs['inc'] . 'contenido-horarios.php');
        include_once($dirs['inc'] . 'errors.php');
        include_once($dirs['inc'] . 'footer.php');
      }
      else
      {
        $MSG = "Debes iniciar sesión para ver los horarios.";
        header("Refresh:2; url=index.php");
        include_once($dirs['inc'] . 'msg_modal.php');
      }
    break;
  
    case 'update-horario':
      include_once($dirs['inc'] . 'actualiza.php');
    break;
  
    case 'asistencias':
      $act_asistencia = 'active';
      include_once($dirs['inc'] . 'top-nav.php');
      include_once($dirs['inc'] . 'contenido-fichajes.php');
      include_once($dirs['inc'] . 'errors.php');
      include_once($dirs['inc'] . 'footer.php');
    break;
  
    case 'import-horario':
      $act_horario = 'active';
      include_once($dirs['inc'] . 'top-nav.php');
      include_once($dirs['inc'] . 'contenido-import-horario.php');
      include_once($dirs['inc'] . 'errors.php');
      include_once($dirs['inc'] . 'footer.php');
    break;
  
    case 'import-profesorado':
      $act_horario = 'active';
      include_once($dirs['inc'] . 'top-nav.php');
      include_once($dirs['inc'] . 'contenido-import-profesorado.php');
      include_once($dirs['inc'] . 'errors.php');
      include_once($dirs['inc'] . 'footer.php');
    break;
  
    case 'profesores':
      if($class->isLogged())
      {
        $act_profesores = 'active';
        if(isset($_GET['profesor']) && $_GET['profesor'] != '')
        {
          include_once($dirs['inc'] . 'contenido-horario-profesor.php');
        }
        else
        {
          if(isset($_POST['boton']))
          {
            if($class->validRegisterProf())
            {
              header('location: index.php?ACTION=profesores');
            }
            else
            {
              include_once($dirs['inc'] . 'top-nav.php');
              include_once($dirs['inc'] . 'contenido-profesores.php');
              include_once($dirs['inc'] . 'errors.php');
              include_once($dirs['inc'] . 'footer.php');
            }
          }
          else
          {
            include_once($dirs['inc'] . 'top-nav.php');
            include_once($dirs['inc'] . 'contenido-profesores.php');
            include_once($dirs['inc'] . 'errors.php');
            include_once($dirs['inc'] . 'footer.php');
          }
        }
      }
      else
      {
        $MSG = "Debes iniciar sesión para acceder a la lista de profesores.";
        header("Refresh:2; url=index.php");
        include_once($dirs['inc'] . 'msg_modal.php');
      }
    break;
  
    case 'guardias':
      if($class->isLogged())
      {
        $act_guardias = 'active';
        include_once($dirs['inc'] . 'top-nav.php');
        include_once($dirs['inc'] . 'contenido-guardias.php');
        include_once($dirs['inc'] . 'errors.php');
        include_once($dirs['inc'] . 'footer.php');
      }
      else
      {
        $MSG = "Debes iniciar sesión para acceder a la lista de profesores.";
        header("Refresh:2; url=index.php");
        include_once($dirs['inc'] . 'msg_modal.php');
      }
    break;
  
    case 'Edificio':
      if(isset($_GET['Numero']))
      {
        if($class->isLogged())
        {
          $act_home = 'active';
          $extras = <<< EOL
          <style>
              canvas {box-shadow: 4px 4px 8px black; padding: 2px; }
              .respuesta span {display: block;box-shadow: 4px 4px 8px black; padding: 50px; border-radius: 10px; margin-top: 30px;}
          </style>
          <script type="text/javascript" src="js/jsqrcode/grid.js"></script>
          <script type="text/javascript" src="js/jsqrcode/version.js"></script>
          <script type="text/javascript" src="js/jsqrcode/detector.js"></script>
          <script type="text/javascript" src="js/jsqrcode/formatinf.js"></script>
          <script type="text/javascript" src="js/jsqrcode/errorlevel.js"></script>
          <script type="text/javascript" src="js/jsqrcode/bitmat.js"></script>
          <script type="text/javascript" src="js/jsqrcode/datablock.js"></script>
          <script type="text/javascript" src="js/jsqrcode/bmparser.js"></script>
          <script type="text/javascript" src="js/jsqrcode/datamask.js"></script>
          <script type="text/javascript" src="js/jsqrcode/rsdecoder.js"></script>
          <script type="text/javascript" src="js/jsqrcode/gf256poly.js"></script>
          <script type="text/javascript" src="js/jsqrcode/gf256.js"></script>
          <script type="text/javascript" src="js/jsqrcode/decoder.js"></script>
          <script type="text/javascript" src="js/jsqrcode/qrcode.js"></script>
          <script type="text/javascript" src="js/jsqrcode/findpat.js"></script>
          <script type="text/javascript" src="js/jsqrcode/alignpat.js"></script>
          <script type="text/javascript" src="js/jsqrcode/databr.js"></script>
EOL;
          include($dirs['inc'] . 'top-nav.php');
          include($dirs['inc'] . 'contenido-home.php');
          include($dirs['inc'] . 'qr-reader.php');
          include($dirs['inc'] . 'filtro-edif-guardias.php');
          include($dirs['inc'] . 'contenido-guardias.php');
          include($dirs['inc'] . 'errors.php');
          include($dirs['inc'] . 'footer.php');
        }
        else
        {
          $MSG = "Debes iniciar sesión para acceder a la lista de profesores.";
          header("Refresh:2; url=index.php");
          include_once($dirs['inc'] . 'msg_modal.php');
        }
      }
      else
      {
        header("Location: url=index.php");
      }
    break;
  
    case 'fichar':
      if($class->isLogged())
      {
        $dia = $class->getDate();
        if($dia['weekday'] != 'Sabado' && $dia['weekday'] != 'Domingo')
        {
          if($class->searchDuplicateField(date('Y-m-d'), 'Fecha', $class->fichar))
          {
            if($class->FicharWeb())
            {
              $ERR_MSG = "Has fichado correctamente";
            }
            else
            {
              $ERR_MSG .= "Debes tener un horario para poder fichar. <br>";
            }
          }
          else
          {
            $ERR_MSG = "Ya has fichado hoy.";
          }
          header("Refresh:2; url=index.php");
          include_once($dirs['inc'] . 'top-nav.php');
          include_once($dirs['inc'] . 'contenido-home.php');
          include_once($dirs['inc'] . 'contenido-fichajes.php');
          include_once($dirs['inc'] . 'errors.php');
          include_once($dirs['inc'] . 'footer.php');
        }
        else
        {
          $MSG = "No puedes fichar un fin de semana.";
          header("Refresh:2; url=index.php");
          include_once($dirs['inc'] . 'msg_modal.php');
        }
      }
      else
      {
        $MSG = "Debes iniciar sesión para fichar.";
        header("Refresh:2; url=index.php");
        include_once($dirs['inc'] . 'msg_modal.php');
      }
    break;
    
    case 'fichar_salida':
      if($class->isLogged())
      {
        header("Refresh:2; url=index.php");
        include_once($dirs['inc'] . 'top-nav.php');
        include_once($dirs['inc'] . 'fichar-salida.php');
        include_once($dirs['inc'] . 'contenido-home.php');
        include_once($dirs['inc'] . 'contenido-fichajes.php');
        include_once($dirs['inc'] . 'errors.php');
        include_once($dirs['inc'] . 'footer.php');
      }
      else
      {
        $MSG = "Debes iniciar sesión para fichar.";
        header("Refresh:2; url=index.php");
        include_once($dirs['inc'] . 'msg_modal.php');
      }
    break;
  
    case 'fichar-asist':
      include_once($dirs['inc'] . 'fichar-asistencia.php');
    break;
  }
}
else
{
  if(isset($_POST['Iniciales']) || isset($_POST['pass']))
  {
    require_once($dirs['inc'] . 'login_valida.php');
  }
  if($class->isLogged())
  {
    $act_home = 'active';
    include($dirs['inc'] . 'home.php');
  }
  else
  {
      include_once($dirs['inc'] . 'login_form.php');
  }
}