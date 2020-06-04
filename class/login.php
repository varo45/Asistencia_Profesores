<?php

// Clase para gestionar login

class login
{
    private $username;
    private $password;

    function isLogged()
    {
        if($_SESSION['logged'] === true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function filledLogin($loginarray)
    {
        foreach($loginarray as $value)
        {
            if($value == '')
            {
                $ERR_MS_LOGIN = 'Error, debe rellenar todos los campos del formulario.';
                return $ERR_MS_LOGIN;
            }
            else
            {
                return true;
            }
        }
    }

    function Login($username, $password)
    {
        if($username == '' || $password == '')
        {
            return false;
        }
        else
        {
            return true;
        }
    }

}
