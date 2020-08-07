<?php
$id=$_GET["id"];
$columna=$_GET["columna"];
$texto=$_GET["texto"];
if($columna === 'Aula' || $columna === 'Grupo')
{
  $sql="UPDATE $class->horarios SET $columna='$texto' WHERE id='$id'";
  if(! $class->query($sql))
  {
    $ERR_MSG = $class->ERR_NETASYS;
  }
}
else
{
    $sql="";
}
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
?>