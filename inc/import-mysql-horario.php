<?php

require_once($dirs['class'] . 'DataSource.php');
$db = new DataSource();
$conn = $db->getConnection();

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        $row = 1;
        while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {
            if($row == 1){ $row++; continue; }
            $row++;
            $horarioID = "";
            if (isset($column[0])) {
                $column[0] = preg_replace('/(\")|(\s)/', '', $column[0]);
                $horarioID = mysqli_real_escape_string($conn, utf8_encode($column[0]));
            }
            $horarioCurso = "";
            if (isset($column[1])) {
                $column[1] = preg_replace('/(\")|(\s)/', '', $column[1]);
                $horarioCurso = mysqli_real_escape_string($conn, utf8_encode($column[1]));
            }
            $horarioAbprof = "";
            if (isset($column[2])) {
                $column[2] = preg_replace('/(\")|(\s)/', '', $column[2]);
                $horarioAbprof = mysqli_real_escape_string($conn, utf8_encode($column[2]));
            }
            $horarioAula = "";
            if (isset($column[4])) {
                $column[4] = preg_replace('/(\")|(\s)/', '', $column[4]);
                $horarioAula = mysqli_real_escape_string($conn, utf8_encode($column[4]));
            }
            $horarioDiasemana = "";
            if (isset($column[5])) {
                $column[5] = preg_replace('/(\")|(\s)/', '', $column[5]);
                $horarioDiasemana = mysqli_real_escape_string($conn, utf8_encode($column[5]));
            }
            $horarioHora = "";
            if (isset($column[6])) {
                $column[6] = preg_replace('/(\")|(\s)/', '', $column[6]);
                $horarioHora = mysqli_real_escape_string($conn, utf8_encode($column[6]));
            }
            $sqlInsert = "INSERT into Import (ID, Curso, Abprof, Aula, Diasemana, Hora)
                   values (?, ?, ?, ?, ?, ?)";
            $paramType = "isssii"; 
            $paramArray = array(
                $horarioID,
                $horarioCurso,
                $horarioAbprof,
                $horarioAula,
                $horarioDiasemana,
                $horarioHora
            );
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);
            
            if (! empty($insertId)) {
                $type = "success";
                $message = "Datos importados correctamente.";
            } else {
                $type = "error";
                $message = "Error al importar datos desde CSV";
            }
        }
    }
}
?>