<?php

// Clase para gestionar login

class Login
{
    private $username;
    private $password;

    function isLogged()
    {
        if($_SESSION['logged'] === true && isset($_SESSION['user']) && ! $_SESSION['user'] == '')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function proceedLogout()
    {
        $_SESSION['logged'] = false;
        unset($_SESSION['user']);
        session_destroy();
        session_abort();
        return true;
    }

    function filledLogin($campo1, $campo2)
    {
        if($campo1 == '')
        {
            return false;
        }
        elseif($campo2 == '')
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    function validFormUser($username)
    {
        if(preg_match('/^[a-z0-9]{4,50}$/i', $username))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function encryptPassword($pass)
    {
        $pass = sha1($pass);
        return $pass;
    }

    function proceedLogin($username, $password)
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
