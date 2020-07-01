<?php

echo <<< EOL
<div class="container">
    <video id="player" controls autoplay hidden></video>
    <div hidden>
        <button id="captureSnapshotButton">Capture Snapshot</button>
        <button id="attemptDecodeButton" disabled>Attempt Decode</button>
        <button id="startAutoCaptureButton">Start Auto-Capture</button>
        <button id="stopAutoCaptureButton">Stop Auto-Capture</button>
        <button id="stopCameraButton">Stop Camera</button>
    </div>
    <div class='row'>
        <div class='col-xs-12 col-md-4'>
            <canvas id="qr-canvas" width=240 height=240></canvas>
        </div>
        <div class='col-xs-12 col-md-8'>
            <h2>Respuesta de escaner:</h2>
            <div id="output" class='respuesta'></div>
        </div>
    </div>
</div>
EOL;

include_once "js/qr-reader.js";
?>