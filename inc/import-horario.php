<h2>Importar Horarios desde CSV</h2>
<?php
require_once($dirs['inc'] . 'import-mysql-horario.php');
?>
<div id="response"
    class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
    <?php if(!empty($message)) { echo $message; } ?>
    </div>
<div class="outer-container">
        <form class="form-horizontal" action="" method="post"
            name="frmCSVImport" id="frmCSVImport"
            enctype="multipart/form-data">
            <div class="input-row">
            <?php
            if($response = $class->query("SELECT ID FROM $class->horarios"))
            {
                if($response->num_rows > 0)
                {
                    $fecha = date('Y-m-d');
                    echo '
                    <label id="import-manual-trigger">Subir documento CSV:
                            <input type="file" name="file" id="file" accept=".csv" class="btn btn-link" style="display: inline-block;" required>
                            <input id="fecha_incorpora" type="text" class="form-control" name="fecha" placeholder="Fecha de incorporación de horarios" autocomplete="off">
                    </label>
                    ';
                }
                else
                {
                    echo '
                    <label id="import-manual-trigger">Subir documento CSV:
                            <input type="file" name="file" id="file" accept=".csv" class="btn btn-link" required>
                    </label>
                    ';
                }
            }
            else
            {
                $ERR_MSG = $class->ERR_NETASYS;
            }
            ?>
                <button type="submit" id="submit" name="import" class="btn btn-success">Importar</button>
                <br />
            </div>
        </form>
    </div>
            <?php
        if($num_horarios = $class->query("SELECT count(DISTINCT ID_PROFESOR) as numero, count(ID) as total FROM $class->horarios"))
        {
            $num = $num_horarios->fetch_assoc();
            echo "<h3>Horarios importados: $num[numero]</h3>";
            echo "<h3>Registros totales: $num[total]</h3>";
            echo "<a id='btn-todos-registros' class='btn btn-info'>Ver todos los registros</a>";
        }
        else
        {
            $ERR_MSG = $class->ERR_NETASYS;
        }
        ?>
        <div id="todos-registros"></div>
        <div id="loading">
        <img style="text-align: center;" src="resources/img/loading.gif" alt="Cargando...">
        <h2 id="loading-msg"></h2>
        </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {
        var fecha = $("#fecha_incorpora").val();
	    $("#response").attr("class", "");
        $("#response").html("");
        $("#userTable").remove("");
        $("#loading-msg").html("Importando horarios con fecha: "+fecha+" ...");
        $("#loading").show();
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Tipo de fichero no válido. Documento válido: <b>" + fileType + "</b>.");
            return false;
        }
        return true;
    });
});
</script>
<script>
$('#loading').hide();
$('#btn-todos-registros').on('click', function() {
    $("#todos-registros").html(""),
    $("#loading-msg").html("Cargando...");
    $("#loading").show(),
    $('#todos-registros').load('index.php?ACTION=muestra-registros-horarios'),
    $("#loading").delay().fadeOut()
});
</script>
<script type="text/javascript">
$(window).on('beforeunload', function(){
    return ;
});
</script>