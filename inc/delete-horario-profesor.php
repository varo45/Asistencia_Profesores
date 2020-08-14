<?php
if($class->query("DELETE FROM $class->horarios WHERE ID_PROFESOR='$_GET[profesor]'"))
{
    $MSG = "Horario eliminado correctamente.";
}
else
{
    $ERR_MSG = $class->ERR_NETASYS;
}