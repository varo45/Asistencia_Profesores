<h2>Importar Profesores desde CSV</h2>
<?php
require_once($dirs['inc'] . 'import-mysql-profesorado.php');
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
                <label id="import-manual-trigger">Subir documento CSV:
                    <input type="file" name="file" id="file" accept=".csv" class="btn btn-link">
                </label>
                <button type="submit" id="submit" name="import" class="btn btn-success">Importar</button>
                <br />

            </div>

        </form>

    </div>
            <?php
        $sql = "SELECT ID, Iniciales, Nombre, Tutor FROM Profesores ORDER BY Nombre, Iniciales";
        $result = $class->query($sql);
        if (! empty($result)) {
            ?>
        <table id='userTable' class='table'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Abreviatura</th>
                <th>Nombre</th>
                <th>Tutor</th>

            </tr>
        </thead>
<?php
            
            foreach ($result as $row) {
                ?>
                
            <tbody>
            <tr>
                <td><?php  echo $row['ID']; ?></td>
                <td><?php  echo $row['Iniciales']; ?></td>
                <td><?php  echo $row['Nombre']; ?></td>
                <td><?php  echo $row['Tutor']; ?></td>
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