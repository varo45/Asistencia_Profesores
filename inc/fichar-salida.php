<?php
$bd->bdConex();
$conex = $bd->conex;
date_default_timezone_set('Europe/Madrid');
$horaactual = date('H:i:00');
$diaactual = $bd->getDiaCompleto();
$idprof = $bd->getID();
$idultimofichaje = $bd->getLastIDFichaje();
$sql = "UPDATE $bd->fichaje SET F_salida ='$horaactual' WHERE $bd->fichaje.ID_PROFESOR='$idprof' AND $bd->fichaje.ID='$idultimofichaje' AND $bd->fichaje.Fecha='$diaactual'";
if($ejec =$conex->query($sql))
{
    if($conex->affected_rows == 1)
    {
        $MSG_BD = "Fichaje de salida correcto.";
    }
    else
    {
        $MSG_BD = "Hoy no has fichado la entrada.";
    }
}
else
{
    $ERR_BD = "Error consulta Base de Datos.";
}
