<?php
date_default_timezone_set('Europe/Madrid');
$horaactual = date('H:i:s');
$diaactual = date('Y-m-d');
$idprof = $_SESSION['ID'];
$idultimofichaje = $class->getLastIDFichaje();
$sql = "UPDATE $class->fichar SET F_salida ='$horaactual' WHERE $class->fichar.ID_PROFESOR='$idprof' AND $class->fichar.ID='$idultimofichar' AND $class->fichar.Fecha='$diaactual'";
if($response = $class->query($sql))
{
    if($conex->affected_rows == 1)
    {
        $ERR_MSG = "Fichaje de salida correcto.";
    }
    else
    {
        $ERR_MSG = "No puedes fichar la salida si no has fichado la entrada.";
    }
}
else
{
    $ERR_MSG = $class->ERR_NETASYS;
}
