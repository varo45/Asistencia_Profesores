<?php
echo "<h2>Crear horario</h2>";
echo "</br><table class='table'>";
echo "<thead>";
    echo "<tr>";
        echo "<th>Horas</th>";
        echo "<th>Lunes</th>";
        echo "<th>Martes</th>";
        echo "<th>Miercoles</th>";
        echo "<th>Jueves</th>";
        echo "<th>Viernes</th>";
        echo "</tr>";
echo "</thead>";
echo "<tbody>";
    for ($i = 0; $i < 6; $i++)
    {
        $dia = $class->getDate();
        $count=$i+1;
        $horas = $count . 'M';
        echo "<form action='$_SERVER[PHP_SELF]' method='POST'>";
        echo "<tr>";
            echo "<td>" . $count . "</td>";
            echo "<td id='lunes_$horas'>
                <select class='form-control sel' style='width: max-content;'>
                    <option op='1' value='libre'>Libre</option>
                    <option op='1' value='clase'>Clase</option>
                    <option op='1' value='guardia'>Guardia</option>
                </select>
                <div class='clase'>
                    Aula: <!--input type='text' name='aula' class='form-control' maxlength='3' size='3'-->";
                    if($response = $class->selectFrom("SELECT distinct Aula FROM $class->horarios WHERE Aula IS NOT NULL ORDER BY Aula"))
                        {
                            echo "<select>";
                            while($fila = $response->fetch_assoc())
                            {
                                    echo "<option name='Aula' value='$fila[Aula]'>$fila[Aula]</option>";
                            }
                            echo "</select>";
                        }
                        else
                        {
                            echo $class->ERR_NETASYS;
                        }
                    echo "
                    <br />
                    Grupo: <!--input type='text' name='grupo' class='form-control' maxlength='14' size='3'-->";
                    if($response = $class->selectFrom("SELECT distinct Grupo FROM $class->horarios WHERE Aula IS NOT NULL ORDER BY Grupo"))
                        {
                            echo "<select>";
                            while($fila = $response->fetch_assoc())
                            {
                                    echo "<option name='Grupo' value='$fila[Grupo]'>$fila[Grupo]</option>";
                            }
                            echo "</select>";
                        }
                        else
                        {
                            echo $class->ERR_NETASYS;
                        }
                    echo "
                </div>
                <div class='guardia'>
                    <input type='text' name='grupo' value='guardia' class='hidden' ><h4>Guardia</h4>
                </div>
            </td>";
            echo "<td id='martes_$horas'>
                <select class='form-control sel' style='width: max-content;'>
                    <option op='1' value='libre'>Libre</option>
                    <option op='1' value='clase'>Clase</option>
                    <option op='1' value='guardia'>Guardia</option>
                </select>
                <div class='clase'>
                    Aula: <!--input type='text' name='aula' class='form-control' maxlength='3' size='3'-->";
                    if($response = $class->selectFrom("SELECT distinct Aula FROM $class->horarios WHERE Aula IS NOT NULL ORDER BY Aula"))
                        {
                            echo "<select>";
                            while($fila = $response->fetch_assoc())
                            {
                                    echo "<option name='Aula' value='$fila[Aula]'>$fila[Aula]</option>";
                            }
                            echo "</select>";
                        }
                        else
                        {
                            echo $class->ERR_NETASYS;
                        }
                    echo "
                    <br />
                    Grupo: <!--input type='text' name='grupo' class='form-control' maxlength='14' size='3'-->";
                    if($response = $class->selectFrom("SELECT distinct Grupo FROM $class->horarios WHERE Aula IS NOT NULL ORDER BY Grupo"))
                        {
                            echo "<select>";
                            while($fila = $response->fetch_assoc())
                            {
                                    echo "<option name='Grupo' value='$fila[Grupo]'>$fila[Grupo]</option>";
                            }
                            echo "</select>";
                        }
                        else
                        {
                            echo $class->ERR_NETASYS;
                        }
                    echo "
                </div>
                <div class='guardia'>
                    <input type='text' name='grupo' value='guardia' class='hidden' ><h4>Guardia</h4>
                </div>
            </td>";
            echo "<td id='miercoles_$horas'>
                <select class='form-control sel' style='width: max-content;'>
                    <option op='1' value='libre'>Libre</option>
                    <option op='1' value='clase'>Clase</option>
                    <option op='1' value='guardia'>Guardia</option>
                </select>
                <div class='clase'>
                    Aula: <!--input type='text' name='aula' class='form-control' maxlength='3' size='3'-->";
                    if($response = $class->selectFrom("SELECT distinct Aula FROM $class->horarios WHERE Aula IS NOT NULL ORDER BY Aula"))
                        {
                            echo "<select>";
                            while($fila = $response->fetch_assoc())
                            {
                                    echo "<option name='Aula' value='$fila[Aula]'>$fila[Aula]</option>";
                            }
                            echo "</select>";
                        }
                        else
                        {
                            echo $class->ERR_NETASYS;
                        }
                    echo "
                    <br />
                    Grupo: <!--input type='text' name='grupo' class='form-control' maxlength='14' size='3'-->";
                    if($response = $class->selectFrom("SELECT distinct Grupo FROM $class->horarios WHERE Aula IS NOT NULL ORDER BY Grupo"))
                        {
                            echo "<select>";
                            while($fila = $response->fetch_assoc())
                            {
                                    echo "<option name='Grupo' value='$fila[Grupo]'>$fila[Grupo]</option>";
                            }
                            echo "</select>";
                        }
                        else
                        {
                            echo $class->ERR_NETASYS;
                        }
                    echo "
                </div>
                <div class='guardia'>
                    <input type='text' name='grupo' value='guardia' class='hidden' ><h4>Guardia</h4>
                </div>
            </td>";
            echo "<td id='jueves_$horas'>
                <select class='form-control sel' style='width: max-content;'>
                    <option op='1' value='libre'>Libre</option>
                    <option op='1' value='clase'>Clase</option>
                    <option op='1' value='guardia'>Guardia</option>
                </select>
                <div class='clase'>
                    Aula: <!--input type='text' name='aula' class='form-control' maxlength='3' size='3'-->";
                    if($response = $class->selectFrom("SELECT distinct Aula FROM $class->horarios WHERE Aula IS NOT NULL ORDER BY Aula"))
                        {
                            echo "<select>";
                            while($fila = $response->fetch_assoc())
                            {
                                    echo "<option name='Aula' value='$fila[Aula]'>$fila[Aula]</option>";
                            }
                            echo "</select>";
                        }
                        else
                        {
                            echo $class->ERR_NETASYS;
                        }
                    echo "
                    <br />
                    Grupo: <!--input type='text' name='grupo' class='form-control' maxlength='14' size='3'-->";
                    if($response = $class->selectFrom("SELECT distinct Grupo FROM $class->horarios WHERE Aula IS NOT NULL ORDER BY Grupo"))
                        {
                            echo "<select>";
                            while($fila = $response->fetch_assoc())
                            {
                                    echo "<option name='Grupo' value='$fila[Grupo]'>$fila[Grupo]</option>";
                            }
                            echo "</select>";
                        }
                        else
                        {
                            echo $class->ERR_NETASYS;
                        }
                    echo "
                </div>
                <div class='guardia'>
                    <input type='text' name='grupo' value='guardia' class='hidden' ><h4>Guardia</h4>
                </div>
            </td>";
            echo "<td id='viernes_$horas'>
                <select class='form-control sel' style='width: max-content;'>
                    <option op='1' value='libre'>Libre</option>
                    <option op='1' value='clase'>Clase</option>
                    <option op='1' value='guardia'>Guardia</option>
                </select>
                <div class='clase'>
                    Aula: <!--input type='text' name='aula' class='form-control' maxlength='3' size='3'-->";
                    if($response = $class->selectFrom("SELECT distinct Aula FROM $class->horarios WHERE Aula IS NOT NULL ORDER BY Aula"))
                        {
                            echo "<select>";
                            while($fila = $response->fetch_assoc())
                            {
                                    echo "<option name='Aula' value='$fila[Aula]'>$fila[Aula]</option>";
                            }
                            echo "</select>";
                        }
                        else
                        {
                            echo $class->ERR_NETASYS;
                        }
                    echo "
                    <br />
                    Grupo: <!--input type='text' name='grupo' class='form-control' maxlength='14' size='3'-->";
                    if($response = $class->selectFrom("SELECT distinct Grupo FROM $class->horarios WHERE Aula IS NOT NULL ORDER BY Grupo"))
                        {
                            echo "<select>";
                            while($fila = $response->fetch_assoc())
                            {
                                    echo "<option name='Grupo' value='$fila[Grupo]'>$fila[Grupo]</option>";
                            }
                            echo "</select>";
                        }
                        else
                        {
                            echo $class->ERR_NETASYS;
                        }
                    echo "
                </div>
                <div class='guardia'>
                    <input type='text' name='grupo' value='guardia' class='hidden' ><h4>Guardia</h4>
                </div>
            </td>";
        echo "</tr>";
        echo "</form>";
    }
echo "</tbody>";
echo "</table>";
include_once "js/crear-horario.js";
