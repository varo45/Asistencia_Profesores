<?php

require_once($dirs['class'] . 'DataSource.php');
$db = new DataSource();
$conn = $db->getConnection();

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
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
            $response = $class->selectFrom("SELECT ID FROM Profesores WHERE Iniciales='$Iniciales'");
            $IDPROFESOR = $response->fetch_assoc();
            $IDPROFESOR = $IDPROFESOR['ID'];
            $Hora_entrada = "08:30:00";
            $Hora_salida = "15:00:00";
            $sqlInsert = "INSERT into Horarios (ID_PROFESOR, Dia, HORA_TIPO, Aula, Grupo, Hora_entrada, Hora_salida)
                   values (?,?,?,?,?,?,?)";
            $paramType = "iisssss"; 
            $paramArray = array(
                //$horarioID,
                $IDPROFESOR,
                $Diasemana,
                $Hora_tipo,
                $Aula,
                $Grupo,
                $Hora_entrada,
                $Hora_salida
            );
            $response = $class->selectFrom("SELECT ID FROM Horarios WHERE ID_PROFESOR='$IDPROFESOR' AND Dia='$Diasemana' AND HORA_TIPO='$Hora_tipo' AND Grupo='$Grupo'");
            if($response->num_rows == 0)
            {
                $insertId = $db->insert($sqlInsert, $paramType, $paramArray);
            }
            
            if (! empty($insertId)) {
                $type = "success";
                //$message = "Datos importados correctamente.";
                $MSG = "Datos importados correctamente.";
            } else {
                $type = "error";
                //$message = "Error al importar datos desde CSV";
                $ERR_MSG = "Error al importar datos desde CSV <br>Compruebe que ha importado primero al profesorado.";
            }
        }
    }
}
?>