<?php
if($class->searchDuplicateField($response = $class->encryptPassword($_SESSION['Iniciales'] . '12345'), 'Password', $class->profesores))
{

}
else
{
  $ERR_MSG = "Cambia la pass.";
}
?>