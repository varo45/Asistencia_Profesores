<div class="container" style="margin-top:50px">
  <h3>Botones de fichaje</h3>
  <p>Podemos morstrar una tabla que muestre las clases de hoy del profesor que haya iniciado sesión.</p>
  <a href="<?php echo $_SERVER['PHP_SELF'] . '?ACTION=fichar'; ?>"><button type="button" class="btn btn-success"><span  class="glyphicon glyphicon-log-in"></span> Fichar Entrada</button></a><br><br>
  <a href="<?php echo $_SERVER['PHP_SELF'] . '?ACTION=fichar_salida'; ?>"><button type="button" class="btn btn-danger"><span  class="glyphicon glyphicon-log-out"></span> Fichar Salida</button></a><br><br><hr>  

</div>
<?php


?>