<?php
if($class->updateSet("UPDATE Profesores SET Activo=0 WHERE ID='$_GET[ID]'"))
{
    return true;
}
else
{
    echo $class->ERR_NETASYS;
    return false;
}