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

    function getLastIDFichaje()
    {
        $this->bdConex();
        $conex = $this->conex;
        $userid = $this->getID();
        $userdata = "SELECT ID FROM $this->fichaje WHERE ID_PROFESOR='$userid' ORDER BY ID DESC LIMIT 1";
        $lastID = $conex->query($userdata);
        $lastID = $lastID->fetch_assoc();
        return $lastID['ID'];
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

    function getDiaSemana()
    {
        date_default_timezone_set('Europe/Madrid');
        $d = cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
        $start = unixtojd(mktime(date('H'),date('i'),date('s'),date('m'),date('d'),date('Y')));
        $array = cal_from_jd($start,CAL_GREGORIAN);
        if($array['dayname'] === 'Monday')
        {
            return "Lunes";
        }
        elseif($array['dayname'] === 'Tuesday')
        {
            return "Martes";
        }
        elseif($array['dayname'] === 'Wednesday')
        {
            return "Miercoles";
        }
        elseif($array['dayname'] === 'Thursday')
        {
            return "Jueves";
        }
        elseif($array['dayname'] === 'Friday')
        {
            return "Viernes";
        }
        elseif($array['dayname'] === 'Saturday')
        {
            return "Sabado";
        }
        elseif($array['dayname'] === 'Sunday')
        {
            return "Domingo";
        }
        else
        {
            $this->ERR_BD = "No es un día de la semana";
            return false;
        }
    }

    function getHoraActual()
    {
        date_default_timezone_set('Europe/Madrid');
        $ahora = mktime(date('H'),date('i'),date('s'),date('m'),date('d'),date('Y'));
        $primera = mktime('08','30','00',date('m'),date('d'),date('Y'));
        $segunda = mktime('09','30','00',date('m'),date('d'),date('Y'));
        $tercera = mktime('10','30','00',date('m'),date('d'),date('Y'));
        $cuarta = mktime('12','00','00',date('m'),date('d'),date('Y'));
        $quinta = mktime('13','00','00',date('m'),date('d'),date('Y'));
        $sexta = mktime('14','00','00',date('m'),date('d'),date('Y'));
        $finclases = mktime('15','00','00',date('m'),date('d'),date('Y'));

        if($ahora > $primera &&  $ahora < $finclases)
        {
            if($ahora >= $primera && $ahora < $segunda)
            {
                return 1;
            }
            elseif($ahora >= $segunda && $ahora < $tercera)
            {
                return 2;
            }
            elseif($ahora >= $tercera && $ahora < $cuarta)
            {
                return 3;
            }
            elseif($ahora >= $cuarta && $ahora < $quinta)
            {
                return 4;
            }
            elseif($ahora >= $quinta && $ahora < $sexta)
            {
                return 5;
            }
            elseif($ahora >= $sexta && $ahora < $finclases)
            {
                return 6;
            }
        }
        else
        {
            $this->ERR_BD = "Fuera de Horario";
            return false;
        }
    }
    function getHoraSistema()
    {
        date_default_timezone_set('Europe/Madrid');
        if($hora = date('H:i:s'))
        {
            return $hora;
        }
        else
        {
            $this->ERR_BD = "Error al obtener hora actual del sistema";
            return false;
        }
    }

    function getDiaCompleto()
    {
        date_default_timezone_set('Europe/Madrid');
        if($dia = date('Y-m-d'))
        {
            return $dia;
        }
        else
        {
            $this->ERR_BD = "Error al obtener fecha actual";
            return false;
        }
    }

    function getGuardias()
    {
        $this->bdConex();
        $conex = $this->conex;
        if(! $diasemana = $this->getDiaSemana())
        {
            $this->ERR_BD = "Día semana no válido";
            return false;
        }
        if(! $horaactual = $this->getHoraActual())
        {
            $this->ERR_BD = $this->ERR_BD;
            return false;
        }
        if(! $dia = $this->getDiaCompleto())
        {
            $this->ERR_BD = $this->ERR_BD;
            return false;
        }
        if(! $horasistema = $this->getHoraSistema())
        {
            $this->ERR_BD = $this->ERR_BD;
            return false;
        }
        $sql = "SELECT $this->horarios.Aula, $this->horarios.Grupo, $this->horarios.Hora FROM $this->horarios INNER JOIN $this->fichaje ON $this->horarios.ID_PROFESOR=$this->fichaje.ID_PROFESOR WHERE $this->horarios.Dia='$diasemana' AND $this->horarios.Hora='$horaactual' AND $this->fichaje.F_salida <> $this->fichaje.Hora_salida AND $this->fichaje.Fecha='$dia'  AND $this->fichaje.F_salida < '$horasistema' AND $this->fichaje.Hora_salida > '$horasistema'";
        if($exec = $conex->query($sql))
        {
            if($exec->num_rows > 0)
            {
                return $exec;
            }
            else
            {
                $this->ERR_BD = "No existen Aulas sin Profesor.";
                return false;
            }
        }
        else
        {
            $this->ERR_BD = "ERR_CODE: " . $conex->errno . "<br>ERROR: " . $conex->error;
            return false;
        }
    }

    function getHoraSalida($dia)
    {
        $this->bdConex();
        $conex = $this->conex;
        $userdata = "SELECT $this->horarios.Hora_salida FROM $this->horarios INNER JOIN $this->profesores ON $this->horarios.ID_PROFESOR=$this->profesores.ID WHERE DNI='$_SESSION[user]' AND Nombre='$_SESSION[username]' AND $this->horarios.Dia='$dia' LIMIT 1";
        $hs = $conex->query($userdata);
        if($hs = $hs->fetch_assoc())
        {
            return $hs['Hora_salida'];
        }
        else
        {
            $this->ERR_BD = "ERR_CODE: " . $conex->errno . "<br>ERROR: " . $conex->error;
            return false;
        }
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
            $hora = date('H:i:00');
            $hora_salida = $this->getHoraSalida($this->getDiaSemana());
            $fichaje = "INSERT INTO $this->fichaje (ID_PROFESOR, Fecha, F_entrada, F_salida, Hora_salida) VALUES ($id, '$fecha', '$hora', '$hora_salida', '$hora_salida')";
            if($exec = $conex->query($fichaje))
            {
                return true;
            }
            else
            {
                $this->ERR_BD = "ERR_CODE: " . $conex->errno . "<br>ERROR: " . $conex->error;
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    function FicharTerminal()
    {
        
    }
    
    function getFichadoHoy()
    {
        $this->bdConex();
        $conex = $this->conex;
        $id = $this->getID();
        if($this->conex_status == 1)
        {
            date_default_timezone_set('Europe/Madrid');
            $fecha = date('Y-m-d');
            $hora = date('H:i:00');
            $hora_salida = $this->getHoraSalida();
            $fichaje = "INSERT INTO $this->fichaje (ID_PROFESOR, Fecha, F_entrada, F_salida, Hora_salida) VALUES ($id, '$fecha', '$hora', '$hora_salida', '$hora_salida')";
            $exec = $conex->query($fichaje);
            return true;
        }
        else
        {
            return false;
        }
    }

    function searchDuplicateUser($dni)
    {
        $this->bdConex();
        $conex = $this->conex;
        $consulta = "SELECT Nombre, DNI FROM $this->profesores WHERE DNI='$dni'";
        if($res = $conex->query($consulta))
        {
            if($res->num_rows == 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            $this->ERR_BD = $conex->error;
            return false;
        }
    }

    function searchDuplicateDay()
    {
        $this->bdConex();
        $conex = $this->conex;
        $id = $this->getID();
        $today = date('Ymd');
        $consulta = "SELECT ID FROM $this->fichaje WHERE ID_PROFESOR='$id' AND Fecha='$today'";
        if($res = $conex->query($consulta))
        {
            if($res->num_rows == 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            $this->ERR_BD = $conex->error;
            return false;
        }
    }

    function tooLateEntrada()
    {
        $this->bdConex();
        $conex = $this->conex;
        $id = $this->getID();
        if($this->conex_status == 1)
        {
            date_default_timezone_set('Europe/Madrid');
            $fecha = date('Y-m-d');
            $horaactual = mktime(date('H'),date('i'),date('s'),date('m'),date('d'),date('Y'));
            $hora_salida = $this->getHoraSalida($this->getDiaSemana());
            return $hora_salida;

            return true;
        }
        else
        {
            return false;
        }
    }

    function tooLateSalida()
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
            $fichaje = "INSERT INTO $this->fichaje (ID_PROFESOR, Fecha, F_entrada, F_salida, Hora_salida) VALUES ($id, '$fecha', '$hora', '$hora_salida', '$hora_salida')";
            $exec = $conex->query($fichaje);
            return true;
        }
        else
        {
            return false;
        }
    }

    function insertNewUser($name, $dni, $pass)
    {
        $this->bdConex();
        $conex = $this->conex;
        $consulta = "INSERT INTO $this->profesores (Nombre, DNI, Password, Admin) VALUES ('$name', '$dni', '$pass', 0)";
        if($conex->query($consulta))
        {
            return true;
        }
        else
        {
            $this->ERR_BD = $conex->error;
            return false;
        }
    }
}