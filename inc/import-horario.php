<h2>Importar Horarios desde CSV</h2>
<?php
    if (isset($_POST["import"]))
    {
        require_once($dirs['inc'] . 'import-mysql-horario.php');
        require_once($dirs['inc'] . 'actualiza_horas.php');
    }
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
    <div class="row">
        <div class="col-xs-12">
            <div id="loading" style='text-align: center; position: absolute; width: 100%; height: 100%;'>
                <img style="text-align: center; background-color: transparent;" src="resources/img/loading.gif" alt="Cargando...">
                <h2 id="loading-msg"></h2>
            </div>
        </div>
    </div>
</div>
<?php
    include_once($dirs['public'] . 'js/import-horario.js');