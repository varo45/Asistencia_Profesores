<?php

// Clase para operar con la base de datos

class DataBase
{
    // Configuración de variables de sesión de MySQL

    private $host = '192.168.1.133:8989';
    private $user = 'profesores';
    private $pass = 'f36c0d6388963313095f349dabd4c2e9f730868e';
    private $db = 'Asinet';

    // Tablas Base de datos

    public $fichaje = 'Fichaje';
    public $horarios = 'Horarios';
    public $profesores = 'Profesores';

    public $conex_status;
    public $conex;
    public $ERR_BD;

    function bdConex()
    {
        $this->conex = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->conex->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->conex->connect_errno . ") " . $this->conex->connect_error;
            $this->conex_status = false;
            return $this->conex_status;
        }
        else
        {
            $this->conex_status = true;
            return $this->conex_status;
        }
    }

    function bdCompareLogin($conex, $sql)
    {
        $ejec = $conex->query($sql);
        $fila = $ejec->fetch_assoc();
        if($fila['num'] == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function getID()
    {
        $this->bdConex();
        $conex = $this->conex;
        $userdata = "SELECT ID FROM $this->profesores WHERE DNI='$_SESSION[user]' AND Nombre='$_SESSION[username]'";
        $userid = $conex->query($userdata);
        $userid = $userid->fetch_assoc();
        return $userid['ID'];
    }

    function getCampoProfesores(string $campo)
    {
        $this->bdConex();
        $conex = $this->conex;
        $userdata = "SELECT $campo FROM $this->profesores WHERE DNI='$_SESSION[user]' AND Nombre='$_SESSION[username]'";
        $resultado = $conex->query($userdata);
        $return = $resultado->fetch_assoc();
        return $return[$campo];
    }

    function getHoraSalida()
    {
        $this->bdConex();
        $conex = $this->conex;
        $userdata = "SELECT Hora_salida FROM $this->horarios INNER JOIN $this->profesores ON $this->horarios.ID_PROFESOR=$this->profesores.ID WHERE DNI='$_SESSION[user]' AND Nombre='$_SESSION[username]'";
        $hs = $conex->query($userdata);
        $hs = $hs->fetch_assoc();
        return $hs['Hora_salida'];
    }

    function FicharWeb()
    {
        $this->bdConex();
        $conex = $this->conex;
        $id = $this->getID();
        if($this->conex_status == 1)
        {
            date_default_timezone_set('Europe/Madrid');
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            $hora_salida = $this->getHoraSalida();
            $fichaje = "INSERT INTO $this->fichajes (ID_PROFESOR, Fecha, Hora_entrada, Hora_salida) VALUES ($id, $fecha, $hora, $hora_salida)";
            $exec = $conex->query($fichaje);
            return $fichaje;
        }
        else
        {
            return false;
        }
    }

    function FicharTerminal()
    {
        
    }
}