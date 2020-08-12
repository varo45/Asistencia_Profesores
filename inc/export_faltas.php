<?php

if($response = $class->query("SELECT * FROM Marcajes WHERE Asiste=0 ORDER BY ID_PROFESOR ASC"))
{
    // echo "<h2>Listado Asistencias</h2>";
    if ($response->num_rows > 0)
    {
        $ff = "tmp/";
        $fn = "Listado_Faltas.csv";
        chdir($ff);
        if(is_file($fn))
        {
            unlink($fn);
        }
        
        $fp = fopen($fn, 'w');
        $delimitador = ";";
        $titulo = [
            'INICIALES',
            'PROFESOR',
            'FECHA',
            'HORA',
            'DIA',
            'DIA SEMANA',
            'ASISTENCIA',
            'ACTIVIDAD EXTRAESCOLAR'
        ];
        
        // Escribimos los títulos para los campos
        fputcsv($fp, $titulo, $delimitador);

        while($datos = $response->fetch_assoc())
        {
            // Mostramos el Nombre del profesor en vez de su ID 
            if($nombre = $class->query("SELECT Nombre, Iniciales FROM Profesores WHERE ID='$datos[ID_PROFESOR]'"))
            {
                $prof = $nombre->fetch_assoc();
                $profesor = $prof['Nombre'];
                $iniciales = $prof['Iniciales'];
            }
            else
            {
                $ERR_MSG = $class->ERR_NETASYS;
            }

            // Mostramos el Nombre del día de la semana 
            if($dsm = $class->query("SELECT Diasemana FROM Diasemana WHERE ID='$datos[Dia]'"))
            {
                $diasemana = $dsm->fetch_assoc();
                $diasemana = $diasemana['Diasemana'];
            }
            else
            {
                $ERR_MSG = $class->ERR_NETASYS;
            }

            if($datos['Asiste'] == 0)
            {
                $extra = "NO"; 
            }
            else
            {
                $extra = "SI";
            }
            $sep = preg_split('/[ -]/', $datos['Fecha']);
            $dia = $sep[2];
            $m = $sep[1];
            $Y = $sep[0];

            $campos = [
                $iniciales,
                $profesor,
                "$dia/$m/$Y",
                $datos['Hora'],
                $datos['Dia'],
                $diasemana,
                'NO',
                $extra
            ];

            // Escibimos una línea por cada $datos
            fputcsv($fp, $campos, $delimitador);
        }
        //cabeceras para descarga
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $fn . '";');
        
        ob_end_clean();

        readfile($fn);

        if(is_file($fn))
        {
            unlink($fn);
        }
    }
    exit;
}