<?php
if($res = $class->query("SELECT ID FROM Profesores WHERE "))
{
    if($res == true)
    {
        echo "UPDATE Profesores SET Password=('Iniciales' . '12345') WHERE ";
    }
    else
    {
    $ERR_MSG = $class->ERR_NETASYS;

    }
}
else
{
    $ERR_MSG = $class->ERR_NETASYS;
}