<?php

echo "<div>";
    echo "<form action='$_SERVER[REQUEST_URI]' method='POST'>";
    echo "<input type='text' name='Nombre' value='$_POST[Nombre]' class='btn btn-default' placeholder='Nombre y Apellidos'><br><br>";
    echo "<input type='text' name='Iniciales' value='$_POST[Iniciales]' class='btn btn-default' placeholder='Iniciales'><br><br>";
    echo "<button value='registrar_prof' name='boton' class='btn btn-default' onclick='return confirm(\"¿Desea registrar a este profesor?\")'>Registrar</button>";
    echo "</form>";
echo "</div>";

?>