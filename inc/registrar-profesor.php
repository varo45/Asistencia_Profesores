<?php

echo "<div>";
    echo "<form action='$_SERVER[REQUEST_URI]' method='POST'>";
    echo "<h4 style='display: inline-block; margin-right: 15px;'>Registrar profesor: </h4>";
    echo "<input style='width: 25%; display: inline-block; margin-right: 15px;' class='form-control' type='text' name='Nombre' value='$_POST[Nombre]' class='btn btn-default' placeholder='Nombre y Apellidos'> ";
    echo "<input style='width: 25%; display: inline-block; margin-right: 15px;' class='form-control' type='text' name='Iniciales' value='$_POST[Iniciales]' class='btn btn-default' placeholder='Iniciales'> ";
    echo "<button value='registrar_prof' name='boton' class='btn btn-default' onclick='return confirm(\"¿Desea registrar a este profesor?\")'>Registrar</button>";
    echo "</form>";
echo "</div>";

?>