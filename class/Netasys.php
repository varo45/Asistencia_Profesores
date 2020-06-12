<?php

class Netasys
{

    private $host = '192.168.1.133:8989';
    private $user = 'profesores';
    private $pass = 'f36c0d6388963313095f349dabd4c2e9f730868e';
    private $db = 'Netasys';

    public $fichar = 'Fichar';
    public $horarios = 'Horarios';
    public $profesores = 'Profesores';
    public $horas = 'Horas';
    public $perfiles = 'Perfiles';

    public $ERR_BD;


    function bdConex()
    {
        $conex = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($conex->connect_errno) {
            $this->ERR_BD = "Fallo al conectar a MySQL: (" . $this->conex->connect_errno . ") " . $this->conex->connect_error;
            return false;
        }
        else
        {
            return $conex;
        }
    }

    function selectFrom($sql)
    {
        if(! $conex = $this->bdConex())
        {
            $this->ERR_BD = "Fallo al conectar a MySQL: (" . $this->conex->connect_errno . ") " . $this->conex->connect_error;
            return false;
        }
        if($resultado = $conex->query($sql))
        {
            return $resultado;
        }
        else
        {
            $this->ERR_BD = "ERR_CODE: " . $conex->errno . "<br>ERROR: " . $conex->error;
            return false;
        }
    }
}














if($response = $netasys->selectFrom("SELECT"))
{

}
else
{
    echo $netasys->ERR_BD;
}
