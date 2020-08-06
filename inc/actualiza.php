<?php
$id=$_GET["id"];
$columna=$_GET["columna"];
$texto=$_GET["texto"];
var_dump($id);
var_dump($columna);
var_dump($texto);
if($columna === 'aula')
{
    if(preg_match('/^[0-9]{1,3}$/', $texto))
    {
        $sql="UPDATE $class->horarios SET Aula='$aula' WHERE id='$id'";
        echo $sql;
    }
    else
    {
        $MSG = "El aula solo puede contener dígitos (máximo 3)";
    }
    
}
else
{
    $sql="UPDATE $class->horarios SET $columna='$texto' WHERE id='$id'";
}
// var_dump($sql);
if(isset($sql) && $sql != '')
{
    if($class->query($sql))
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
                  Actualizado correctamente.
                </p>
              </div>
            </div>
          </div>
        </div>
        ';
    }
    else
    {
        echo $class->ERR_NETASYS;
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
              ' . $MSG . '
            </p>
          </div>
        </div>
      </div>
    </div>
';
}
?>