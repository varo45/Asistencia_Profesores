<?php

// Clase para operar con la base de datos

class BaseDatos
{
    private $conex_status;
    function bdConex()
    {
        require_once($dirs['inc'] . 'config.php');
        $bd = new mysqli($host, $user, $pass, $db);
        if ($bd->connect_errno) {
            $this->conex_status = false;
            echo "Fallo al conectar a MySQL: (" . $bd->connect_errno . ") " . $bd->connect_error;
        }
        else
        {
            return $this->conex_status = true;
        }
    }

    function bdSelect( string $selected, string $tabla, string $where)
    {
        $sql = "SELECT $selected FROM $tabla $where";
    }
}