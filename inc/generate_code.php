<?php 
if(isset($_POST) && !empty($_POST)) {
    include('phpqrcode/qrlib.php');
    $codesDir = "tmp/";   
    $codeFile = uniqid().'.png';
    QRcode::png($_POST['formData'], '../public/'.$codesDir.$codeFile, $_POST['ecc'], $_POST['size']); 
    echo '<img class="img-thumbnail" src="'.$codesDir.$codeFile.'" />';
} 
else {
    header('location:./');
}

?>