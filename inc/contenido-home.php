<div class="container" style="margin-top:50px">
  <h3>Contenido de la Página de inicio</h3>
  <p>Podemos morstrar una tabla que muestre las clases de hoy del profesor que haya iniciado sesión.</p>
  <a href="<?php echo $_SERVER['PHP_SELF'] . '?ACTION=fichar'; ?>"><span  class="glyphicon glyphicon-ok"></span> Fichar Entrada</a><br>
  <a href="<?php echo $_SERVER['PHP_SELF'] . '?ACTION=fichar_salida'; ?>"><span  class="glyphicon glyphicon-ok"></span> Fichar Salida</a>
</div>
<?php

date_default_timezone_set('Europe/Madrid');
var_dump($class->getDate());
$now = date('H:i:s');
echo $consulta = $class->getConsulta("SELECT Hora FROM Horas WHERE Inicio <= '$now' AND Fin >= '$now' ");
// $horaactual = $class->selectFrom($consulta);
// var_dump($horaactual);

?>