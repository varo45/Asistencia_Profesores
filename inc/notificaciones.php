<?php
echo '<div class="container" id="botonera" style="margin-top:75px">';
    echo '<div class="row">'; 
        echo '<div class="col-xs-12">';
                $response = "SELECT Notificaciones.*, Profesores.Nombre, Profesores.Iniciales FROM Notificaciones INNER JOIN Profesores ON Notificaciones.ID_PROFESOR=Profesores.ID ORDER BY Fecha DESC LIMIT 50";

                $result = $class->query($response);
                if (! empty($result)) 
                {
                    echo "<h2>Registros de Notificaciones</h2>"; 
                    echo "<table id='userTable' class='table'>
                        <thead>
                            <tr>
                                <th>ID PROFESOR</th>
                                <th>INICIALES</th>
                                <th>NOMBRE</th>
                                <th>MODIFICACIÓN</th>
                                <th>FECHA</th>
                            </tr>
                        </thead>
                    ";
                    while($datos = $result->fetch_assoc()) 
                        {
                            if($datos['Visto'] == 0)
                            {
                                $visto = "UPDATE Notificaciones
                                SET Visto=1
                                WHERE ID='$datos[ID]'";
                                if(! $class->query($visto))
                                {
                                    $ERR_MSG = $class->ERR_NETASYS;
                                }
                            }
                        $sep = preg_split('/[ -]/', $datos['Fecha']);
                        $dia = $sep[2];
                        $m = $sep[1];
                        $Y = $sep[0];
                        $h = $sep[3];
                    echo "
                        <tbody>
                            <tr>
                                <td>$datos[ID_PROFESOR]</td>
                                <td>$datos[Iniciales]</td>
                                <td>$datos[Nombre]</td>
                                <td>$datos[Modificacion]</td>
                                <td>$dia/$m/$Y $h</td>
                            </tr>
                        ";
                        }
                }
                echo "
                    </tbody>
                </table>
                ";
        echo '</div>';
    echo '</div>';
echo '</div>';