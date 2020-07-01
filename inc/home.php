<?php

$extras = <<< EOL
<style>
    canvas {box-shadow: 4px 4px 8px black; padding: 2px; }
    .respuesta span {display: block;box-shadow: 4px 4px 8px black; padding: 50px; border-radius: 10px; margin-top: 30px;}
</style>
<script type="text/javascript" src="js/jsqrcode/grid.js"></script>
<script type="text/javascript" src="js/jsqrcode/version.js"></script>
<script type="text/javascript" src="js/jsqrcode/detector.js"></script>
<script type="text/javascript" src="js/jsqrcode/formatinf.js"></script>
<script type="text/javascript" src="js/jsqrcode/errorlevel.js"></script>
<script type="text/javascript" src="js/jsqrcode/bitmat.js"></script>
<script type="text/javascript" src="js/jsqrcode/datablock.js"></script>
<script type="text/javascript" src="js/jsqrcode/bmparser.js"></script>
<script type="text/javascript" src="js/jsqrcode/datamask.js"></script>
<script type="text/javascript" src="js/jsqrcode/rsdecoder.js"></script>
<script type="text/javascript" src="js/jsqrcode/gf256poly.js"></script>
<script type="text/javascript" src="js/jsqrcode/gf256.js"></script>
<script type="text/javascript" src="js/jsqrcode/decoder.js"></script>
<script type="text/javascript" src="js/jsqrcode/qrcode.js"></script>
<script type="text/javascript" src="js/jsqrcode/findpat.js"></script>
<script type="text/javascript" src="js/jsqrcode/alignpat.js"></script>
<script type="text/javascript" src="js/jsqrcode/databr.js"></script>

EOL;
include($dirs['inc'] . 'top-nav.php');
include($dirs['inc'] . 'contenido-home.php');
include($dirs['inc'] . 'qr-reader.php');
include($dirs['inc'] . 'filtro-edif-guardias.php');
include($dirs['inc'] . 'contenido-guardias.php');
include($dirs['inc'] . 'errors.php');
include($dirs['inc'] . 'footer.php');