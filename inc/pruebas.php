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
        <canvas id="qr-canvas" width=240 height=240></canvas>
        <div id="output"></div>

        <script>
            const canvas = document.getElementById('qr-canvas');
            const context = canvas.getContext('2d');
            let autoCaptureStatus = true;
            let decodeFailures = 0;

            const constraints = {
                video: {
                    width: 240,
                    height: 240
                }
            };
            
            showDefaultCanvas();
            autoCapture();

            // Attach the video stream to the video element and autoplay.
            navigator.mediaDevices.getUserMedia(constraints)
                    .then((stream) => {
                        player.srcObject = stream;
                    });
            
            function captureSnapshotButton() {
                // Draw the video frame to the canvas.
                attemptDecodeButton.disabled = false;
                context.drawImage(player, 0, 0, canvas.width, canvas.height);
            };

            function stopCameraButton() {
                // Stop video capture.
                player.srcObject.getVideoTracks().forEach(track => track.stop());
                disableButtons();
                autoCapture = false;
                output.innerHTML = '<h2 style="color:#F00">Recargue la página para escanear.</h2>';
                showDefaultCanvas();
            };

            function attemptDecodeButton() {
                // Decode QR Code
                try {
                    decodedValue = qrcode.decode();
                    // console.log(decodedValue);
                    updateOutputValue(decodedValue);
                    // Stops scanning
                    autoCaptureStatus = false;
                    setTimeout(scanAgain, 1000);
                } catch (err) {
                    if (err !== "No se ha podido encontrar la codificación (found 0)") {
                        //throw err;
                    }
                }
            };

            function startAutoCaptureButton() {
                // Start taking snapshots to canvas
                autoCaptureStatus = true;
                decodeFailures = 0;
                autoCapture();
            };

            function stopAutoCaptureButton() {
                // Stop taking snapshots to canvas
                autoCaptureStatus = false;
            };

            function scanAgain(){
                $('#output').html("<span id='empty'>Acerque el código QR al lector...</span>");
                $('#output').css('background-color', 'white');
                autoCaptureStatus = true;
                autoCapture();
            };

            function autoCapture() {
                if (autoCaptureStatus) {
                    captureSnapshotButton();
                    attemptDecodeButton();
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
        <!-- <script>
          window.setInterval(function(){
            $('#output').html('');
            startAutoCaptureButton();
          }, 1000);
        </script>
        <script>
          window.setInterval(function(){
            $('#qr-canvas').html('');
          }, 300000);
        </script> -->
    </body>
</html>