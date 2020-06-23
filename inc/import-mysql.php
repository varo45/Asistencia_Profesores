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
            $userId = "";
            if (isset($column[0])) {
                $userId = mysqli_real_escape_string($conn, utf8_encode($column[0]));
            }
            $userName = "";
            if (isset($column[1])) {
                $userName = mysqli_real_escape_string($conn, utf8_encode($column[1]));
            }
            $password = "";
            if (isset($column[2])) {
                $password = mysqli_real_escape_string($conn, utf8_encode($column[2]));
            }
            
            $sqlInsert = "INSERT into import (ABREV, NOMBR, TUTOR)
                   values (?,?,?)";
            $paramType = "sss";
            $paramArray = array(
                $userId,
                $userName,
                $password
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