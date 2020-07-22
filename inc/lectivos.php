<div class="container" style="margin-top:50px">
<div class="col-xs-12 col-md-6">
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
        echo <<< EOL
        <form action="$_SERVER[REQUEST_URI]" method="POST">
          <br><h3>Fechas Festivas:</h3>
          <h4>Inicio:</h4>
            <input id="datepicker_ini_fest" type="text" name="inicio" placeholder="* Fecha de inicio" autocomplete="off"><br>
          <h4>Fin:</h4>
            <input id="datepicker_fin_fest" type="text" name="fin" placeholder="* Fecha de fin" autocomplete="off"><br><br>
            <input type="submit" name="enviar" value="Festivos"><br><br>
        </form>
        <h3>Generar horarios del profesorado:</h3>
        <span style='color:grey;'><i>* Después de realizar esta acción, no se podrán modificar las fechas lectivas y/o festivas.</i></span><br>
        <input type="submit" id='generar_marcajes' value="Generar">
    </div>
EOL;        
    }
    echo "<div class='col-xs-12 col-md-6'>";
    if($response = $class->selectFrom("SELECT * FROM $class->lectivos ORDER BY Fecha ASC"))
    {   
        echo "<table id='mitablita'>";
        $contador = 0;
        $diaanterior = 99;
        while($calendario = $response->fetch_assoc())
        {
            if($calendario['Festivo'] == 'si')
            {
                $festivo = "background-color: #dff0d8;";
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
                echo "<tr>";
                echo "<th style='padding:18px; border: 1px solid black;'>L</th>";
                echo "<th style='padding:18px; border: 1px solid black;'>M</th>";
                echo "<th style='padding:18px; border: 1px solid black;'>X</th>";
                echo "<th style='padding:18px; border: 1px solid black;'>J</th>";
                echo "<th style='padding:18px; border: 1px solid black;'>V</th>";
                echo "</tr>";
                echo "<tr>";
                if($array['dayname'] == 'Monday')
                {
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'>$array[day]</td>";
                    
                }
                if($array['dayname'] == 'Tuesday')
                {
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'></td>";
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'>$array[day]</td>";
                }
                if($array['dayname'] == 'Wednesday')
                {
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'></td>";
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'></td>";
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'>$array[day]</td>";
                }
                if($array['dayname'] == 'Thursday')
                {
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'></td>";
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'></td>";
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'></td>";
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'>$array[day]</td>";
                }
                if($array['dayname'] == 'Friday')
                {
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'></td>";
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'></td>";
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'></td>";
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'></td>";
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'>$array[day]</td>";
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
                    echo "<th style='padding:18px; border: 1px solid black;'>$array[monthname]</th>";            
                    echo "</tr>";
                    echo "<tr>";
                }
                if($array['dayname'] == 'Monday')
                {
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'>$array[day]</td>";   
                }
                if($array['dayname'] == 'Tuesday')
                {
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'>$array[day]</td>";
                }
                if($array['dayname'] == 'Wednesday')
                {
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'>$array[day]</td>";
                }
                if($array['dayname'] == 'Thursday')
                {
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'>$array[day]</td>";
                }
                if($array['dayname'] == 'Friday')
                {
                    echo "<td style='padding:18px; border: 1px solid black; $festivo $diahoy'>$array[day]</td>";
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


