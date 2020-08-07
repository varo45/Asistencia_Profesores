<?php

if($res = $class->query("SELECT ID_PROFESOR FROM Mensajes WHERE ID='$_GET[ID]' AND ID_PROFESOR = '$_SESSION[ID]'"))
{
    if($res->num_rows == 1)
    {
        if($response = $class->query("UPDATE $class->mensajes SET Borrado_Profesor=1 WHERE $class->mensajes.ID='$_GET[ID]'"))
        {
            $MSG = "Mensaje eliminado correctamente.";
            header('Location:index.php?ACTION=listar_mensajes');
        }
        else
        {
            $ERR_MSG = $class->ERR_NETASYS;
        }
    }
    else
    {
        if($response = $class->query("UPDATE $class->mensajes SET Borrado_Destinatario=1 WHERE $class->mensajes.ID='$_GET[ID]'"))
        {
            $MSG = "Mensaje eliminado correctamente.";
            header('Location:index.php?ACTION=listar_mensajes');
        }
        else
        {
            $ERR_MSG = $class->ERR_NETASYS;
        }
    }
}
else
{
    $ERR_MSG = $class->ERR_NETASYS;
}
