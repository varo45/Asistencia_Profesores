<?php
if(isset($_GET['act']))
{
  var_dump($_GET);
    if($_GET['act'] == 'add' && isset($_GET['ID']) && isset($_GET['Dia']) && isset($_GET['Hora']) && isset($_GET['Fecha']))
    {
        if($res = $class->query("SELECT Inicio, Fin FROM Horas WHERE Hora='$_GET[Hora]'")->fetch_assoc())
        {
          $Edificio = 0;
          if (isset($_GET['Aula'])) {
              $sed = preg_split('//', $_GET['Aula'], -1, PREG_SPLIT_NO_EMPTY);
              $Edificio = mysqli_real_escape_string($class->conex, utf8_encode($sed[2]));
              preg_match('/^[0-9]$/', $Edificio) ? $Edificio = $Edificio : $Edificio=0;
          }
            if($class->query("INSERT
                INTO T_horarios (ID_PROFESOR, Dia, HORA_TIPO, Edificio, Aula, Grupo, Hora_entrada, Hora_salida, Fecha_incorpora) 
                VALUES ('$_GET[ID]', '$_GET[Dia]', '$_GET[Hora]', '$Edificio', 'Selec.', 'Selec.', '$res[Inicio]', '$res[Fin]', '$_GET[Fecha]')"))
            {
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
                        <p style="color: green;">
                          Añadido correctamente.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                ';
            }
            else
            {
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
                        <p style="color: red;">
                          ' . $class->ERR_NETASYS . '
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                ';
            }
        }
        else
        {
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
                    <p style="color: red;">
                      ' . $class->ERR_NETASYS . '
                    </p>
                  </div>
                </div>
              </div>
            </div>
            ';
        }
    }
    elseif($_GET['act'] == 'del' && isset($_GET['ID']))
    {
        if($res = $class->query("DELETE FROM T_horarios WHERE ID='$_GET[ID]'"))
        {
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
                    <p style="color: green;">
                      Borrado correctamente.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            ';
        }
        else
        {
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
                    <p style="color: red;">
                      ' . $class->ERR_NETASYS . '
                    </p>
                  </div>
                </div>
              </div>
            </div>
            ';
        }
    }
    elseif($_GET['act'] == 'del_hora' && isset($_GET['ID_PROFESOR']) && isset($_GET['Dia']) && isset($_GET['Hora']) && isset($_GET['Fecha']))
    {
        if($res = $class->query("DELETE FROM T_horarios WHERE ID_PROFESOR='$_GET[ID_PROFESOR]' AND Fecha_incorpora='$_GET[Fecha]' AND HORA_TIPO='$_GET[Hora]' AND Dia='$_GET[Dia]'"))
        {
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
                    <p style="color: green;">
                      Borrado correctamente.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            ';
        }
        else
        {
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
                    <p style="color: red;">
                      ' . $class->ERR_NETASYS . '
                    </p>
                  </div>
                </div>
              </div>
            </div>
            ';
        }
    }
    elseif($_GET['act'] == 'add_more' && isset($_GET['ID']) && isset($_GET['Aula']) && isset($_GET['Dia']) && isset($_GET['Hora']) && isset($_GET['Fecha']))
    {
      $Edificio = "";
      if (isset($_GET['Aula'])) {
          $sed = preg_split('//', $_GET['Aula'], -1, PREG_SPLIT_NO_EMPTY);
          $Edificio = mysqli_real_escape_string($class->conex, utf8_encode($sed[2]));
          preg_match('/^[0-9]$/', $Edificio) ? $Edificio = $Edificio : $Edificio=0;
      }
      if($class->query("INSERT
          INTO T_horarios (ID_PROFESOR, Dia, HORA_TIPO, Edificio, Aula, Grupo, Hora_entrada, Hora_salida, Fecha_incorpora) 
          VALUES ('$_GET[ID]', '$_GET[Dia]', '$_GET[Hora]', '$Edificio', '$_GET[Aula]', 'Selec.', '00:00:00', '00:00:00', '$_GET[Fecha]')"))
      {
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
                  <p style="color: green;">
                    Añadido correctamente.
                  </p>
                </div>
              </div>
            </div>
          </div>
          ';
      }
      else
      {
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
                  <p style="color: red;">
                    ' . $class->ERR_NETASYS . '
                  </p>
                </div>
              </div>
            </div>
          </div>
          ';
      }
    }
    else
    {
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
                <p style="color: red;">
                Error Fatal!
                </p>
              </div>
            </div>
          </div>
        </div>
        ';
    }
}
else
{
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
            <p style="color: red;">
            No puede realizar la acción.
            </p>
          </div>
        </div>
      </div>
    </div>
    ';
}