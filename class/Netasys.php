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
    public $lectivos = 'Lectivos';
    public $diasemana = 'Diasemana';
    public $marcajes = 'Marcajes';
    public $mensajes = 'Mensajes';

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

    function query($sql)
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

    function deleteFrom($sql)
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

    function compruebaCambioPass()
    {
        $pass = $this->encryptPassword($_SESSION['Iniciales'] . '12345');
        if($response = $this->selectFrom("SELECT ID FROM $this->profesores WHERE Password='$pass' AND ID='$_SESSION[ID]'"))
        {
            if($response->num_rows == 0)
            {
                return true;
            }
            else
            {
                $this->ERR_NETASYS = "Debes cambiar la contraseña.";
                return false;
            }
            
        }
        else
        {
            $ERR_MSG = $class->ERR_NETASYS;
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

    function validFormDate($date)
    {
        if(preg_match('/^(0[1-9]|1[0-9]|2[0-9]|3[01])\/(0[1-9]|1[0-2])\/(19[0-9]{2}|20[0-9]{2})$/', $date))
        {
            return true;
        }
        else
        {
            $this->ERR_NETASYS = "Formato de fecha no válido. 
            <br>
            Formato válido: dd/mm/AAAA";
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
        //$now = '08:00:00';
        if($response = $this->selectFrom("SELECT Hora FROM Horas WHERE Inicio <= '$now' AND Fin >= '$now'"))
        {  
            return $response;
        }
        else
        {
            return false;
        }
    }

    function tempToValid()
    {
        $time="07:45:00"; // Hora límite para comprobar horarios
        $horaactual = date("H:i:s"); // Hora actual a comparar
        $fechaactual = date("Y-m-d");
        if(isset($_SESSION['fecha']) && $_SESSION['fecha'] == $fechaactual)
        {
            return true;
        }
        else
        {
            if(strtotime($horaactual) <= strtotime($time))
            {
                if($response = $this->query("SELECT * FROM T_horarios WHERE Fecha_incorpora = '$fechaactual'"))
                {
                    if($response->num_rows > 0)
                    {
                        if($response1 = $this->query("SELECT DISTINCT ID_PROFESOR FROM T_horarios WHERE Fecha_incorpora = '$fechaactual'"))
                        {
                            while($fila = $response1->fetch_assoc())
                            {
                                $todos[] = $fila['ID_PROFESOR'];
                            }
                            foreach($todos as $id)
                            {
                                if(! $this->query("DELETE FROM Horarios WHERE ID_PROFESOR = '$id'"))
                                {
                                    return false;
                                }

                                if($response2 = $this->query("SELECT * FROM T_horarios WHERE ID_PROFESOR = '$id' AND Fecha_incorpora = '$fechaactual'"))
                                {
                                    while($row = $response2->fetch_assoc())
                                    {
                                        if(! $this->query("INSERT INTO Horarios (ID_PROFESOR, Dia, HORA_TIPO, Aula, Grupo, Hora_entrada, Hora_salida)
                                        values (
                                            '$row[ID_PROFESOR]',
                                            '$row[Dia]',
                                            '$row[HORA_TIPO]',
                                            '$row[Aula]',
                                            '$row[Grupo]',
                                            '$row[Hora_entrada]',
                                            '$row[Hora_salida]')"))
                                        {
                                            return false;
                                        }
                                    }
                                    if(! $this->query("DELETE FROM T_horarios WHERE ID_PROFESOR = '$id' AND Fecha_incorpora = '$fechaactual'"))
                                    {
                                        return false;
                                    }
                                }

                                if(! $class->query("DELETE FROM $class->marcajes WHERE ID_PROFESOR='$id' AND Fecha>'$fechaactual'"))
                                {
                                    return false;
                                }
                                
                                include_once($dirs['inc'] . 'marcajes.php');
                            }
                            return $_SESSION['fecha'] = $fechaactual;
                        }
                        else
                        {
                            return false;
                        }
                    }
                    else
                    {
                        return $_SESSION['fecha'] = $fechaactual;
                    }
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return $_SESSION['fecha'] = $fechaactual;
            }
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
            $diasemananum = $ahora['wday'];
            $horaclase = $this->getHoraClase();
            $horaactual = $horaclase->fetch_assoc();
            $horaactual = $horaactual['Hora'];
            $dia = $ahora['year'] . "-" . $ahora['mon'] . "-" . $ahora['mday'];
            $horasistema = $ahora['hours'] . ":" . $ahora['minutes'] . ":" . $ahora['seconds'];

            // Línea de comprobación para que muestre todas las horas a partir de las 08:00:00 día 1-Lunes Fecha 2020-9-21
            $diasemananum = 1;
            $diasemana = 'Lunes';
            $dia = '2020-9-21';
            $horasistema = '08:00:00';
        }
        if(isset($_GET['Numero']))
        {
            $extra = "AND ($this->horarios.Aula LIKE 'AU$_GET[Numero]%' OR $this->horarios.Aula REGEXP '^[A-Z]?[0-9]+$' OR $this->horarios.Aula REGEXP '^[A-Za-z]+$')";
        }
        
        $sql = "SELECT DISTINCT
            $this->profesores.Nombre,
            $this->horarios.Aula,
            $this->horarios.Grupo,
            $this->horarios.Edificio,
            $this->horarios.HORA_TIPO,
            $this->profesores.ID 
        FROM
            ((($this->horarios INNER JOIN $this->profesores ON $this->horarios.ID_PROFESOR=$this->profesores.ID) 
            INNER JOIN $this->horas ON $this->horas.Hora=$this->horarios.HORA_TIPO) 
            INNER JOIN $this->diasemana ON $this->diasemana.ID=$this->horarios.Dia)
            INNER JOIN $this->marcajes ON $this->marcajes.ID_PROFESOR=$this->profesores.ID
        WHERE $this->marcajes.Dia = '$diasemananum'
            AND $this->marcajes.Fecha = '$dia'
            AND $this->profesores.Sustituido = 0
            AND $this->profesores.Activo = 1
            AND $this->diasemana.Diasemana='$diasemana' 
            AND ($this->marcajes.Asiste = 0
                OR $this->marcajes.Asiste = 2)
            AND $this->horarios.Aula IS NOT NULL
            AND $this->horarios.Grupo IS NOT NULL
            AND $this->horas.Fin >= '$horasistema'
            $extra 
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

            $sql = "SELECT DISTINCT
                    $this->fichar.ID,
                    $this->horarios.Hora_salida 
                    FROM $this->fichar INNER JOIN $this->horarios 
                    WHERE $this->fichar.Fecha='$fecha'
                    AND $this->fichar.ID_PROFESOR='$id'";

            if($response = $this->selectFrom($sql))
            {
                if($response->num_rows == 0)
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

                    $marcajes = "UPDATE $this->marcajes
                    SET Asiste='1'
                    WHERE Fecha='$fecha'
                    AND ID_PROFESOR='$id'";

                    if($marcado = $this->query($marcajes))
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
        if($response = $this->query("SELECT DISTINCT $this->horarios.Hora_salida 
        FROM $this->horarios INNER JOIN Diasemana ON $this->horarios.Dia=$this->diasemana.ID WHERE ID_PROFESOR='$id' 
        AND $this->horarios.Hora_salida >= '$horaactual' AND $this->diasemana.Diasemana='$diasemana'"))
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

    function dateLoop($inicio, $fin)
    {
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
                if(! $this->searchDuplicateField($diasmes, 'Fecha', $this->lectivos))
                {
                    $this->updateSet("UPDATE $this->lectivos SET $this->lectivos.Festivo='no' WHERE $this->lectivos.Fecha='$diasmes'");
                }
                else
                {
                    if($this->insertInto("INSERT INTO $this->lectivos (Fecha) VALUES ('$inicio')"))
                    {

                    }
                    else
                    {
                        return false;
                    }
                }
            }
            $inicio = date ("Y-m-d", strtotime("+1 day", strtotime($inicio)));
        }
        return true;
    }

    function updateDateLoop($inicio, $fin)
    {
        while(strtotime($inicio) <= strtotime($fin))
        {
            $diasmes = $inicio;
            $sep = preg_split('/-/', $diasmes);
            $dia = $sep[2];
            $m = $sep[1];
            $Y = $sep[0];
            $start = unixtojd(mktime(0,0,0,$m,$dia,$Y));
            $array = cal_from_jd($start,CAL_GREGORIAN);
            if($this->updateSet("UPDATE $this->lectivos SET $this->lectivos.Festivo='si' WHERE $this->lectivos.Fecha='$inicio'"))
            {

            }
            else
            {
                return false;
            }
            $inicio = date ("Y-m-d", strtotime("+1 day", strtotime($inicio)));
        }
    }

}