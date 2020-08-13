<div class="container-fluid" style="margin-top:50px">
</div>
<?php
echo "<h2>¿Seguro que quiere dar de baja al profesor del centro?</h2>";
echo "<i>* Utilice solo esta opción si el profesor deja el centro por motivos de jubilación, fin de una sustitución o similares.</i><br>";
echo "<a href='index.php?ACTION=desactivar-profesor&ID=$_GET[ID]'><input type='submit' value='desactivar'></a> ";
echo "<a href='index.php?ACTION=profesores'><input type='submit' value='Volver atrás'></a>";
?>