<?php

if(isset($_POST['editar_profesor']))
{
    if($response = $class->selectFrom("SELECT ID FROM $class->profesores WHERE Iniciales = '$_POST[Iniciales]' AND ID = '$_POST[ID]'"))
    {
        if($response->num_row == 1)
    }
}


?>