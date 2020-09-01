<?php

// Preparamos directorio tmp, borrando fichero si existe
$ff = "tmp/";
$fn = "Listado_Marcajes.csv";
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

if(isset($_GET['profesor']) && $_GET['profesor'] != '')
{
    $sql = "SELECT ID_PROFESOR FROM Marcajes WHERE ID_PROFESOR = '$_GET[profesor]'";
}
else
{
    $sql = "SELECT ID_PROFESOR FROM Marcajes";
}
if(! $response = $class->query($sql))
{
    die($class->ERR_ASYSTECO);
}
$page_size = 15000;
$total_records = $response->num_rows;
$count=ceil($total_records/$page_size);

for($i=0; $i<=$count; $i++) {
$offset_var = $i * $page_size;
if(isset($_GET['profesor']) && $_GET['profesor'] != '')
{
    $query = "SELECT Marcajes.*, Nombre, Iniciales, Diasemana.Diasemana
            FROM (Marcajes INNER JOIN Profesores ON Marcajes.ID_PROFESOR=Profesores.ID)
                INNER JOIN Diasemana ON Marcajes.Dia=Diasemana.ID
            WHERE Profesores.Activo=1 AND  ID_PROFESOR = '$_GET[profesor]'
            ORDER BY Profesores.Nombre ASC LIMIT $page_size OFFSET $offset_var"; # "select id from shipment Limit ".$page_size." OFFSET ".$offset_var;
}
else
{
    $query = "SELECT Marcajes.*, Nombre, Iniciales, Diasemana.Diasemana
            FROM (Marcajes INNER JOIN Profesores ON Marcajes.ID_PROFESOR=Profesores.ID)
                INNER JOIN Diasemana ON Marcajes.Dia=Diasemana.ID
            WHERE Profesores.Activo=1
            ORDER BY Profesores.Nombre ASC LIMIT $page_size OFFSET $offset_var"; # "select id from shipment Limit ".$page_size." OFFSET ".$offset_var;
}
$result =  $class->query($query);

    while ($datos = $result->fetch_assoc())
    {
        $sep = preg_split('/[ -]/', $datos['Fecha']);
        $dia = $sep[2];
        $m = $sep[1];
        $Y = $sep[0];

        if($datos['Asiste'] == 0)
        {
            $asist = "NO";
            $extra = "NO";
        }
        elseif($datos['Asiste'] == 1)
        {
            $asist = "SI";
            $extra = "NO";
        }
        elseif($datos['Asiste'] == 2)
        {
            $asist = "SI";
            $extra = "SI";
        }

        $campos = [
            $datos['Iniciales'],
            $datos['Nombre'],
            "$dia/$m/$Y",
            $datos['Hora'],
            $datos['Dia'],
            $datos['Diasemana'],
            $asist,
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