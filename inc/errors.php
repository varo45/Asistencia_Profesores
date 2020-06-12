<?php
if(isset($ERR_MSG))
{
  echo <<< EOL
  <script>
  window.onload = function() {
    $('#ERR_MSG_MODAL').modal('show')
  };
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
            $ERR_MSG
          </p>
        </div>
      </div>
    </div>
  </div>
EOL;
}
?>