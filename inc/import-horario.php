<h2>Importar Horarios desde CSV</h2>
<?php
require_once($dirs['inc'] . 'import-mysql-horario.php');
?>
<div id="response"
    class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
    <?php if(!empty($message)) { echo $message; } ?>
    </div>
<div class="outer-scontainer">
    <div class="row">
        <form class="form-horizontal" action="" method="post"
            name="frmCSVImport" id="frmCSVImport"
            enctype="multipart/form-data">
            <div class="input-row">
            <?php
            if($response = $class->selectFrom("SELECT ID FROM $class->horarios"))
            {
                if($response->num_rows > 0)
                {
                    $fecha = date('Y-m-d');
                    echo '
                    <label id="import-manual-trigger">Subir documento CSV:
                            <input type="file" name="file" id="file" accept=".csv" class="btn btn-link" style="display: inline-block;">
                            <input type="text" class="hidden" name="fecha" value="' . $fecha . '">
                    </label>
                    ';
                }
                else
                {
                    echo '
                    <label id="import-manual-trigger">Subir documento CSV:
                            <input type="file" name="file" id="file" accept=".csv" class="btn btn-link">
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
        $sql = "SELECT Horarios.*, Profesores.Nombre, Profesores.Iniciales, Diasemana.Diasemana FROM (Horarios INNER JOIN Profesores ON Horarios.ID_PROFESOR=Profesores.ID) INNER JOIN Diasemana ON Diasemana.ID=Horarios.Dia ORDER BY ID_PROFESOR, Dia, HORA_TIPO";
        $result = $class->selectFrom($sql);
        if (! empty($result)) {
            ?>
        <table id='userTable' class='table'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Curso</th>
                <th>Abreviatura profesor</th>
                <th>Profesor</th>
                <th>Aula</th>
                <th>Diasemana</th>
                <th>Hora</th>

            </tr>
        </thead>
<?php
            
            foreach ($result as $row) {
                ?>
                
            <tbody>
            <tr>
                <td><?php  echo $row['ID']; ?></td>
                <td><?php  echo $row['Grupo']; ?></td>
                <td><?php  echo $row['Iniciales']; ?></td>
                <td><?php  echo $row['Nombre']; ?></td>
                <td><?php  echo $row['Aula']; ?></td>
                <td><?php  echo $row['Diasemana']; ?></td>
                <td><?php  echo $row['HORA_TIPO']; ?></td>
            </tr>
                <?php
            }
            ?>
            </tbody>
    </table>
    <?php } ?>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

	    $("#response").attr("class", "");
        $("#response").html("");
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