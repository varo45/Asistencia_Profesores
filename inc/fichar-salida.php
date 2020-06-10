<?php
$bd->bdConex();
$conex = $bd->conex;
$horaactual = date('H:i:00');
$idprof = $bd->getID();
var_dump($idprof);
$idultimofichaje = $bd->getLastIDFichaje();
var_dump($idultimofichaje);
$sql = "UPDATE $bd->fichaje SET F_salida ='$horaactual' WHERE $bd->fichaje.ID_PROFESOR='$idprof' AND $bd->fichaje.ID='$idultimofichaje'";
$ejec =$conex->query($sql);
