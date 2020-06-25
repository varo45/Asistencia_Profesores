<!DOCTYPE html>
<html>
    <head>
        <title>QR Code Reader</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            canvas {background-color: lightblue}
        </style>
        <script type="text/javascript" src="js/jquery.min.js"></script>
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
    </head>
    <body>
        <video id="player" controls autoplay hidden></video>
        <canvas id="qr-canvas" width=320 height=240></canvas>
        <div hidden>
            <button id="captureSnapshotButton">Capture Snapshot</button>
            <button id="attemptDecodeButton" disabled>Attempt Decode</button>
            <button id="startAutoCaptureButton">Start Auto-Capture</button>
            <button id="stopAutoCaptureButton">Stop Auto-Capture</button>
            <button id="stopCameraButton">Stop Camera</button>
        </div>

        <div id="output"></div>

        <script>
            const canvas = document.getElementById('qr-canvas');
            const context = canvas.getContext('2d');
            let autoCaptureStatus = false;
            let decodeFailures = 0;

            const constraints = {
                video: {
                    width: 320,
                    height: 240
                }
            };
            
            showDefaultCanvas();

            // Attach the video stream to the video element and autoplay.
            navigator.mediaDevices.getUserMedia(constraints)
                    .then((stream) => {
                        player.srcObject = stream;
                    });

            window.onload = function() {
                // Start taking snapshots to canvas
                autoCaptureStatus = true;
                decodeFailures = 0;
                autoCapture();
            };

            captureSnapshotButton.addEventListener('click', () => {
                // Draw the video frame to the canvas.
                attemptDecodeButton.disabled = false;
                context.drawImage(player, 0, 0, canvas.width, canvas.height);
            });

            stopCameraButton.addEventListener('click', () => {
                // Stop video capture.
                player.srcObject.getVideoTracks().forEach(track => track.stop());
                disableButtons();
                autoCapture = false;
                output.innerHTML = '<h2 style="color:#F00">Recargue la página para escanear.</h2>';
                showDefaultCanvas();
            });

            attemptDecodeButton.addEventListener('click', () => {
                // Decode QR Code
                try {
                    decodedValue = qrcode.decode();
                    console.log(decodedValue);
                    updateOutputValue(decodedValue);
                    // Stops scanning
                    autoCaptureStatus = false;
                } catch (err) {
                    updateOutputValue("");
                    if (err !== "No se ha podido encontrar la codificación (found 0)") {
                        //throw err;
                    }
                }
            });

            startAutoCaptureButton.addEventListener('click', () => {
                // Start taking snapshots to canvas
                autoCaptureStatus = true;
                decodeFailures = 0;
                autoCapture();
            });

            stopAutoCaptureButton.addEventListener('click', () => {
                // Stop taking snapshots to canvas
                autoCaptureStatus = false;
            });


            function autoCapture() {
                if (autoCaptureStatus) {
                    captureSnapshotButton.click();
                    attemptDecodeButton.click();
                    setTimeout(autoCapture, 100);
                }
            }

            function updateOutputValue(val) {
                /* output.innerHTML = "<h2>Decoded value: " + val + "</h2>"; */
                if(val == '')
                {

                }
                else
                {
                  separar = val.split(';');
                  abrev = separar[0];
                  enp = separar[1];
                  if(typeof enp == 'undefinded')
                  {

                  }
                  else
                  {
                    $('#output').load('index.php?ACTION=fichar-asist&abrev='+abrev+'&enp='+enp);
                  }
                }
            }

            function disableButtons() {
                buttons = document.getElementsByTagName("button");
                Array.from(buttons).map(button => button.disabled = true);
            }
            
            function showDefaultCanvas() {
                context.clearRect(0, 0, canvas.width, canvas.height);        
                context.font = "30px Arial";
                context.fillText("Lector QR", 85, 130);
            }
        </script>
        <script>
          window.setInterval(function(){
            $('#output').html('');
            startAutoCaptureButton.click();
          }, 1000);
        </script>
        <script>
          window.setInterval(function(){
            $('#qr-canvas').html('');
          }, 18000000);
        </script>
    </body>
</html>