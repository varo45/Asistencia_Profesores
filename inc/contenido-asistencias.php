<div class="container-fluid" style="margin-top:50px">
<?php

echo "<div class='row' style='text-align: center;'>";
    echo "<div class='col-xs-12 col-md-4'>";
        include_once($dirs['inc'] . 'fichajes.php');
    echo "</div>";
    echo "<div class='col-xs-12 col-md-8'>";
        include_once($dirs['inc'] . 'faltas_profesor.php');
    echo "</div>";
echo "</div>";

?>
</div>