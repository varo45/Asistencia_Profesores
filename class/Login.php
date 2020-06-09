<?php

// Clase para gestionar login

class Login
{
    private $username;
    private $password;
    
    public $ERR_LOGIN;
    public $ERR_REG_FORM;

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
        header("Location : index.php");
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

    function validNameRegister($registername)
    {
        if(preg_match('/^[ a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙ.-]{6,60}$/i', $registername))
        {
            return true;
        }
        else
        {
            $this->ERR_REG_FORM = "Nombre no válido <br>";
            return false;
        }
    }

    function validFormUser($registerdni)
    {
        $registerdni = strtoupper($registerdni);

        if(preg_match('/(^[XYZ][0-9]{7}[A-Z]$)|(^[0-9]{8}[A-Z]$)/i', $registerdni))
        {
            return true;
        }
        else
        {
            $this->ERR_REG_FORM = "DNI no válido <br>";
            return false;
        }
    }

    function encryptPassword($pass)
    {
        $pass = sha1($pass);
        return $pass;
    }

    function proceedLogin($username, $password, $conex)
    {
        if($conex == 1)
        {
            $password = $this->encryptPassword($password);
            return "SELECT count(*) as num FROM Profesores WHERE DNI='$username' AND Password='$password'";
        }
        else
        {
            return $this->ERR_LOGIN = "No existe una conexión a la Base de Datos.";
        }
    }

}
