<?php
if($response = $class->query("SELECT ID, Nombre FROM $class->profesores WHERE $class->profesores.ID='$_GET[ID]' AND $class->profesores.TIPO='1'"))
{
    if($response->num_rows > 0)
    {
        $ERR_MSG = "No se puede desactivar a un administrador del sistema.";
    }
    else
    {
        if($class->query("UPDATE Profesores SET Activo=0 WHERE ID='$_GET[ID]'"))
        {
            $MSG = "Cambios realizados correctamente.";
        }
        else
        {
            echo $class->ERR_NETASYS;
            return false;
        }
    }
}
else
{
    $ERR_MSG = $class->ERR_NETASYS;
}