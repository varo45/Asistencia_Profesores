<?php

// Clase para operar con los usuarios

class User 
{
    public $username;

    function getUserData($conex, string $data)
    {
        $sql = "SELECT $data FROM Profesores WHERE DNI='$_SESSION[user]'";
        $result = $conex->query($sql);
        $array = $result->fetch_assoc();
        return $array[$data];
    }
    function getUserName($conex)
    {
        $sql = "SELECT Nombre FROM Profesores WHERE DNI='$_SESSION[user]'";
        $result = $conex->query($sql);
        $array = $result->fetch_assoc();
        $this->username = $array['Nombre'];
        return $this->username;
    }

    function isAdmin($conex)
    {
        $sql = "SELECT Admin FROM Profesores WHERE DNI='$_SESSION[user]'";
        $result = $conex->query($sql);
        $array = $result->fetch_assoc();
        if($array['Admin'] == 1)
        {
            $_SESSION['Admin'] = true;
            return true;
        }
        else
        {
            $_SESSION['Admin'] = false;
            return false;
        }
    }
}