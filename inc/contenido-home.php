<div class="container" style="margin-top:50px">
  <h3>Contenido de la Página de inicio</h3>
  <p>Podemos morstrar una tabla que muestre las clases de hoy del profesor que haya iniciado sesión.</p>
  <a href="<?php echo $_SERVER['PHP_SELF'] . '?ACTION=fichar'; ?>"><span  class="glyphicon glyphicon-ok"></span> Fichar Entrada</a><br>
  <a href="<?php echo $_SERVER['PHP_SELF'] . '?ACTION=fichar_salida'; ?>"><span  class="glyphicon glyphicon-ok"></span> Fichar Salida</a>
</div>
<?php

date_default_timezone_set('Europe/Madrid');
$ahora = getdate();

?>