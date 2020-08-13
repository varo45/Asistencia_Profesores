<?php

// Preparamos directorio tmp, borrando fichero si existe
$ff = "tmp/";
$fn = "Listado_Asistencias.csv";
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
if(! $response = $class->query("SELECT ID_PROFESOR FROM Marcajes WHERE Asiste=1 OR Asiste=2"))
{
    die($class->ERR_NETASYS);
}
$page_size = 15000;
$total_records = $response->num_rows;
$count=ceil($total_records/$page_size);

for($i=0; $i<=$count; $i++) {
$offset_var = $i * $page_size;
$query = "SELECT Marcajes.*, Nombre, Iniciales, Diasemana.Diasemana  FROM (Marcajes INNER JOIN Profesores ON Marcajes.ID_PROFESOR=Profesores.ID) INNER JOIN Diasemana ON Marcajes.Dia=Diasemana.ID WHERE Asiste=1 OR Asiste=2 ORDER BY Profesores.Nombre ASC LIMIT $page_size OFFSET $offset_var"; # "select id from shipment Limit ".$page_size." OFFSET ".$offset_var;
$result =  $class->query($query);

    while ($datos = $result->fetch_assoc())
    {
        $sep = preg_split('/[ -]/', $datos['Fecha']);
        $dia = $sep[2];
        $m = $sep[1];
        $Y = $sep[0];

        if($datos['Asiste'] == 2)
        {
            $extra = "SI";
        }
        else
        {
            $extra = '';
        }

        $campos = [
            $datos['Iniciales'],
            $datos['Nombre'],
            "$dia/$m/$Y",
            $datos['Hora'],
            $datos['Dia'],
            $datos['Diasemana'],
            'SI',
            $extra
        ];

        // Escibimos una línea por cada $datos
        fputcsv($fp, $campos, $delimitador);

    }
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
exit;