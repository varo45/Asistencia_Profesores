<div class="container" style="margin-top:50px">

<?php

if(isset($_GET['Numero']))
{
    $edificio = 'en el edificio ' . $_GET['Numero'];
}
echo "<h2>Aulas sin profesor $edificio</h2>";
include_once($dirs['inc'] . 'guardias.php');

?>

</div>