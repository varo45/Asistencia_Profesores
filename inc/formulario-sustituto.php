<div class="container-fluid" style="margin-top:50px">
</div>
<?php
echo "<br>";
echo "<form action='index.php' method='GET'>";
echo "<input class='hidden' name='ID_PROFESOR' value='$_GET[ID]'>";
if($response = $class->query("SELECT DISTINCT $class->profesores.Nombre, $class->profesores.ID
FROM $class->profesores WHERE NOT EXISTS 
(SELECT $class->horarios.ID_PROFESOR FROM $class->horarios WHERE $class->horarios.ID_PROFESOR=$class->profesores.ID)"))
{
    echo "<select name='ID_SUSTITUTO'>";
        while($fila = $response->fetch_assoc())
        {
            echo "<option value='$fila[ID]'>$fila[Nombre]</option>";
        }
    echo "</select><br><br>";
}
else
{
    $ERR_MSG = $class->ERR_NETASYS;
}
echo "<button value='Agregar-sustituto' name='ACTION'>Agregar Sustituto</button>";
echo "</form>";

?>