<?php

if($response = $class->query("SELECT Horarios.*, Profesores.Nombre, Profesores.Iniciales, Diasemana.Diasemana FROM
(Horarios INNER JOIN Profesores ON Horarios.ID_PROFESOR=Profesores.ID) INNER JOIN Diasemana ON Diasemana.ID=Horarios.Dia
ORDER BY ID_PROFESOR, Dia, HORA_TIPO"))
{
    //echo "<h2>Registros de Horarios</h2>"; 
    if ($response->num_rows > 0) 
    {
        $ff = "tmp/";
        $fn = "Listado_Horarios.csv";
        chdir($ff);
        if(is_file($fn))
        {
            unlink($fn);
        }
        $fp = fopen($fn, 'w');
        $delimitador = ";";
        $titulo = [
            'ID',
            'CURSO',
            'ABREVIATURA PROFESOR',
            'PROFESOR',
            'AULA',
            'DIA SEMANA',
            'HORA',
        ];
        // Escribimos los títulos para los campos
        fputcsv($fp, $titulo, $delimitador);
        while($datos = $response->fetch_assoc()) 
        {
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
            $campos = [
                        $datos['ID'],
                        $datos['Grupo'],
                        $iniciales,
                        $profesor,
                        $datos['Aula'],
                        $datos['Diasemana'],
                        $datos['HORA_TIPO'],
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