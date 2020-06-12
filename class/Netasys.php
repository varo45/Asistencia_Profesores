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

    public $ERR_NETASYS;


    function bdConex()
    {
        $conex = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($conex->connect_errno) {
            $this->ERR_NETASYS = "Fallo al conectar a MySQL: (" . $this->conex->connect_errno . ") " . $this->conex->connect_error;
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
            $this->ERR_NETASYS = "Fallo al conectar a MySQL: (" . $this->conex->connect_errno . ") " . $this->conex->connect_error;
            return false;
        }
        if($resultado = $conex->query($sql))
        {
            return $resultado;
        }
        else
        {
            $this->ERR_NETASYS = "ERR_CODE: " . $conex->errno . "<br>ERROR: " . $conex->error;
            return false;
        }
    }

    function isLogged()
    {
        if($_SESSION['logged'] === true && isset($_SESSION['Nombre']) && isset($_SESSION['ID']) && $_SESSION['Nombre'] != '')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function Logout()
    {
        $_SESSION['logged'] = false;
        unset($_SESSION['Nombre']);
        unset($_SESSION['Tipo']);
        session_destroy();
        session_abort();
        header("Location : index.php");
    }

    function validFormName($registername)
    {
        if(preg_match('/^[ a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙ.-]{6,60}$/i', $registername))
        {
            return true;
        }
        else
        {
            $this->ERR_NETASYS = "Nombre no válido <br>";
            return false;
        }
    }

    function validFormDni($registerdni)
    {
        $registerdni = strtoupper($registerdni);

        if(preg_match('/(^[XYZ][0-9]{7}[A-Z]$)|(^[0-9]{8}[A-Z]$)/i', $registerdni))
        {
            return true;
        }
        else
        {
            $this->ERR_NETASYS = "DNI no válido <br>";
            return false;
        }
    }

    function encryptPassword($pass)
    {
        $pass = sha1($pass);
        return $pass;
    }

    function Login($username, $password)
    {
        if($conex = $this->bdConex())
        {
            $password = $this->encryptPassword($password);
            if($response = $this->selectFrom("SELECT count(*) as num FROM $this->profesores WHERE DNI='$username' AND Password='$password'"))
            {
                if($response->num_rows == 1)
                {
                    if($response = $this->selectFrom("SELECT $this->profesores.ID, $this->profesores.Nombre, $this->perfiles.Tipo FROM $this->profesores INNER JOIN $this->perfiles ON $this->profesores.TIPO=$this->perfiles.ID WHERE DNI='$username' AND Password='$password'"))
                    {
                        $fila = $response->fetch_assoc();
                        $_SESSION['logged'] = true;
                        $_SESSION['ID'] = $fila['ID'];
                        $_SESSION['Nombre'] = $fila['Nombre'];
                        $_SESSION['Perfil'] = $fila['Tipo'];
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    $this->ERR_NETASYS = "Usuario o contraseña no válidos.";
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    function getDate()
    {
        date_default_timezone_set('Europe/Madrid');
        if($fecha = getdate())
        {
            if($fecha['weekday'] === 'Monday')
            {
                $fecha['weekday'] = "Lunes";
            }
            elseif($fecha['weekday'] === 'Tuesday')
            {
                $fecha['weekday'] = "Martes";
            }
            elseif($fecha['weekday'] === 'Wednesday')
            {
                $fecha['weekday'] = "Miercoles";
            }
            elseif($fecha['weekday'] === 'Thursday')
            {
                $fecha['weekday'] = "Jueves";
            }
            elseif($fecha['weekday'] === 'Friday')
            {
                $fecha['weekday'] = "Viernes";
            }
            elseif($fecha['weekday'] === 'Saturday')
            {
                $fecha['weekday'] = "Sabado";
            }
            elseif($fecha['weekday'] === 'Sunday')
            {
                $fecha['weekday'] = "Domingo";
            }
            
            if($fecha['month'] === 'January')
            {
                $fecha['month'] = "Enero";
            }
            elseif($fecha['month'] === 'February')
            {
                $fecha['month'] = "Febrero";
            }
            elseif($fecha['month'] === 'March')
            {
                $fecha['month'] = "Marzo";
            }
            elseif($fecha['month'] === 'April')
            {
                $fecha['month'] = "Abril";
            }
            elseif($fecha['month'] === 'May')
            {
                $fecha['month'] = "Mayo";
            }
            elseif($fecha['month'] === 'June')
            {
                $fecha['month'] = "Junio";
            }
            elseif($fecha['month'] === 'July')
            {
                $fecha['month'] = "Julio";
            }
            elseif($fecha['month'] === 'August')
            {
                $fecha['month'] = "Agosto";
            }
            elseif($fecha['month'] === 'September')
            {
                $fecha['month'] = "Septiembre";
            }
            elseif($fecha['month'] === 'October')
            {
                $fecha['month'] = "Octubre";
            }
            elseif($fecha['month'] === 'November')
            {
                $fecha['month'] = "Noviembre";
            }
            elseif($fecha['month'] === 'December')
            {
                $fecha['month'] = "Diciembre";
            }
            return $fecha;
        }
        else
        {
            $this->ERR_NETASYS = "Error al obtener fecha.";
            return false;
        }
    }

}