<?php

if($response = $class->query("SELECT * FROM Marcajes WHERE Asiste=0 ORDER BY ID_PROFESOR ASC"))
{
    echo "<h2>Listado Faltas</h2>";
    echo"
        <table class='table table-striped'>
            <thead>
                <tr>
                    <th>ID PROFESOR</th>
                    <th>FECHA</th>
                    <th>HORA</th>
                    <th>DIA</th>
                    <th>ASISTENCIA</th>
                    <th>EXTRA</th>
                </tr>
            </thead>
            <tbody>
    ";
    if ($response->num_rows > 0)
    {
        while($datos = $response->fetch_assoc())
        {
            if($nombre = $class->query("SELECT Nombre FROM Profesores WHERE ID='$datos[ID_PROFESOR]'"))
            {
                $profesor = $nombre->fetch_assoc();
                $profesor = $profesor['Nombre'];
            }
            else
            {
                $ERR_MSG = $class->ERR_NETASYS;
            }
                if($nopresente = $class->query("SELECT Asiste FROM Marcajes WHERE Asiste=0"))
                {
                    $si = $nopresente->fetch_assoc();
                    $si = 'NO';
                }
                else
                {
                    $ERR_MSG = $class->ERR_NETASYS;
                }
            $sep = preg_split('/[ -]/', $datos['Fecha']);
            $dia = $sep[2];
            $m = $sep[1];
            $Y = $sep[0];
            echo "  
                <tr>
                    <td>$profesor</td>
                    <td>$dia/$m/$Y</td>
                    <td>$datos[Hora]</td>
                    <td>$datos[Dia]</td>
                    <td>$si</td>
                    <td>$datos[Extra]</td>
                </tr> 
            ";
        }
    }
    else
    {
        $ERR_MSG = $class->ERR_NETASYS;
    }
    echo "
                </tbody>
            </table>
    ";
}
else
{
    $ERR_MSG = $class->ERR_NETASYS;
}