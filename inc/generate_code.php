<?php 
if(isset($_SESSION['ID']) && ! empty($_SESSION['ID']))
{
    if($response = $class->selectFrom("SELECT Iniciales, Password FROM $class->profesores WHERE ID='$_SESSION[ID]'"))
    {
        $files = glob('tmp/*');
        foreach($files as $file)
        {
            if(is_file($file))
            {
                unlink($file);
            }
        }
        $datos = $response->fetch_assoc();
        include_once($dirs['inc'] . 'phpqrcode/qrlib.php');
        $codesDir = "tmp/";   
        $codeFile = uniqid().'.png';
        echo '
        <div class="container" style="margin-top:50px">
            <div class="row">
                <div class="col-xs-12">
                <h3>Código de identificación</h3>
        ';
        QRcode::png($datos['Iniciales'].';'.$datos['Password'], $codesDir.$codeFile, 'H', '10'); 
        echo '<img class="img-thumbnail" src="'.$codesDir.$codeFile.'" />';
                echo "</div>";
            echo "</div>";
        echo "</div>";
    }
    else
    {
        $ERR_MSG = $class->ERR_NETASYS;
    }
} 
else {
    echo $class->ERR_NETASYS;
}

?>