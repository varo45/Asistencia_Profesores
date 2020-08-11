<div class="container" style="margin-top: 50px; margin-left: auto; margin-right: auto; width: 85%;">
    <div class="row">
        <div class="col-xs-12 col-md-4">
        <h2>Calendario escolar</h2>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
            <h3>Fechas Lectivas:</h3>
            <h4>Inicio:</h4>
            <input id="datepicker_ini" type="text" name="inicio" placeholder="* Fecha de inicio" autocomplete="off"><br>
            <h4>Fin:</h4>
            <input id="datepicker_fin" type="text" name="fin" placeholder="* Fecha de fin" autocomplete="off"><br><br>
            <input type="submit" name="enviar" value="Insertar">
        </form>

<?php

if($response = $class->selectFrom("SELECT * FROM $class->lectivos"))
{
    if($response->num_rows > 0)
    {
        echo '
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="POST">
          <br><h3>Fechas Festivas:</h3>
          <h4>Inicio:</h4>
            <input id="datepicker_ini_fest" type="text" name="inicio" placeholder="* Fecha de inicio" autocomplete="off"><br>
          <h4>Fin:</h4>
            <input id="datepicker_fin_fest" type="text" name="fin" placeholder="* Fecha de fin" autocomplete="off"><br><br>
            <input type="submit" name="enviar" value="Festivos"><br><br>
        </form>
        <h3>Generar cuadrante de horas:</h3>
        <span style="color:grey;"><i>* Después de realizar esta acción, no se podrán modificar las fechas lectivas y/o festivas.</i></span><br>
        <a href="index.php?ACTION=create_marcajes"><input type="submit" id="generar_marcajes" value="Generar"></a>
    </div>
        ';        
    }

    echo "<div class='col-xs-12 col-md-8'>";
        include_once($dirs['inc'] . 'calendario.php');
    echo "</div>";
}
else
{
    $ERR_MSG = $class->ERR_NETASYS;
}
?>