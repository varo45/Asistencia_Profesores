<?php
if(isset($_POST['enviar']) && $_POST['enviar'] == 'Insertar')
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
    if($response = $class->dateLoop($_POST['inicio'], $_POST['fin']))
    {

    }
    else
    {
        echo $ERR_MSG = $class->ERR_NETASYS;
    }
}
if(isset($_POST['enviar']) && $_POST['enviar'] == 'Festivos')
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
        echo $ERR_MSG = $class->ERR_NETASYS;
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
<div class="container" style="margin-top:50px">
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
  <label for="lectivas">Festivos</label>
    <input id="datepicker_ini_fest" type="text" name="inicio">
    <input id="datepicker_fin_fest" type="text" name="fin">
    <input type="submit" name="enviar" value="Festivos">
</form>
</div>