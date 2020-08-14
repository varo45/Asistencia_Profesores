<?php

if(isset($_GET['abrev']) && isset($_GET['enp']) && $_GET['abrev'] != 'undefined' && $_GET['enp'] != 'undefined')
{
    if($response = $class->query("SELECT ID, Nombre FROM $class->profesores WHERE Iniciales='$_GET[abrev]' AND Password='$_GET[enp]'"))
    {
      if($response->num_rows == 1)
      {
        $nombre = $response->fetch_assoc();
        if($class->FicharWeb())
        {
            echo "<span id='okqr' style='color: white; font-weight: bolder; background-color: green;'><h3>Fichaje de asistencia correcto. $nombre[Nombre]</h3></span>";
        }
        else
        {
            echo $class->ERR_NETASYS;
        }
      }
      else
      {
        echo "<span id='noqr' style='color: white; font-weight: bolder; background-color: red;'><h3>Código QR incorrecto.</h3></span>";
      }
    }
    else
    {
      echo "<span id='noqr' style='color: white; font-weight: bolder; background-color: red;'><h3>$class->ERR_NETASYS</h3></span>";
    }
}