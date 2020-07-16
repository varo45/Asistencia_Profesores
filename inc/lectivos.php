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
                if($response = $class->updateDateLoop($_POST['inicio'], $_POST['fin']))
                {
    
                }
                else
                {
                    $ERR_MSG = $class->ERR_NETASYS;
                }
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
<h2>Calendario escolar</h2>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
  <label for="lectivas">Fechas Lectivas</label>
    <input id="datepicker_ini" type="text" name="inicio">
    <input id="datepicker_fin" type="text" name="fin">
    <input type="submit" name="enviar" value="Insertar">
</form>
</div>
<?php
if($response = $class->selectFrom("SELECT * FROM $class->lectivos"))
{
    if($response->num_rows > 0)
    {
        echo <<<EOL
        <div class="container" style="margin-top:50px">
        <form action="$_SERVER[REQUEST_URI]" method="POST">
          <label for="lectivas">Festivos</label>
            <input id="datepicker_ini_fest" type="text" name="inicio">
            <input id="datepicker_fin_fest" type="text" name="fin">
            <input type="submit" name="enviar" value="Festivos" onclick='return confirm(\"¿Desea añadir esta fecha como festivo?\")'>
        </form>
        </div>
EOL;        
    }
}
else
{
    $ERR_MSG = $class->ERR_NETASYS;
}
?>