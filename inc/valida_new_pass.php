<?php

if($_POST['new_password'])
{
$_POST['act_pass'] = $class->encryptPassword($_POST['act_pass']);
$_POST['new_pass'] = $class->encryptPassword($_POST['new_pass']);
$_POST['new_pass_c'] = $class->encryptPassword($_POST['new_pass_c']);
    if(! $response = $class->selectFrom("SELECT ID FROM $class->profesores WHERE ID='$_SESSION[ID]'"))
    {
        if($response->num_rows == 1)
        {
            if($_POST['new_pass'] != $_POST['act_pass'])
            {
                if($_POST['new_pass'] === $_POST['new_pass_c'])
                {
                    if($class->updateSet("UPDATE $class->profesores SET $class->profesores.Password='$_POST[new_pass]' WHERE $class->profesores.ID='$_SESSION[ID]'"))
                    {
    
                    }
                    else
                    {
                        $ERR_MSG = $class->ERR_NETASYS;
                    }
                }
                else
                {
                    $ERR_MSG = 'Las nuevas contraseñas no coinciden.';
                }
            }
            else
            {
                $ERR_MSG = 'La nueva contraseña debe ser distinta a la actual.';
            }
        }
        else
        {
            $ERR_MSG = 'Esta no es tu contraseña actual.';
        }
        
    }
    else
    {
        $ERR_MSG = $class->ERR_NETASYS;
    }
}




?>