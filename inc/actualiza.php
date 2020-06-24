<?php
$id=$_GET["id"];
$columna=$_GET["columna"];
$texto=$_GET["texto"];

if($columna === 'aula')
{
    if(preg_match('/^[0-9]{1,3}$/', $texto))
    {
        $txt=preg_split('//', $texto, -1, PREG_SPLIT_NO_EMPTY);
        $edificio=$txt[0];
        $aula=$txt[1].$txt[2];
        $sql="UPDATE $class->horarios SET Aula='$aula', Edificio='$edificio' WHERE id='$id'";
    }
    else
    {
        $sql = "";
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
    if($class->updateSet($sql))
    {
        echo <<< EOL
        <script>
          $('#ERR_MSG_MODAL').modal('show')
        </script>
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
      EOL;
    }
    else
    {
        echo $class->ERR_NETASYS;
    }
}
else
{
    echo <<< EOL
    <script>
      $('#ERR_MSG_MODAL').modal('show')
    </script>
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
              $MSG
            </p>
          </div>
        </div>
      </div>
    </div>
  EOL;
}
?>
