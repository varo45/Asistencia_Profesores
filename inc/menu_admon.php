<div class="container" id="botonera" style="margin-top:75px">
    <div class="row"> 
        <div class="col-xs-12">
            <a enlace="index.php?ACTION=admon_select&export=asistencias" class="btn btn-info btn-export"><span class="glyphicon glyphicon-open"></span> Exportar listados Asistencias</a>
            <a enlace="index.php?ACTION=admon_select&export=faltas" class="btn btn-info btn-export"><span class="glyphicon glyphicon-open"></span> Exportar listados Faltas</a>
            <a enlace="index.php?ACTION=admon_select&export=horarios" class="btn btn-info btn-export"><span class="glyphicon glyphicon-open"></span> Exportar listados Horarios</a>
            </br></br>
            <a enlace="index.php?ACTION=admon_select&select=asistencias&pag=0" class="btn btn-success btn-select"><span class="glyphicon glyphicon-eye-open"></span> Mostrar listados Asistencias</a>
            <a enlace="index.php?ACTION=admon_select&select=faltas&pag=0" class="btn btn-success btn-select"><span class="glyphicon glyphicon-eye-open"></span> Mostrar listados Faltas</a>
            <a enlace="index.php?ACTION=admon_select&select=horarios&pag=0" class="btn btn-success btn-select"><span class="glyphicon glyphicon-eye-open"></span> Mostrar listados Horarios</a>
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