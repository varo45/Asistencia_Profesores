<?php

// Clase para operar con la base de datos

class DataBase
{
    // Configuración de variables de sesión de MySQL

    private $host = '192.168.1.84:8989';
    // private $user = 'admin';
    // private $pass = 'f36c0d6388963313095f349dabd4c2e9f730868e';
    private $user = 'root';
    private $pass = 'PractiRoot2020';
    private $db = 'Asinet';

    public $conex_status;
    public $bd;

    function bdConex()
    {
        $this->bd = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->bd->connect_errno) {
            $this->conex_status = false;
            echo "Fallo al conectar a MySQL: (" . $this->bd->connect_errno . ") " . $this->bd->connect_error;
        }
        else
        {
            return $this->conex_status = true;
        }
    }

    function bdSelect($sql)
    {
        $bd->query($sql);
    }
}