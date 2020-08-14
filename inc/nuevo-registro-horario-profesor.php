<div class="container-fluid" style="margin-top:50px">
</div>
<?php
echo "<br>";
echo "<form action='index.php?ACTION=Agregar-registro-horario' method='POST'>";
echo "<input class='hidden' name='ID_PROFESOR' value='$_GET[ID]'></input>";
echo "<input class='hidden' name='Dia' value='$_GET[Dia]'></input>";
echo "<input class='hidden' name='Hora' value='$_GET[Hora]'></input>";
if($response = $class->query("SELECT DISTINCT $class->horarios.Aula FROM $class->horarios WHERE $class->horarios.Aula <> '' ORDER BY $class->horarios.Aula"))
{
    echo "<select name='Aula'>";
        echo "<option value=''>Sin Aula</option>";
        while($fila = $response->fetch_assoc())
        {
            echo "<option value='$fila[Aula]'>$fila[Aula]</option>";
        }
    echo "</select><br><br>";
}
if($response2 = $class->query("SELECT DISTINCT $class->horarios.Grupo FROM $class->horarios WHERE $class->horarios.Grupo <> '' ORDER BY $class->horarios.Grupo"))
{
    echo "<select name='Grupo' id='grupo'>";
        echo "<option value=''>Sin Grupo</option>";
        while($fila = $response2->fetch_assoc())
        {
            echo "<option value='$fila[Grupo]'>$fila[Grupo]</option>";
        }
    echo "</select>";
}
echo "<br><br>";
echo "<input type='submit' name='Enviar' value='Agregar'></input>";
echo "</form>";
?>