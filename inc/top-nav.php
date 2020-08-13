
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Inicio</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <link rel="stylesheet" href="css/bootstrap-3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style-cal.css">
  <link rel="stylesheet" href="css/netasys.css">
  <link rel="stylesheet" href="js/jquery-ui/jquery-ui.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery-ui/jquery-ui.min.js"></script>
  <?php if(isset($extras)){ echo $extras;} ?>

  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <style>
    .badge {background-color: #5cb85c;}
  <?php if(isset($style)){ echo $style;} ?>
  </style>
</head>
<body>

<?php

$noleidos = "SELECT count(*) as new
FROM Mensajes
WHERE (ID_DESTINATARIO='$_SESSION[ID]' AND Borrado_Destinatario=0 AND Leido=0)
ORDER BY ID DESC";

if($response = $class->query($noleidos))
{
  $new = $response->fetch_assoc();
  if($new['new'] > 0)
  {
    $notificacion = " <span class='badge'>$new[new]</span>";
  }
  else
  {
    $notificacion = '';
  }
}
else
{
  $ERR_MSG = $class->ERR_NETASYS;
}

$novisto = "SELECT count(*) as new_alert
FROM Notificaciones
WHERE Visto=0
ORDER BY ID DESC";

if($response = $class->query($novisto))
{
  $new = $response->fetch_assoc();
  if($new['new_alert'] > 0)
  {
    $notificacion_alert = " <span class='badge'>$new[new_alert]</span>";
  }
  else
  {
    $notificacion_alert = '';
  }
}
else
{
  $ERR_MSG = $class->ERR_NETASYS;
}

echo '<nav class="navbar navbar-inverse navbar-fixed-top">';
  echo '<div class="container-fluid">';
    echo '<div class="navbar-header">';
      echo '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top-menu">';
        echo '<span class="icon-bar"></span>';
        echo '<span class="icon-bar"></span>';
        echo '<span class="icon-bar"></span>';
      echo '</button>';
      echo '<a class="navbar-brand" href="index.php">Netasys</a>';
    echo '</div>';
    echo '<div class="collapse navbar-collapse" id="top-menu">';

      if($_SESSION['Perfil'] === 'Admin')
      {
        echo '<ul class="nav navbar-nav">';
          echo "<li class='$act_home'>";
            echo "<a href='index.php'><span class='glyphicon glyphicon-home'></span> Inicio</a>";
          echo "</li>";

          echo "<li class='dropdown $act_horario'><a class='dropdown-toggle' data-toggle='dropdown' href='#'><span class='glyphicon glyphicon-calendar'></span> Horario <span class='caret'></span></a>";
            echo '<ul class="dropdown-menu">';
              echo "<li><a href='$_SERVER[PHP_SELF]?ACTION=horarios'><span class='glyphicon glyphicon-calendar'></span> Consultar horario</a></li>";
              echo '<li><a href="index.php?ACTION=import-horario"><span class="glyphicon glyphicon-open"></span> Importar horarios</a></li>';
            echo '</ul>';
          echo '</li>';

          echo "<li class='dropdown $act_profesores '><a class='dropdown-toggle' data-toggle='dropdown' href='#'><span class='glyphicon glyphicon-education'></span> Profesores <span class='caret'></a>";
            echo "<ul class='dropdown-menu'>";
              echo "<li><a href='$_SERVER[PHP_SELF]?ACTION=profesores'><span class='glyphicon glyphicon-education'></span> Mostrar profesores</a></li>";
              echo "<li><a href='$_SERVER[PHP_SELF]?ACTION=import-profesorado'><span class='glyphicon glyphicon-plus'></span> Importar profesores</a></li>";
            echo "</ul>";
          echo "</li>";

          echo "<li>";
            echo "<a href='$_SERVER[PHP_SELF]?ACTION=lectivos'><span class='glyphicon glyphicon-calendar'></span> Calendario escolar</a>";
          echo "</li>";
        echo "</ul>";

        echo '<ul class="nav navbar-nav navbar-right">';
          echo "<li class='dropdown $act_usuario'>";
            echo "<a class='dropdown-toggle' data-toggle='dropdown' href='#'><span class='glyphicon glyphicon-user'></span> ";
              echo $_SESSION['Nombre'];
              echo $notificacion;
              echo '<span class="caret"></span>';
            echo '</a>';
            echo '<ul class="dropdown-menu">';
              echo '<li>';
                echo'<a id="message" href="index.php?ACTION=form_mensajes"><span id="message-icon" class="glyphicon glyphicon-comment"></span> Mensajes ';
                  echo $notificacion;
                echo '</a>';
              echo '</li>';
              echo '<li>';
                echo '<a id="admon" href="index.php?ACTION=admon"><span id="admon-icon" class="glyphicon glyphicon-folder-close"></span> Administración</a>';
              echo '</li>';
              echo '<li>';
                echo '<a id="notif" href="index.php?ACTION=admon"><span id="notif-icon" class="glyphicon glyphicon-folder-close"></span> Notificaciones';
                  echo $notificacion_alert;
                echo '</a>';
              echo '</li>';
              echo '<li>';
                echo '<a id="cambio-pass" href="index.php?ACTION=cambio_pass"><span id="cambio-pass-icon" class="glyphicon glyphicon-refresh"></span> Cambio de contraseña</a>';
              echo '</li>';
            echo '</ul>';
          echo '</li>';

          echo "<li>";
            echo "<a href='$_SERVER[PHP_SELF]?ACTION=logout'><span class='glyphicon glyphicon-log-out'></span> Cerrar Sesión</a>";
          echo "</li>";
        echo '</ul>';
      }
      
      if($_SESSION['Perfil'] === 'Profesor')
      {
        $d = date('d');
        $m = date('m');
        $Y = date('Y');
        echo '<ul class="nav navbar-nav">';
          echo "<li class='$act_home'>";
            echo "<a href='index.php'><span class='glyphicon glyphicon-home'></span> Inicio</a>";
          echo "</li>";

          echo "<li class='dropdown $act_horario'><a class='dropdown-toggle' data-toggle='dropdown' href='#'><span class='glyphicon glyphicon-calendar'></span> Horario <span class='caret'></span></a>";
            echo '<ul class="dropdown-menu">';
              echo "<li>";
                echo "<a href='$_SERVER[PHP_SELF]?ACTION=horarios'><span class='glyphicon glyphicon-calendar'></span> Consultar horario</a>";
              echo "</li>";
            echo '</ul>';
          echo '</li>';
          
          echo "<li class='$act_asistencia'>";
            echo "<a href='$_SERVER[PHP_SELF]?ACTION=asistencias&d=$d&m=$m&Y=$Y'><span class='glyphicon glyphicon-check'></span> Mis asistencias</a>";
          echo "</li>";
        echo '</ul>';

        echo '<ul class="nav navbar-nav navbar-right">';
          echo "<li class='dropdown $act_usuario'>";
            echo "<a class='dropdown-toggle' data-toggle='dropdown' href='#'><span class='glyphicon glyphicon-user'></span> ";
              echo $_SESSION['Nombre'];
              echo $notificacion;
              echo '<span class="caret"></span>';
            echo '</a>';
            echo '<ul class="dropdown-menu">';
              echo '<li>';
                echo '<a href="index.php?ACTION=qrcoder"><span class="glyphicon glyphicon-qrcode"></span> Mi código QR</a>';
              echo '</li>';
              echo '<li>';
                echo'<a id="message" href="index.php?ACTION=form_mensajes"><span id="message-icon" class="glyphicon glyphicon-comment"></span> Mensajes ';
                  echo $notificacion;
                echo '</a>';
              echo '</li>';
              echo '<li>';
                echo '<a id="cambio-pass" href="index.php?ACTION=cambio_pass"><span id="cambio-pass-icon" class="glyphicon glyphicon-refresh"></span> Cambio de contraseña</a>';
              echo '</li>';  
            echo '</ul>';
          echo '</li>';

          echo "<li>";
            echo "<a href='$_SERVER[PHP_SELF]?ACTION=logout'><span class='glyphicon glyphicon-log-out'></span> Cerrar Sesión</a>";
          echo "</li>";
        echo '</ul>';
      }

    echo '</div>';
  echo '</div>';
echo '</nav>';

include_once($dirs['public'] . 'js/animate.js');