<div class="container" style="margin-top: 50px; margin-left: auto; margin-right: auto; width: 85%;">
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
        <form action="$_SERVER[REQUEST_URI]" method="POST">
          <br><h3>Fechas Festivas:</h3>
          <h4>Inicio:</h4>
            <input id="datepicker_ini_fest" type="text" name="inicio" placeholder="* Fecha de inicio" autocomplete="off"><br>
          <h4>Fin:</h4>
            <input id="datepicker_fin_fest" type="text" name="fin" placeholder="* Fecha de fin" autocomplete="off"><br><br>
            <input type="submit" name="enviar" value="Festivos"><br><br>
        </form>
        <h3>Generar cuadrante de horas:</h3>
        <span style="color:grey;"><i>* Después de realizar esta acción, no se podrán modificar las fechas lectivas y/o festivas.</i></span><br>
        <a href="index.php?ACTION=pruebas"><input type="submit" id="generar_marcajes" value="Generar"></a>
    </div>
        ';        
    }
    echo "<div class='col-xs-12 col-md-8'>";
    if($response = $class->selectFrom("SELECT * FROM $class->lectivos ORDER BY Fecha ASC"))
    {   
        echo "<div id='mitablita'>";
        $contador = 0;
        $diaanterior = 99;
        while($calendario = $response->fetch_assoc())
        {
            if($calendario['Festivo'] == 'si')
            {
                $festivo = "background-color: #dff0d8; color: black;";
                $festivo = "festivo";
            }
            else
            {
                $festivo = "";
            }
            if($calendario['Fecha'] == 'Y-m-d')
            {
                $diahoy = "background-color: #b2e5ff !important;";
            }
            else
            {
                $diahoy = "";
            }
            $sep=explode("-", $calendario['Fecha']);
            $dia = $sep[2];
            $m = $sep[1];
            $Y = $sep[0];
            $start = unixtojd(mktime(0,0,0,$m,$dia,$Y));
            $array = cal_from_jd($start,CAL_GREGORIAN);
            $nuevodia = $array['day'];
            if($array['monthname'] == 'January')
            {
                $array['monthname'] = 'Enero';
            }
            if($array['monthname'] == 'February')
            {
                $array['monthname'] = 'Febrero';
            }
            if($array['monthname'] == 'March')
            {
                $array['monthname'] = 'Marzo';
            }
            if($array['monthname'] == 'April')
            {
                $array['monthname'] = 'Abril';
            }
            if($array['monthname'] == 'May')
            {
                $array['monthname'] = 'Mayo';
            }
            if($array['monthname'] == 'June')
            {
                $array['monthname'] = 'Junio';
            }
            if($array['monthname'] == 'July')
            {
                $array['monthname'] = 'Julio';
            }
            if($array['monthname'] == 'August')
            {
                $array['monthname'] = 'Agosto';
            }
            if($array['monthname'] == 'September')
            {
                $array['monthname'] = 'Septiembre';
            }
            if($array['monthname'] == 'October')
            {
                $array['monthname'] = 'Octubre';
            }
            if($array['monthname'] == 'November')
            {
                $array['monthname'] = 'Noviembre';
            }
            if($array['monthname'] == 'December')
            {
                $array['monthname'] = 'Diciembre';
            }
            if($nuevodia < $diaanterior)
            {
                $contador = 0;
                echo "</table>";
                echo "</div>";
                echo "<div class='calendario_$contador' style='display:inline-block; margin-right: 17px;'>";
                echo "<h2>$array[monthname]</h2>";            
                echo "<table>";

            }
            if($contador == 0)
            {
                echo "<thead>";
                echo "<tr>";
                echo "<th>L</th>";
                echo "<th>M</th>";
                echo "<th>X</th>";
                echo "<th>J</th>";
                echo "<th>V</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tr>";
                if($array['dayname'] == 'Monday')
                {
                    echo "<td class='$festivo $diahoy'>$array[day]</td>";
                    
                }
                if($array['dayname'] == 'Tuesday')
                {
                    echo "<td class='$festivo $diahoy'></td>";
                    echo "<td class='$festivo $diahoy'>$array[day]</td>";
                }
                if($array['dayname'] == 'Wednesday')
                {
                    echo "<td class='$festivo $diahoy'></td>";
                    echo "<td class='$festivo $diahoy'></td>";
                    echo "<td class='$festivo $diahoy'>$array[day]</td>";
                }
                if($array['dayname'] == 'Thursday')
                {
                    echo "<td class='$festivo $diahoy'></td>";
                    echo "<td class='$festivo $diahoy'></td>";
                    echo "<td class='$festivo $diahoy'></td>";
                    echo "<td class='$festivo $diahoy'>$array[day]</td>";
                }
                if($array['dayname'] == 'Friday')
                {
                    echo "<td class='$festivo $diahoy'></td>";
                    echo "<td class='$festivo $diahoy'></td>";
                    echo "<td class='$festivo $diahoy'></td>";
                    echo "<td class='$festivo $diahoy'></td>";
                    echo "<td class='$festivo $diahoy'>$array[day]</td>";
                    echo "</tr>";
                }
                $contador++;
                $diaanterior = $array['day'];
                continue;
            }
            else
            {
                if($nuevodia < $diaanterior && $diaanterior != 0)
                {
                    $contador = 0;
                    echo "<tr>";
                    echo "<th >$array[monthname]</th>";            
                    echo "</tr>";
                    echo "<tr>";
                }
                if($array['dayname'] == 'Monday')
                {
                    echo "<td class='$festivo $diahoy'>$array[day]</td>";   
                }
                if($array['dayname'] == 'Tuesday')
                {
                    echo "<td class='$festivo $diahoy'>$array[day]</td>";
                }
                if($array['dayname'] == 'Wednesday')
                {
                    echo "<td class='$festivo $diahoy'>$array[day]</td>";
                }
                if($array['dayname'] == 'Thursday')
                {
                    echo "<td class='$festivo $diahoy'>$array[day]</td>";
                }
                if($array['dayname'] == 'Friday')
                {
                    echo "<td class='$festivo $diahoy'>$array[day]</td>";
                    echo "</tr>";
                }
            }
            $diaanterior = $array['day'];
        }
        echo "</table>";
    echo "</div>";
    }
}
else
{
    $ERR_MSG = $class->ERR_NETASYS;
}
?>