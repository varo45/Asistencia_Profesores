<?php
if($response = $class->query("SELECT ID, Nombre FROM $class->profesores WHERE ID <> '$_SESSION[ID]' ORDER BY Nombre"))
{
    echo "<select id='select_mensaje' name='Profesor' class='form'>";
    while($fila = $response->fetch_assoc())
    {
        echo "<option value='$fila[ID]'> $fila[Nombre] </option>";
    }
    echo "</select>";
}
else
{
    $ERR_MSG = $class->ERR_ASYSTECO;
}
?>