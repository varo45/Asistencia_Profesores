<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {
	    $("#response").attr("class", "");
        $("#response").html("");
        $("#userTable").remove("");
        $("#loading-msg").html("Importando horarios...");
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
$(document).ready(function () {
    $('#loading').delay().fadeOut()
});
$('#btn-todos-registros').on('click', function() {
    $("#todos-registros").html(""),
    $("#loading-msg").html("Cargando..."),
    $("#loading").show(),
    $('#todos-registros').load('index.php?ACTION=horarios&OPT=registros'),
    $("#loading").delay().fadeOut()
});
$('#fecha_incorpora').keypress(function(e) {
    e.preventDefault();
});
</script>
<script type="text/javascript">
$(window).on('beforeunload', function(){
    return ;
});
</script>