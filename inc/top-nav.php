
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
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top-menu">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="<?php echo "index.php"; ?>">Netasys</a>
    </div>
    <div class="collapse navbar-collapse" id="top-menu">
    <ul class="nav navbar-nav">
      <li class="<?php echo $act_home; ?>"><a href="<?php echo "index.php"; ?>"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
      <li class="dropdown <?php echo $act_horario; ?>"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-calendar"></span> Horario <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo $_SERVER['PHP_SELF'] . '?ACTION=horarios' ?>"><span class="glyphicon glyphicon-calendar"></span> Consultar horario</a></li>
          <li><a href="index.php?ACTION=crear-horario"><span class="glyphicon glyphicon-plus"></span> Crear horario</a></li>
          <li><a href="index.php?ACTION=import-horario"><span class="glyphicon glyphicon-plus"></span> Importar horario</a></li>
          <li><a href="index.php?ACTION=modificar-horario"><span class="glyphicon glyphicon-pencil"></span> Modificar horario</a></li>
        </ul>
      </li>
      <li class="<?php echo $act_asistencia; ?>"><a href="<?php $d = date('d'); $m = date('m'); $Y = date('Y'); echo $_SERVER['PHP_SELF'] . "?ACTION=asistencias&d=$d&m=$m&Y=$Y"; ?>"><span class="glyphicon glyphicon-check"></span> Mis asistencias</a></li>
      <?php
        if($_SESSION['Perfil'] === 'Admin')
        {
            echo "<li class='dropdown $act_profesores '><a class='dropdown-toggle' data-toggle='dropdown' href='#'<span class='glyphicon glyphicon-education'></span> Profesores <span class='caret'></a>";
            echo "<ul class='dropdown-menu'>";
              echo "<li><a href='$_SERVER[PHP_SELF]?ACTION=profesores'><span class='glyphicon glyphicon-education'></span> Mostrar profesores</a></li>";
              echo "<li><a href='$_SERVER[PHP_SELF]?ACTION=import-profesorado'><span class='glyphicon glyphicon-plus'></span> Importar profesores</a></li>";
            echo "</ul>";
            echo "</li>";

            echo "<li><a href='$_SERVER[PHP_SELF]?ACTION=lectivos'><span class='glyphicon glyphicon-calendar'></span> Calendario escolar</a></li>";
        }
    ?>
      <!--li class="<?php echo $act_guardias; ?>"><a href="<?php echo $_SERVER['PHP_SELF'] . '?ACTION=guardias' ?>"><span class="glyphicon glyphicon-eye-open"></span> Guardias</a></li-->
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown <?php echo $act_usuario; ?>"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['Nombre']; ?> <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
          <li><a href="#"><span class="glyphicon glyphicon-comment"></span> Notificaciones</a></li>
          <li><a href="index.php?ACTION=qrcoder"><span class="glyphicon glyphicon-qrcode"></span> Mi código QR</a></li>
          <li><a href="index.php?ACTION=cambio_pass"><span class="glyphicon glyphicon-retweet"></span> Cambio de contraseña</a></li>
          <li><a href="#"><span class="glyphicon glyphicon-cog"></span> Ajustes</a></li>
        </ul>
      </li>
      <li><a href="<?php echo $_SERVER['PHP_SELF'] . '?ACTION=logout' ?>"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a></li>
    </ul>
  </div>
  </div>
</nav>
