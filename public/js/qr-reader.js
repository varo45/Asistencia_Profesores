<script>
        const canvas = document.getElementById('qr-canvas');
        const context = canvas.getContext('2d');
        let autoCaptureStatus = false;
        let decodeFailures = 0;
        let num = 100;

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
                // muestra en consola el valor decodificado
                //console.log(decodedValue);
                updateOutputValue(decodedValue);
                // Stops scanning
                autoCaptureStatus = false;
                num = 100;
            } catch (err) {
                //updateOutputValue("");
                if (err !== "Uncaught Couldn't find enough finder patterns (found 0)") {
                    //throw err;
                    if(num < 1000)
                    {
                        num++;
                    }
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
                setTimeout(autoCapture, num);
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
            context.fillText("Lector QR", 50, 130);
        }
    </script>
    <script>
      window.setInterval(function(){
        $('#output').html("<span id='empty'>Acerque el código QR al lector...</span>");
        $('#output').css('background-color', 'white');
        startAutoCaptureButton.click();
      }, 1000);
    </script>
    <script>
      window.setInterval(function(){
        location.reload();
      }, 300000);
    </script>