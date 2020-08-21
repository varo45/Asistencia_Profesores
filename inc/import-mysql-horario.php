<?php

require_once($dirs['class'] . 'DataSource.php');
$db = new DataSource();
$conn = $db->getConnection();

if (isset($_POST["import"]))
{
    if(isset($_POST['fecha']))
    {
        if($class->validFormDate($_POST['fecha']))
        {
            $fileName = $_FILES["file"]["tmp_name"];
            if ($_FILES["file"]["size"] > 0)
            { 
                $file = fopen($fileName, "r");
                $row = 1;
                while (($column = fgetcsv($file, 10000, ";")) !== FALSE)
                {
                    if($row == 0 && is_string($column[0], $column[1], $column[2], $column[3], $column[4], $column[5], $column[6])){ $row++; continue; }
                    $row++;
                    $horarioID = "";
                    if (isset($column[0])) {
                        $column[0] = preg_replace('/(\")|(\s)/', '', $column[0]);
                        $horarioID = mysqli_real_escape_string($conn, utf8_encode($column[0]));
                    }
                    $Grupo = "";
                    if (isset($column[1])) {
                        $column[1] = preg_replace('/(\")|(\s)/', '', $column[1]);
                        $Grupo = mysqli_real_escape_string($conn, utf8_encode($column[1]));
                    }
                    $Iniciales = "";
                    if (isset($column[2])) {
                        $column[2] = preg_replace('/(\")|(\s)/', '', $column[2]);
                        $Iniciales = mysqli_real_escape_string($conn, utf8_encode($column[2]));
                    }
                    $Aula = "";
                    if (isset($column[4])) {
                        $column[4] = preg_replace('/(\")|(\s)/', '', $column[4]);
                        $Aula = mysqli_real_escape_string($conn, utf8_encode($column[4]));
                    }
                    $Diasemana = "";
                    if (isset($column[5])) {
                        $column[5] = preg_replace('/(\")|(\s)/', '', $column[5]);
                        $Diasemana = mysqli_real_escape_string($conn, utf8_encode($column[5]));
                    }
                    $Hora_tipo = "";
                    if (isset($column[6])) {
                        $column[6] = preg_replace('/(\")|(\s)/', '', $column[6]);
                        $Hora_tipo = mysqli_real_escape_string($conn, utf8_encode($column[6]));
                        $Hora_tipo .= 'M';
                    }
                    $Edificio = "";
                    if (isset($Aula)) {
                        $sed = preg_split('//', $Aula, -1, PREG_SPLIT_NO_EMPTY);
                        $Edificio = mysqli_real_escape_string($conn, utf8_encode($sed[2]));
                        preg_match('/^[0-9]$/', $Edificio) ? $Edificio = $Edificio : $Edificio=0;
                    }
                    $response = $class->query("SELECT ID FROM Profesores WHERE Iniciales='$Iniciales'");
                    $IDPROFESOR = $response->fetch_assoc();
                    $IDPROFESOR = $IDPROFESOR['ID'];
                    $Hora_entrada = "08:30:00";
                    $Hora_salida = "15:00:00";
                    $sep = preg_split('/\//', $_POST['fecha']);
                    $dia = $sep[0];
                    $m = $sep[1];
                    $Y = $sep[2];
                    $Hora_incorpora = "$Y-$m-$dia";
                    if(! $class->query("INSERT into T_horarios (ID_PROFESOR, Dia, HORA_TIPO, Edificio, Aula, Grupo, Hora_entrada, Hora_salida, Fecha_incorpora)
                    values (
                        '$IDPROFESOR',
                        '$Diasemana',
                        '$Hora_tipo',
                        '$Edificio',
                        '$Aula',
                        '$Grupo',
                        '$Hora_entrada',
                        '$Hora_salida',
                        '$Hora_incorpora')"))
                    {
                        $ERR_MSG = "<br>Error al importar datos desde CSV.<br>";
                        $ERR_MSG .= $class->ERR_NETASYS;
                    }
                    else
                    {
                        $MSG = "Horarios importados correctamente.<br>";
                        $MSG .= "Entrarán en vigor el día $_POST[fecha]";
                    }
                }
            }
            else
            {
                $ERR_MSG = "El fichero está vacío.";
            }
            //include_once($dirs['inc'] . 'marcajes.php');
        }
    }
    else
    {
        $fileName = $_FILES["file"]["tmp_name"];
        if ($_FILES["file"]["size"] > 0)
        { 
            $file = fopen($fileName, "r");
            $row = 1;
            while (($column = fgetcsv($file, 10000, ";")) !== FALSE)
            {
                if($row == 1){ $row++; continue; }
                $row++;
                $horarioID = "";
                if (isset($column[0])) {
                    $column[0] = preg_replace('/(\")|(\s)/', '', $column[0]);
                    $horarioID = mysqli_real_escape_string($conn, utf8_encode($column[0]));
                }
                $Grupo = "";
                if (isset($column[1])) {
                    $column[1] = preg_replace('/(\")|(\s)/', '', $column[1]);
                    $Grupo = mysqli_real_escape_string($conn, utf8_encode($column[1]));
                }
                $Iniciales = "";
                if (isset($column[2])) {
                    $column[2] = preg_replace('/(\")|(\s)/', '', $column[2]);
                    $Iniciales = mysqli_real_escape_string($conn, utf8_encode($column[2]));
                }
                $Aula = "";
                if (isset($column[4])) {
                    $column[4] = preg_replace('/(\")|(\s)/', '', $column[4]);
                    $Aula = mysqli_real_escape_string($conn, utf8_encode($column[4]));
                }
                $Diasemana = "";
                if (isset($column[5])) {
                    $column[5] = preg_replace('/(\")|(\s)/', '', $column[5]);
                    $Diasemana = mysqli_real_escape_string($conn, utf8_encode($column[5]));
                }
                $Hora_tipo = "";
                if (isset($column[6])) {
                    $column[6] = preg_replace('/(\")|(\s)/', '', $column[6]);
                    $Hora_tipo = mysqli_real_escape_string($conn, utf8_encode($column[6]));
                    $Hora_tipo .= 'M';
                }
                $Edificio = "";
                if (isset($Aula)) {
                    $sed = preg_split('//', $Aula, -1, PREG_SPLIT_NO_EMPTY);
                    $Edificio = mysqli_real_escape_string($conn, utf8_encode($sed[2]));
                }
                if(is_string($Edificio))
                {
                    $Edificio = NULL;
                }
                $response = $class->query("SELECT ID FROM Profesores WHERE Iniciales='$Iniciales'");
                $IDPROFESOR = $response->fetch_assoc();
                $IDPROFESOR = $IDPROFESOR['ID'];
                $Hora_entrada = "08:30:00";
                $Hora_salida = "15:00:00";
                $sqlInsert = "INSERT into Horarios (ID_PROFESOR, Dia, HORA_TIPO, Edificio, Aula, Grupo, Hora_entrada, Hora_salida)
                       values (?,?,?,?,?,?,?,?)";
                $paramType = "iisissss"; 
                $paramArray = array(
                    $IDPROFESOR,
                    $Diasemana,
                    $Hora_tipo,
                    $Edificio,
                    $Aula,
                    $Grupo,
                    $Hora_entrada,
                    $Hora_salida
                );
                $response = $class->query("SELECT ID FROM Horarios WHERE ID_PROFESOR='$IDPROFESOR' AND Dia='$Diasemana' AND HORA_TIPO='$Hora_tipo' AND Grupo='$Grupo'");
                if($response->num_rows == 0)
                {
                    $insertId = $db->insert($sqlInsert, $paramType, $paramArray);
                }
    
                if (! empty($insertId)) {
                    $type = "success";
                    $MSG = "Datos importados correctamente.";
                }
                else
                {
                    $type = "error";
                    $ERR_MSG = "Error al importar datos desde CSV <br>Compruebe que ha importado primero al profesorado.";
                }
            }
        }
        else
        {
            $ERR_MSG = "El fichero está vacío.";
        }
    }
}
?>