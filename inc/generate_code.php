<?php

include_once($dirs['inc'] . 'mcript.php');
if(isset($_SESSION['ID']) && ! empty($_SESSION['ID']))
{
    if($response = $class->query("SELECT Iniciales, Password FROM $class->profesores WHERE ID='$_SESSION[ID]'"))
    {
        $datos = $response->fetch_assoc();
        include_once($dirs['inc'] . 'phpqrcode/qrlib.php');
        $codesDir = "tmp/";   
        $codeFile = uniqid().'.png';
        echo '
        <div class="container" style="margin-top:50px">
            <div class="row" style="text-align: center;">
                <div class="col-xs-12">
                <h3>Código de fichaje</h3>
        ';
                    $dato = $datos['Iniciales'] . ';' . $datos['Password'];
                    $dato_encriptado = $encriptar($dato);
                    QRcode::png($dato_encriptado, $codesDir.$codeFile, 'H', '10'); 
                    echo '<img class="img-thumbnail" src="'.$codesDir.$codeFile.'" />';
                    
                    // Imagen QR generada por Google justo debajo 
                    //          UTILIZAR EN CASO DE FALLO DE MÓDULO phpqrcode/qrlib.php
                    // echo '<img class="img-thumbnail" src="https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=' . urlencode($dato_encriptado) . '&choe=UTF-8" title="Código QR" />';
                    echo "<br><br><span>* Acerque el código al lector QR para fichar.</span>";
                    echo "<div id='clean_tmp' class='hidden'></div>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
        include_once($dirs['public'] . 'js/clean_tmp.js');
    }
    else
    {
        $ERR_MSG = $class->ERR_NETASYS;
    }
} 
else {
    echo $class->ERR_NETASYS;
}