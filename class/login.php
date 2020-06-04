<?php

// Clase para gestionar login

class Login
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
    }

    function goLogin($username, $password)
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
