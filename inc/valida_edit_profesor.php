<?php

if(isset($_POST['ID']) && $_POST['ID'] != '')
{
    if($class->validFormIni($_POST['Iniciales']))
    {
        if($response = $class->selectFrom("SELECT ID FROM $class->profesores WHERE Iniciales = '$_POST[Iniciales]' AND ID = '$_POST[ID]'"))
        {
            if(! $response->num_rows == 1)
            {
                if($class->searchDuplicateField($_POST['Iniciales'], 'Iniciales', $class->profesores))
                {
                    if($class->validFormName($_POST['Nombre']))
                    {
                        include_once($dirs['inc'] . 'actualiza_profesor.php');
                    }
                    else
                    {
                        $ERR_MSG = $class->ERR_NETASYS;
                    }
                }
                else
                {
                    $ERR_MSG = "Estas Iniciales ya están en uso.";
                }
            }
            else
            {
                if($class->validFormName($_POST['Nombre']))
                {
                    include_once($dirs['inc'] . 'actualiza_profesor.php');
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
    }
    else
    {
        $ERR_MSG = $class->ERR_NETASYS;
    }
}


?>