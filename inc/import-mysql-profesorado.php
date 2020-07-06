<?php

require_once($dirs['class'] . 'DataSource.php');
require_once($dirs['class'] . 'Netasys.php');
$db = new DataSource();
$class = new Netasys();
$conn = $db->getConnection();

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        $row = 1;
        while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {
            if($row == 1){ $row++; continue; }
            $row++;
            $iniciales = "";
            if (isset($column[0])) {
                $iniciales = mysqli_real_escape_string($conn, utf8_encode($column[0]));
            }
            $nombre = "";
            if (isset($column[1])) {
                $nombre = mysqli_real_escape_string($conn, utf8_encode($column[1]));
            }
            $tutor = "";
            if (isset($column[2])) {
                $tutor = mysqli_real_escape_string($conn, utf8_encode($column[2]));
            }
            $password = $class->encryptPassword($iniciales . '12345');
            $tipo = mysqli_real_escape_string($conn, utf8_encode(2));
            $instituto = mysqli_real_escape_string($conn, utf8_encode('IES Bezmiliana'));
            $sqlInsert = "INSERT INTO Profesores (Iniciales, Nombre, Password, TIPO, Tutor, Instituto)
                   values (?,?,?,?,?,?)";
            $paramType = "sssiss";
            $paramArray = array(
                $iniciales,
                $nombre,
                $password,
                $tipo,
                $tutor,
                $instituto
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