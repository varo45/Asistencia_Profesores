<?php

class Netasys
{

    private $host = '192.168.100.133:8989';
    private $user = 'profesores';
    private $pass = 'f36c0d6388963313095f349dabd4c2e9f730868e';
    private $db = 'Netasys';

    public $fichar = 'Fichar';
    public $horarios = 'Horarios';
    public $profesores = 'Profesores';
    public $horas = 'Horas';
    public $perfiles = 'Perfiles';
    public $lectivos = 'Lectivos';

    public $ERR_NETASYS;


    function bdConex()
    {
        $conex = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if(! $conex->connect_errno) {
            return $conex;
        }
        else
        {
            $this->ERR_NETASYS = "Fallo al conectar a MySQL: (" . $this->conex->connect_errno . ") " . $this->conex->connect_error;
            return false;
        }
    }

    function getConsulta($sql)
    {
        echo $sql;
    }

    function selectFrom($sql)
    {
        if(! $conex = $this->bdConex())
        {
            return false;
        }
        if($response = $conex->query($sql))
        {
            return $response;
        }
        else
        {
            $this->ERR_NETASYS = "ERR_CODE: " . $conex->errno . "<br>ERROR: " . $conex->error;
            return false;
        }
    }

    function insertInto($sql)
    {
        if(! $conex = $this->bdConex())
        {
            return false;
        }
        if($response = $conex->query($sql))
        {
            return $response;
        }
        else
        {
            $this->ERR_NETASYS = "ERR_CODE: " . $conex->errno . "<br>ERROR: " . $conex->error;
            return false;
        }
    }

    function updateSet($sql)
    {
        if(! $conex = $this->bdConex())
        {
            return false;
        }
        if($response = $conex->query($sql))
        {
            return $response;
        }
        else
        {
            $this->ERR_NETASYS = "ERR_CODE: " . $conex->errno . "<br>ERROR: " . $conex->error;
            return false;
        }
    }

    function registerNewUser($name, $iniciales, $password, $type )
    {
        if(! $conex = $this->bdConex())
        {
            return false;
        }
        if($response = $conex->query($sql))
        {
            return $response;
        }
        else
        {
            $this->ERR_NETASYS = "ERR_CODE: " . $conex->errno . "<br>ERROR: " . $conex->error;
            return false;
        }
    }

    function isLogged()
    {
        if($_SESSION['logged'] === true && isset($_SESSION['Nombre']) && isset($_SESSION['Iniciales']) && $_SESSION['Nombre'] != '')
        {
            return true;
        }
        else
        {
            $this->ERR_NETASYS = "Debe iniciar sesión.";
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
        if(preg_match('/^[ a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñÑ.-]{6,60}$/i', $registername))
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

    function validFormIni($registerini)
    {
        $registerini = strtoupper($registerini);

        if(preg_match('/^[A-Z]{2,4}$/i', $registerini))
        {
            return true;
        }
        else
        {
            $this->ERR_NETASYS = "Iniciales no válidas <br>";
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
            if($response = $this->selectFrom("SELECT ID FROM $this->profesores WHERE Iniciales='$username' AND Password='$password'"))
            {
                if($response->num_rows == 1)
                {
                    if($response = $this->selectFrom("SELECT $this->profesores.ID, $this->profesores.Nombre, $this->profesores.Iniciales, $this->perfiles.Tipo 
                                                    FROM $this->profesores INNER JOIN $this->perfiles ON $this->profesores.TIPO=$this->perfiles.ID 
                                                    WHERE Iniciales='$username' AND Password='$password'"))
                    {
                        $fila = $response->fetch_assoc();
                        $_SESSION['logged'] = true;
                        $_SESSION['Iniciales'] = $fila['Iniciales'];
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

    function getLastIDFichaje()
    {
        $conex = $this->bdConex();
        $id = $_SESSION['ID'];
        $sql = "SELECT ID FROM $this->fichaje WHERE ID_PROFESOR='$id' ORDER BY ID DESC LIMIT 1";
        if($lastID = $this->selectFrom($sql))
        {
            $lastID = $lastID->fetch_assoc();
            return $lastID['ID'];
        }
        else
        {
            $this->ERR_NETASYS = "ERR_CODE: " . $conex->errno . "<br>ERROR: " . $conex->error;
            return false;
        }
    }

    function getHoraClase()
    {
        date_default_timezone_set('Europe/Madrid');
        $now = date('H:i:s');
        //$now = '10:22:00';
        if($response = $this->selectFrom("SELECT Hora FROM Horas WHERE Inicio <= '$now' AND Fin >= '$now'"))
        {  
            return $response;
        }
        else
        {
            return false;
        }
    }

    function getGuardias()
    {
        
        if(! $ahora = $this->getDate())
        {
            return false;
        }
        else
        {
            $diasemana = $ahora['weekday'];
            $horaclase = $this->getHoraClase();
            $horaactual = $horaclase->fetch_assoc();
            $horaactual = $horaactual['Hora'];
            $dia = $ahora['year'] . "-" . $ahora['mon'] . "-" . $ahora['mday'];
            $horasistema = $ahora['hours'] . ":" . $ahora['minutes'] . ":" . $ahora['seconds'];
        }
        if(isset($_GET['Numero']))
        {
            
            $extra = "AND $this->horarios.Edificio='$_GET[Numero]'";
        }
        $sql = "SELECT DISTINCT $this->profesores.Nombre, $this->horarios.Aula, $this->horarios.Grupo, $this->horarios.Edificio, $this->horarios.HORA_TIPO 
        FROM ($this->horarios INNER JOIN $this->profesores ON $this->horarios.ID_PROFESOR=$this->profesores.ID) INNER JOIN $this->horas ON $this->horas.Hora=$this->horarios.HORA_TIPO 
        WHERE NOT EXISTS 
        (SELECT * FROM $this->fichar 
            WHERE $this->fichar.ID_PROFESOR=$this->horarios.ID_PROFESOR AND $this->fichar.DIA_SEMANA='$diasemana' AND $this->fichar.Fecha='$dia') 
        AND $this->horarios.Dia='$diasemana' AND $this->horarios.Edificio IS NOT NULL AND $this->horarios.Aula IS NOT NULL AND $this->horarios.Grupo IS NOT NULL AND $this->horas.Fin > '$horasistema' $extra
        ORDER BY $this->horarios.HORA_TIPO, $this->horarios.Aula, $this->profesores.Nombre";
        if($exec = $this->selectFrom($sql))
        {
            if($exec->num_rows > 0)
            {
                return $exec;
            }
            else
            {
                echo "No existen Aulas sin Profesor.";
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    function FicharWeb()
    {
        if($response = $this->selectFrom("SELECT ID FROM $this->profesores WHERE Iniciales='$_GET[abrev]' AND Password='$_GET[enp]'"))
        {
            $idprof = $response->fetch_assoc();
            $id = $idprof['ID'];
        }
        else
        {
            return false;
        }
        //$id = $_SESSION['ID'];
        if($this->bdConex())
        {
            date_default_timezone_set('Europe/Madrid');
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            $horaclase = $this->getHoraClase();
            $horaclase = $horaclase->fetch_assoc();
            $horaclase = $horaclase['Hora'];
            $dia = $this->getDate();
            $hora_salida = $this->getHoraSalida();
            $sql = "SELECT DISTINCT $this->fichar.ID, $this->horarios.Hora_salida 
                    FROM $this->fichar INNER JOIN $this->horarios 
                    WHERE $this->fichar.Fecha='$fecha' AND $this->fichar.ID_PROFESOR='$id'";
            if($response = $this->selectFrom($sql))
            {
                if($response->num_rows == 0)
                {
                    if($this->isTooLate($id, $hora, $dia['weekday']))
                    {
                        $fichar = "INSERT INTO $this->fichar (ID_PROFESOR, F_entrada, F_Salida, HORA_CLASE, DIA_SEMANA, Fecha) 
                                    VALUES ($id, '$hora', '15:00:00', '$horaclase', '$dia[weekday]', '$fecha')";
                        if($response = $this->insertInto($fichar))
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
                        $this->ERR_NETASYS = "<span id='noqr' style='color: black; font-weight: bolder; background-color: Yellow;'><h3>No se puede fichar fuera de horario.</h3></span>";
                        return false;
                    }
                }
                else
                {
                    $this->ERR_NETASYS = "<span id='noqr' style='color: black; font-weight: bolder; background-color: orange;'><h3>Ya has fichado hoy.</h3></span>";
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

    function getHoraEntrada()
    {
        $dia = $this->getDate();
        if($response = $this->selectFrom("SELECT $this->horarios.Hora_entrada FROM $this->horarios INNER JOIN $this->profesores ON $this->horarios.ID_PROFESOR=$this->profesores.ID WHERE $this->profesores.ID='$_SESSION[ID]' AND $this->profesores.Nombre='$_SESSION[Nombre]' AND $this->horarios.Dia='$dia[weekday]' LIMIT 1"))
        {
            if($hora_entrada = $response->fetch_assoc())
            {
                return $hora_entrada['Hora_entrada'];
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

    function getHoraSalida()
    {
        $dia = $this->getDate();
        $dia['weekday'] == 'Sabado' || $dia['weekday'] == 'Domingo' ? $this->ERR_NETASYS = "No puedes fichar fuera de Horario." : $dia['weekday'];
        if($response = $this->selectFrom("SELECT $this->horarios.Hora_salida 
                                        FROM $this->horarios 
                                        INNER JOIN $this->profesores ON $this->horarios.ID_PROFESOR=$this->profesores.ID 
                                        WHERE $this->profesores.ID='$_SESSION[ID]' AND $this->profesores.Nombre='$_SESSION[Nombre]' AND $this->horarios.Dia='$dia[weekday]' 
                                        LIMIT 1"))
        {
            if($hora_salida = $response->fetch_assoc())
            {
                return $hora_salida['Hora_salida'];
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

    function searchDuplicateField($data, $field, $table)
    {
        if($response = $this->selectFrom("SELECT $field FROM $table WHERE $field='$data'"))
        {
            if($response->num_rows == 0)
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
            return false;
        }
    }

    function isTooLate($id, $horaactual, $diasemana)
    {
        if($response = $this->selectFrom("SELECT DISTINCT $this->horarios.Hora_salida FROM $this->horarios WHERE ID_PROFESOR='$id' AND $this->horarios.Hora_salida >= '$horaactual' AND $this->horarios.Dia='$diasemana'"))
        {
            if($response->num_rows == 1)
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
            return false;
        }
    }

    function validRegisterProf()
    {
        if(! $this->validFormName($_POST['Nombre']))
        {
            $this->ERR_NETASYS = "Formato de Nombre incorrecto.";
            return false;
        }
        elseif(! $this->validFormIni($_POST['Iniciales']))
        {
            $this->ERR_NETASYS = "Formato de iniciales incorrecto.";
            return false;
        }
        else
        {
            if($this->searchDuplicateField($_POST['Iniciales'], 'Iniciales', $this->profesores))
            {
                $pass = $this->encryptPassword($_POST['Iniciales'] . '12345');
                if($this->insertInto("INSERT INTO $this->profesores (Nombre, Iniciales, Password, TIPO, Instituto)
                VALUES ('$_POST[Nombre]', '$_POST[Iniciales]', '$pass', '2', 'IES Bezmiliana')"))
                {
                    return true;
                }
                else
                {
                    $this->ERR_NETASYS;
                    return false;
                }

            }
            else
            {
                $this->ERR_NETASYS = "No se pueden duplicar las iniciales.";
                return false;
            }
        }
    }

    function dateLoop()
    {
        //Inicio de bucle
        $inicio = '2020-09-15';
        //fin de bucle
        $fin = '2021-06-18';

        while(strtotime($inicio) <= strtotime($fin))
        {
            //Indicando la fecha
            $diasmes = $inicio;
            //Separa la fecha
            $sep = preg_split('/-/', $diasmes);
            $dia = $sep[2];
            $m = $sep[1];
            $Y = $sep[0];
            //Calcula los días que tiene el mes
            //Devuelve la fecha Unix en formato fecha juliana
            $start = unixtojd(mktime(0,0,0,$m,$dia,$Y));
            //Cambia la fecha juliana a un formato de calendario
            $array = cal_from_jd($start,CAL_GREGORIAN);
            if($array['dayname'] == "Saturday" || $array['dayname'] == "Sunday")
            {

            }
            else
            {
                if($this->insertInto("INSERT INTO $this->lectivos (Fecha) VALUES ('$inicio')"))
                {
                    $this->ERR_NETASYS = "Insertado correctamente.";
                }
                else
                {
                    return false;
                }
            }
            $inicio = date ("Y-m-d", strtotime("+1 day", strtotime($inicio)));
        }

    }
}