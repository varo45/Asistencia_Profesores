<div class="container-fluid" style="margin-top:50px">
<?php

$_GET['ID'] = $_SESSION['ID'];
echo "<div class='row'>";
    echo "<div class='col-xs-12 col-md-4'>";
        include_once($dirs['inc'] . 'fichajes.php');
    echo "</div>";
    echo "<div class='col-xs-12 col-md-8'>";
        include_once($dirs['inc'] . 'faltas_profesor.php');
    echo "</div>";
echo "</div>";

?>
</div>