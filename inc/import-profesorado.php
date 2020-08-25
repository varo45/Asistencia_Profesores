<h2>Importar Profesores desde CSV</h2>
<?php
require_once($dirs['inc'] . 'import-mysql-profesorado.php');
?>
<div id="response"
    class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
    <?php if(!empty($message)) { echo $message; } ?>
</div>
<div class="outer-scontainer">
    <form class="form-horizontal" action="" method="post"
        name="frmCSVImport" id="frmCSVImport"
        enctype="multipart/form-data">
        <div class="input-row">
            <label id="import-manual-trigger">Subir documento CSV:</label><br />
            <input type="file" name="file" id="file" accept=".csv" class="btn btn-link">
            <button type="submit" id="submit" name="import" class="btn btn-success">Importar</button>
            <br />
        </div>
    </form>
<?php
    if(! $num_profesores_act = $class->query("SELECT count(DISTINCT ID) as activos FROM $class->profesores WHERE Activo=1"))
    {
        $ERR_MSG = $class->ERR_NETASYS;
    }
    $num_act = $num_profesores_act->fetch_assoc();
    
    if(! $num_profesores_all = $class->query("SELECT count(ID) as total FROM $class->profesores"))
    {
        $ERR_MSG = $class->ERR_NETASYS;
    }
    $num_all = $num_profesores_all->fetch_assoc();
    echo "<h3>Profesores totales: $num_all[total]</h3>";
    echo "<h3>Profesores activos: $num_act[activos]</h3>";
    echo "<a id='btn-todos-registros-prof' class='btn btn-info'>Ver todos los registros</a>";
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
    include_once($dirs['public'] . 'js/import-profesorado.js');