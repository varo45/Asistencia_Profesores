<div class="container" id="botonera" style="margin-top:75px">
    <div class="row"> 
        <div class="col-xs-12">
            <h2>Exportar a Excel</h2>
            <a enlace="index.php?ACTION=admon_select&export=marcajes" class="btn btn-info btn-export"><span class="glyphicon glyphicon-open"></span> Marcajes</a>
            <a enlace="index.php?ACTION=admon_select&export=asistencias" class="btn btn-info btn-export"><span class="glyphicon glyphicon-open"></span> Asistencias</a>
            <a enlace="index.php?ACTION=admon_select&export=faltas" class="btn btn-info btn-export"><span class="glyphicon glyphicon-open"></span> Faltas</a>
            <a enlace="index.php?ACTION=admon_select&export=horarios" class="btn btn-info btn-export"><span class="glyphicon glyphicon-open"></span> Horarios</a>
            </br>
            <h2>Mostrar en Pantalla</h2>
            <a enlace="index.php?ACTION=admon_select&select=marcajes&pag=0" id='fechamarcajes' class="btn btn-success btn-select"><span class="glyphicon glyphicon-eye-open"></span> Marcajes</a> 
            <input id='fechainimarc' class='form-control' type='text' placeholder='Fecha Inicio'> <input id='fechafinmarc' class='form-control' type='text' placeholder='Fecha Fin'>
            <?php
                if($response = $class->query("SELECT ID, Nombre FROM $class->profesores WHERE TIPO <>1 ORDER BY Nombre"))
                {
                    if($response->num_rows > 0)
                    {
                        echo "<select id='select_admon_marcajes' name='Profesor' class='form-control'>";
                        echo "<option value=''> Selecciona un profesor... </option>";
                        while($fila = $response->fetch_assoc())
                        {
                            echo "<option value='$fila[ID]'> $fila[Nombre] </option>";
                        }
                        echo "</select>";
                    }
                }
                else
                {
                    $ERR_MSG = $class->ERR_NETASYS;
                }
            ?>
            <br/><br/>
            <a enlace="index.php?ACTION=admon_select&select=asistencias&pag=0" id='fechaasiste' class="btn btn-success btn-select"><span class="glyphicon glyphicon-eye-open"></span> Asistencias</a>
            <input id='fechainicioasis' class='form-control' type='text' placeholder='Fecha Inicio'> <input id='fechafinasis' class='form-control' type='text' placeholder='Fecha Fin'>
            <?php
                if($response = $class->query("SELECT ID, Nombre FROM $class->profesores WHERE TIPO <>1 ORDER BY Nombre"))
                {
                    if($response->num_rows > 0)
                    {
                        echo "<select id='select_admon_asistencias' name='Profesor' class='form-control'>";
                        echo "<option value=''> Selecciona un profesor... </option>";
                        while($fila = $response->fetch_assoc())
                        {
                            echo "<option value='$fila[ID]'> $fila[Nombre] </option>";
                        }
                        echo "</select>";
                    }
                }
                else
                {
                    $ERR_MSG = $class->ERR_NETASYS;
                }
            ?>
            <br><br>
            <a enlace="index.php?ACTION=admon_select&select=faltas&pag=0" id='fechafaltas' class="btn btn-success btn-select"><span class="glyphicon glyphicon-eye-open"></span> Faltas</a>
            <input id='fechainifaltas' class='form-control' type='text' placeholder='Fecha Inicio'> <input id='fechafinfaltas' class='form-control' type='text' placeholder='Fecha Fin'>
            <?php
                if($response = $class->query("SELECT ID, Nombre FROM $class->profesores WHERE TIPO <>1 ORDER BY Nombre"))
                {
                    if($response->num_rows > 0)
                    {
                        echo "<select id='select_admon_marcajes' name='Profesor' class='form-control'>";
                        echo "<option value=''> Selecciona un profesor... </option>";
                        while($fila = $response->fetch_assoc())
                        {
                            echo "<option value='$fila[ID]'> $fila[Nombre] </option>";
                        }
                        echo "</select>";
                    }
                }
                else
                {
                    $ERR_MSG = $class->ERR_NETASYS;
                }
            ?>
            <br><br>
            <a enlace="index.php?ACTION=admon_select&select=horarios&pag=0" id='fechahorarios' class="btn btn-success btn-select"><span class="glyphicon glyphicon-eye-open"></span> Horarios</a>
            <?php
                if($response = $class->query("SELECT ID, Nombre FROM $class->profesores WHERE TIPO <>1 ORDER BY Nombre"))
                {
                    if($response->num_rows > 0)
                    {
                        echo "<select id='select_admon_horarios' name='Profesor' class='form-control'>";
                        echo "<option value=''> Selecciona un profesor... </option>";
                        while($fila = $response->fetch_assoc())
                        {
                            echo "<option value='$fila[ID]'> $fila[Nombre] </option>";
                        }
                        echo "</select>";
                    }
                }
                else
                {
                    $ERR_MSG = $class->ERR_NETASYS;
                }
            ?>
            <br><br>
            <a enlace="index.php?ACTION=admon_select&select=fichadi&pag=0" class="btn btn-success btn-select"><span class="glyphicon glyphicon-calendar"></span> Fichajes de hoy</a><br><br>
            <a enlace="index.php?ACTION=admon_select&select=fichafe&pag=0" id='fechafichajes' class="btn btn-success btn-select"><span class="glyphicon glyphicon-calendar"></span> Fichaje Por Fechas</a> 
            <input id='fechainifichaje' class='form-control' type='text' placeholder='Fecha Inicio'> <input id='fechafinfichaje' class='form-control' type='text' placeholder='Fecha Fin'>
        </div>
        </br>
        <div class="col-xs-12">
            <div id="loading" style='text-align: center; position: absolute; width: 100%; height: 100%;'>
                <img style="text-align: center; background-color: transparent;" src="resources/img/loading.gif" alt="Cargando...">
                <h2 id="loading-msg"></h2>
            </div>
            <div id="btn-response"></div>
        </div>
    </div>
</div>