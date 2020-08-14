<?php

if($_POST['ID'] != '')
{
    if($class->query("UPDATE $class->profesores 
    SET $class->profesores.Iniciales='$_POST[Iniciales]', $class->profesores.Nombre='$_POST[Nombre]', 
    $class->profesores.Tutor='$_POST[Tutor]' WHERE $class->profesores.ID='$_POST[ID]'"))
    {
        $MSG = "Datos actualizados correctamente.";
        header('Refresh:1;index.php?ACTION=profesores');
    }
    else
    {
        $ERR_MSG = $class->ERR_NETASYS;
    }
}

?>