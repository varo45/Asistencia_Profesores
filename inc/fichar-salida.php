<?php
$bd->bdConex();
$conex = $bd->conex;
date_default_timezone_set('Europe/Madrid');
$horaactual = date('H:i:00');
$idprof = $bd->getID();
$idultimofichaje = $bd->getLastIDFichaje();
$sql = "UPDATE $bd->fichaje SET F_salida ='$horaactual' WHERE $bd->fichaje.ID_PROFESOR='$idprof' AND $bd->fichaje.ID='$idultimofichaje'";
$ejec =$conex->query($sql);
