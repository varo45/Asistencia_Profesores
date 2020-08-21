<?php
if(isset($_GET['act']))
{
    if($_GET['act'] == 'add' && isset($_GET['ID']) && isset($_GET['Dia']) && isset($_GET['Hora']))
    {
        if($res = $class->query("SELECT Inicio, Fin FROM Horas WHERE Hora='$_GET[Hora]'")->fetch_assoc())
        {
            if($class->query("INSERT
                INTO $class->horarios (ID_PROFESOR, Dia, HORA_TIPO, Aula, Grupo, Hora_entrada, Hora_salida) 
                VALUES ('$_GET[ID]', '$_GET[Dia]', '$_GET[Hora]', 'Selec.', 'Selec.', '$res[Inicio]', '$res[Fin]')"))
            {
              $color = 'green';
              $MSG = 'Añadido correctamente.';
            }
            else
            {
              $color = 'red';
              $MSG = $class->ERR_NETASYS;
            }
        }
        else
        {
          $color = 'red';
          $MSG = $class->ERR_NETASYS;
        }
    }
    elseif($_GET['act'] == 'del' && isset($_GET['ID']))
    {
        if($res = $class->query("DELETE FROM $class->horarios WHERE ID='$_GET[ID]'"))
        {
          $color = 'green';
          $MSG = 'Borrado correctamente.';
        }
        else
        {
          $color = 'red';
          $MSG = $class->ERR_NETASYS;
        }
    }
    elseif($_GET['act'] == 'del_hora' && isset($_GET['ID_PROFESOR']) && isset($_GET['Dia']) && isset($_GET['Hora']))
    {
        if($res = $class->query("DELETE FROM $class->horarios WHERE ID_PROFESOR='$_GET[ID_PROFESOR]' AND HORA_TIPO='$_GET[Hora]' AND Dia='$_GET[Dia]'"))
        {
          $color = 'green';
          $MSG = 'Borrado correctamente.';
        }
        else
        {
          $color = 'red';
          $MSG = $class->ERR_NETASYS;
        }
    }
    elseif($_GET['act'] == 'add_more' && isset($_GET['ID']) && isset($_GET['Aula']) && isset($_GET['Dia']) && isset($_GET['Hora']))
    {
        if($res = $class->query("SELECT Inicio, Fin FROM Horas WHERE Hora='$_GET[Hora]'")->fetch_assoc())
        {
            if($class->query("INSERT
                INTO $class->horarios (ID_PROFESOR, Dia, HORA_TIPO, Aula, Grupo, Hora_entrada, Hora_salida) 
                VALUES ('$_GET[ID]', '$_GET[Dia]', '$_GET[Hora]', '$_GET[Aula]', 'Selec.', '$res[Inicio]', '$res[Fin]')"))
            {
              $color = 'green';
              $MSG = 'Añadido correctamente.';
            }
            else
            {
              $color = 'red';
              $MSG = $class->ERR_NETASYS;
            }
        }
        else
        {
          $color = 'red';
          $MSG = $class->ERR_NETASYS;
        }
    }
    else
    {
      $color = 'red';
      $MSG = 'Error Fatal!';
    }
}
else
{
  $color = 'red';
  $MSG = 'No puede realizar la acción.';
}
echo "
<script>
  $('#ERR_MSG_MODAL').modal('show')
</script>
";
echo '
<!-- Modal -->
<div class="modal fade" id="ERR_MSG_MODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p style="color: ' . $color . ';">
          ' . $MSG . '
        </p>
      </div>
    </div>
  </div>
</div>
';