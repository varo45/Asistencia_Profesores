<?php
if(isset($_GET['act']))
{
    if($_GET['act'] == 'add' && isset($_GET['ID']) && isset($_GET['Dia']) && isset($_GET['Hora']) && isset($_GET['Fecha']))
    {
        if($res = $class->query("SELECT Inicio, Fin FROM Horas WHERE Hora='$_GET[Hora]'")->fetch_assoc())
        {
            if($class->query("INSERT
                INTO T_horarios (ID_PROFESOR, Dia, HORA_TIPO, Aula, Grupo, Hora_entrada, Hora_salida, Fecha_incorpora) 
                VALUES ('$_GET[ID]', '$_GET[Dia]', '$_GET[Hora]', 'Selec.', 'Selec.', '$res[Inicio]', '$res[Fin]', '$_GET[Fecha]')"))
            {
                echo "
                <script>
                  $('#OK_MODAL').modal('show')
                </script>
                ";
            }
            else
            {
                echo "
                <script>
                  $('#BAD_MODAL').modal('show')
                </script>
                ";
            }
        }
        else
        {
          echo "
          <script>
            $('#BAD_MODAL').modal('show')
          </script>
          ";
        }
    }
    elseif($_GET['act'] == 'del' && isset($_GET['ID']))
    {
        if($res = $class->query("DELETE FROM T_horarios WHERE ID='$_GET[ID]'"))
        {
          echo "
          <script>
            $('#OK_MODAL').modal('show')
          </script>
          ";
        }
        else
        {
          echo "
          <script>
            $('#BAD_MODAL').modal('show')
          </script>
          ";
        }
    }
    elseif($_GET['act'] == 'del_hora' && isset($_GET['ID_PROFESOR']) && isset($_GET['Dia']) && isset($_GET['Hora']) && isset($_GET['Fecha']))
    {
        if($res = $class->query("DELETE FROM T_horarios WHERE ID_PROFESOR='$_GET[ID_PROFESOR]' AND Fecha_incorpora='$_GET[Fecha]' AND HORA_TIPO='$_GET[Hora]' AND Dia='$_GET[Dia]'"))
        {
          echo "
          <script>
            $('#OK_MODAL').modal('show')
          </script>
          ";
        }
        else
        {
          echo "
          <script>
            $('#BAD_MODAL').modal('show')
          </script>
          ";
        }
    }
    elseif($_GET['act'] == 'add_more' && isset($_GET['ID']) && isset($_GET['Aula']) && isset($_GET['Dia']) && isset($_GET['Hora']) && isset($_GET['Fecha']))
    {
        if($res = $class->query("SELECT Inicio, Fin FROM Horas WHERE Hora='$_GET[Hora]'")->fetch_assoc())
        {
            if($class->query("INSERT
                INTO T_horarios (ID_PROFESOR, Dia, HORA_TIPO, Aula, Grupo, Hora_entrada, Hora_salida, Fecha_incorpora) 
                VALUES ('$_GET[ID]', '$_GET[Dia]', '$_GET[Hora]', '$_GET[Aula]', 'Selec.', '$res[Inicio]', '$res[Fin]', '$_GET[Fecha]')"))
            {
              echo "
              <script>
                $('#OK_MODAL').modal('show')
              </script>
              ";
            }
            else
            {
              echo "
              <script>
                $('#BAD_MODAL').modal('show')
              </script>
              ";
            }
        }
        else
        {
          echo "
          <script>
            $('#BAD_MODAL').modal('show')
          </script>
          ";
        }
    }
    else
    {
      echo "
      <script>
        $('#BAD_MODAL').modal('show')
      </script>
      ";
    }
}
else
{
  echo "
  <script>
    $('#BAD_MODAL').modal('show')
  </script>
  ";
}