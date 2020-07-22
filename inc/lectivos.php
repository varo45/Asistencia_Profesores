<?php
if(isset($_POST['enviar']))
{
    if($_POST['enviar'] == 'Insertar')
    {
        if(isset($_POST['inicio']) && isset($_POST['fin']) && $_POST['inicio'] != '' && $_POST['fin'] != '')
        {
            if(preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/", $_POST['inicio']) && preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/", $_POST['fin']))
            {
                $sep = preg_split('/\//', $_POST['inicio']);
                $sep2 = preg_split('/\//', $_POST['fin']);
                $dia = $sep[0];
                $m = $sep[1];
                $Y = $sep[2];
                $_POST['inicio'] = $Y . '-' . $m . '-' . $dia;
                $dia2 = $sep2[0];
                $m2 = $sep2[1];
                $Y2 = $sep2[2];
                $_POST['fin'] = $Y2 . '-' . $m2 . '-' . $dia2;
                if($respuesta = $class->selectFrom("SELECT $class->profesores.ID FROM $class->profesores"))
                {
                    if($respuesta->num_rows > 0)
                    {
                        if($respuesta2 = $class->selectFrom("SELECT $class->horarios.ID_PROFESOR FROM $class->horarios"))
                        {
                            if($respuesta2->num_rows > 0)
                            {
                                if($response = $class->dateLoop($_POST['inicio'], $_POST['fin']))
                                {
                                    $MSG = 'Datos insertados correctamente.';
                                    //header("Refresh: 0;  $_SERVER[REQUEST_URI]");
                                }
                                else
                                {
                                    $ERR_MSG = $class->ERR_NETASYS;
                                }
                            }
                            else
                            {
                                $ERR_MSG ="Debe registrar los horarios de cada profesor.";
                            }
                        }
                        else
                        {
                            $ERR_MSG = $class->ERR_NETASYS;
                        }
                    }
                    else
                    {
                        $ERR_MSG ="Debe registrar primero el listado de profesores.";
                    }
                }
                else
                {
                    $ERR_MSG = $class->ERR_NETASYS;
                }
            }
            else
            {
                $ERR_MSG = 'El formato de fecha es incorrecto.';
            }
        }
        else
        {
            $ERR_MSG = 'Indique una fecha de inicio y otra de fin de días lectivos.';
        }
    }
    elseif($_POST['enviar'] == 'Festivos')
    {
        if(isset($_POST['inicio']) && isset($_POST['fin']) && $_POST['inicio'] != '' && $_POST['fin'] != '')
        {
            if(preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/", $_POST['inicio']) && preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/", $_POST['fin']))
            {
                $inicio = $_POST['inicio'];
                $fin = $_POST['fin'];
                $sep = preg_split('/\//', $_POST['inicio']);
                $sep2 = preg_split('/\//', $_POST['fin']);
                $dia = $sep[0];
                $m = $sep[1];
                $Y = $sep[2];
                $_POST['inicio'] = $Y . '-' . $m . '-' . $dia;
                $dia2 = $sep2[0];
                $m2 = $sep2[1];
                $Y2 = $sep2[2];
                $_POST['fin'] = $Y2 . '-' . $m2 . '-' . $dia2;
                if($response2 = $class->updateDateLoop($_POST['inicio'], $_POST['fin']))
                {
                    $MSG = 'Fechas Festivas añadidas correctamente.';
                }
                else
                {
                    $ERR_MSG = $class->ERR_NETASYS;
                }
            }
            else
            {
                $ERR_MSG = 'El formato de fecha es incorrecto.';
            }
        }
        else
        {
            $ERR_MSG = 'Indique una fecha de inicio y otra de fin de días festivos.';
        }
    }
}
?>
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
            <input type="submit" name="enviar" value="Festivos">
        </form>
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


