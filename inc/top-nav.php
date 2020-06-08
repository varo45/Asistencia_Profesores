
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Inicio</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top-menu">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="<?php echo "index.php"; ?>">Asinet</a>
    </div>
    <div class="collapse navbar-collapse" id="top-menu">
    <ul class="nav navbar-nav">
      <li class="active"><a href="<?php echo "index.php"; ?>"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-calendar"></span> Horario<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#"><span class="glyphicon glyphicon-plus"></span> Crear horario</a></li>
          <li><a href="#"><span class="glyphicon glyphicon-pencil"></span> Modificar horario</a></li>
        </ul>
      </li>
      <li><a href="#"><span class="glyphicon glyphicon-check"></span> Asistencias</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['username']; ?><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
          <li><a href="#"><span class="glyphicon glyphicon-comment"></span> Notificaciones</a></li>
          <li><a href="#"><span class="glyphicon glyphicon-cog"></span> Ajustes</a></li>
        </ul>
      </li>
      <li><a href="<?php echo $_SERVER['PHP_SELF'] . '?ACTION=logout' ?>"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a></li>
    </ul>
  </div>
  </div>
</nav>
  
<div class="container">
  <h3>Contenido de la Página de inicio</h3>
  <p>Podemos morstrar una tabla que muestre las clases de hoy del profesor que haya iniciado sesión.</p>
</div>

</body>
</html>
