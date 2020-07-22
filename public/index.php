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
          if($class->compruebaCambioPass())
          {
            $act_home = 'active';
            include($dirs['inc'] . 'home.php');
          }
          else
          {
            header('Location: index.php?ACTION=primer_cambio');
          }
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
        $extras = '<link rel="stylesheet" href="css/login-style.css">';
        include_once($dirs['inc'] . 'top-nav.php');
        include_once($dirs['inc'] . 'pruebas.php');
        include_once($dirs['inc'] . 'footer.php');
      break;
      
      case 'pruebas-carlos':
        include_once($dirs['inc'] . 'top-nav.php');
        include_once($dirs['inc'] . 'pruebas-carlos.php');
        include_once($dirs['inc'] . 'footer.php');
      break;
  
      case 'pruebas-varo':
        include_once($dirs['inc'] . 'top-nav.php');
        include_once($dirs['inc'] . 'pruebas-varo.php');
        include_once($dirs['inc'] . 'errors.php');
        include_once($dirs['inc'] . 'footer.php');
      break;
  
      case 'cambio_pass':
        $extras = '<link rel="stylesheet" href="css/login-style.css">';
        include_once($dirs['inc'] . 'valida_new_pass.php');
        include_once($dirs['inc'] . 'top-nav.php');
        include_once($dirs['inc'] . 'new_pass.php');
        include_once($dirs['inc'] . 'errors.php');
        include_once($dirs['inc'] . 'footer.php');
      break;
  
      case 'primer_cambio':
        $extras = '<link rel="stylesheet" href="css/login-style.css">';
        include_once($dirs['inc'] . 'valida_primer_cambio.php');
        include_once($dirs['inc'] . 'top-nav.php');
        include_once($dirs['inc'] . 'primer_cambio.php');
        include_once($dirs['inc'] . 'errors.php');
        include_once($dirs['inc'] . 'footer.php');
      break;
    
      case 'lectivos':
        if($class->isLogged())
        {
          if($class->compruebaCambioPass())
          {
          $extras = '<link rel="stylesheet" href="css/form.css">';
          $extras .= "<script>
            $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '< Ant',
            nextText: 'Sig >',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['es']);
        
            $(function (){
                $('#datepicker_ini').datepicker();
            });
            $(function (){
                $('#datepicker_fin').datepicker();
            });
            $(function (){
                $('#datepicker_ini_fest').datepicker();
            });
            $(function (){
                $('#datepicker_fin_fest').datepicker();
            });
          </script>";
            include_once($dirs['inc'] . 'top-nav.php');
            include_once($dirs['inc'] . 'lectivos.php');
            include_once($dirs['inc'] . 'errors.php');
            include_once($dirs['inc'] . 'footer.php');
          }
          else
          {
            header('Location: index.php?ACTION=primer_cambio');
          }
        }
        else
        {
          $MSG = "Debes iniciar sesión para ver la identificación.";
          header("Refresh:2; url=index.php");
          include_once($dirs['inc'] . 'msg_modal.php');
        }
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
  
      case 'editar_profesor':
        if($class->isLogged() && $_SESSION['Perfil'] == 'Admin')
        {
          include_once($dirs['inc'] . 'valida_edit_profesor.php');
          $extras = '<link rel="stylesheet" href="css/login-style.css">';
          include_once($dirs['inc'] . 'top-nav.php');
          include_once($dirs['inc'] . 'editar_profesor.php');
          include_once($dirs['inc'] . 'errors.php');
          include_once($dirs['inc'] . 'footer.php');
        }
        else
        {
          $MSG = "Debes iniciar sesión para editar un profesor.";
          header("Refresh:2; url=index.php");
          include_once($dirs['inc'] . 'msg_modal.php');
        }
      break;
  
      case 'faltas_profesor':
        if($class->isLogged() && $_SESSION['Perfil'] == 'Admin')
        {
          $style = "
          input[type=text], input[type=password] {
          background-color: #f6f6f6;
          border: none;
          color: #0d0d0d;
          padding: 15px 32px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 5px;
          width: 85%;
          border: 2px solid #f6f6f6;
          -webkit-transition: all 0.5s ease-in-out;
          -moz-transition: all 0.5s ease-in-out;
          -ms-transition: all 0.5s ease-in-out;
          -o-transition: all 0.5s ease-in-out;
          transition: all 0.5s ease-in-out;
          -webkit-border-radius: 5px 5px 5px 5px;
          border-radius: 5px 5px 5px 5px;
          }
          
          input[type=text]:focus {
          background-color: #fff;
          border-bottom: 2px solid #5fbae9;
          }
          
          input[type=text]:placeholder {
          color: #cccccc;
          }";
          include_once($dirs['inc'] . 'top-nav.php');
          include_once($dirs['inc'] . 'faltas_profesor.php');
          include_once('js/filtro_asistencias.js');
          include_once('js/update_marcajes.js');
          include_once($dirs['inc'] . 'errors.php');
          include_once($dirs['inc'] . 'footer.php');
        }
        else
        {
          $MSG = "Debes iniciar sesión para editar un profesor.";
          header("Refresh:2; url=index.php");
          include_once($dirs['inc'] . 'msg_modal.php');
        }
      break;
    
      case 'update_marcajes':
        if($class->isLogged() && $_SESSION['Perfil'] == 'Admin')
        {
          include_once($dirs['inc'] . 'update-marcajes.php');
        }
        else
        {
          $MSG = "Debes iniciar sesión para editar un profesor.";
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
              canvas {box-shadow: 4px 6px 15px grey; padding: 2px; border-radius: 10px;}
              .respuesta span {display: block; box-shadow: 4px 6px 15px grey; padding: 50px; border-radius: 10px; margin-top: 30px;}
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
            if($_SESSION['Perfil'] === 'Admin')
            {
                include($dirs['inc'] . 'qr-reader.php');
            }
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
    if($class->compruebaCambioPass())
    {
      $act_home = 'active';
      include($dirs['inc'] . 'home.php');
    }
    else
    {
      header('Location: index.php?ACTION=primer_cambio');
    }
  }
  else
  {
      include_once($dirs['inc'] . 'login_form.php');
  }
}