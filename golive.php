<html lang="en">
<head>
    <meta charset="UTF-8">
   <title>Go live</title>
    <?php  include 'components/links.php'; ?>
  
  <link rel="stylesheet" href="css/golive.css">
</head>
<body>
<?php  include 'components/layout.php'; ?>

<div class="hero-section">

<div class="hero-text">

  <h3>
   Go live
  </h3>
<br><br>


</div>

</div>

<div class="back-button">
<a onclick="history.go(-1)"><i class="fa fa-chevron-left"></i></a>
</div>




<div class="container">

     <div class="form-container">

         <div>
                 <img src="assets/images/IMG_E7548.jpg" alt="">

                 <i id="startCamera" class="fa fa-plus"></i>

                 <i id="startRecording" class="fa fa-video-camera"></i>

                 <i class="fa fa-play" id="playRecording" style="display:none;"></i>

          

         </div>

        <div>

            <i id="stopCamera" class="fa fa-close"></i>
            <i id="stopRecording" class="fa fa-hand"></i>
            <i class="fa fa-stop" id="downloadRecording" style="display:none;"></i>
               


        </div>

     </div>




</div>

<div class="container w-100 ">

<div class="video-container">

<video id="video" autoplay></video>

<video id="recordedVideo" controls style="display:none;"></video>

</div>

</div>

<div class="container">

     <div class="font-container">

         <div class="form-below">

             <i class="fa fa-comments"></i>

             <i class="fa fa-crop"></i>

             <i class="fa fa-share-alt"></i>

         </div> 


         <div>

             <i class="fa fa-heart"></i>
          
         </div>


     </div>

</div>



<?php  include 'components/footer.php';  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camera and Recording</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <button id="startCamera">Start Camera</button>
    <button id="stopCamera">Stop Camera</button>
  

    <video id="video" autoplay></video>


    <script>
      $(document).ready(function() {
        let stream = null; // Store the media stream globally
        let mediaRecorder = null; // Store the MediaRecorder instance
        let recordedChunks = []; // Store recorded chunks

        // Start camera
        $('#startCamera').on('click', function() {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(function(mediaStream) {
                        stream = mediaStream;
                        const video = $('#video')[0];
                        video.srcObject = stream;
                    })
                    .catch(function(err) {
                        console.error('Error accessing the camera: ', err);
                        alert('Unable to access the camera. Please check your permissions.');
                    });
            } else {
                console.error('getUserMedia is not supported in this browser.');
                alert('getUserMedia is not supported in this browser.');
            }
        });

        // Stop camera
        $('#stopCamera').on('click', function() {
            if (stream) {
                const tracks = stream.getTracks();
                tracks.forEach(track => track.stop());
                $('#video')[0].srcObject = null;
                stream = null;
            }
        });

        // Start recording
        $('#startRecording').on('click', function() {
            if (stream) {
                recordedChunks = []; // Clear previous recordings
                mediaRecorder = new MediaRecorder(stream);

                mediaRecorder.ondataavailable = function(event) {
                    if (event.data.size > 0) {
                        recordedChunks.push(event.data);
                    }
                };

                mediaRecorder.onstop = function() {
                    const blob = new Blob(recordedChunks, { type: 'video/webm' });
                    const recordedVideo = $('#recordedVideo')[0];
                    recordedVideo.src = URL.createObjectURL(blob);
                    recordedVideo.style.display = 'block';
                    $('#playRecording').show();
                    $('#downloadRecording').show();
                };

                mediaRecorder.start();
                console.log('Recording started');
            } else {
                console.error('No active stream to record');
                alert('Start the camera first');
            }
        });

        // Stop recording
        $('#stopRecording').on('click', function() {
            if (mediaRecorder) {
                mediaRecorder.stop();
                mediaRecorder = null;
                console.log('Recording stopped');
            }
        });

        // Play recorded video
        $('#playRecording').on('click', function() {
            const recordedVideo = $('#recordedVideo')[0];
            recordedVideo.play();
        });

        // Download recorded video
        $('#downloadRecording').on('click', function() {
            const blob = new Blob(recordedChunks, { type: 'video/webm' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'recorded-video.webm';
            a.click();
            URL.revokeObjectURL(url);
        });
      });
    </script>






<script>
        const localVideo = document.getElementById('localVideo');
        const remoteVideo = document.getElementById('remoteVideo');
        const startCallButton = document.getElementById('startCall');
        const hangUpButton = document.getElementById('hangUp');

        let localStream;
        let peerConnection;
        const servers = null; // Use default STUN/TURN servers
        const signalingServerUrl = 'ws://localhost:8080'; // WebSocket URL

        const signalingSocket = new WebSocket(signalingServerUrl);

        signalingSocket.onmessage = async (message) => {
            const data = JSON.parse(message.data);
            switch (data.type) {
                case 'offer':
                    await peerConnection.setRemoteDescription(new RTCSessionDescription(data.offer));
                    const answer = await peerConnection.createAnswer();
                    await peerConnection.setLocalDescription(answer);
                    signalingSocket.send(JSON.stringify({ type: 'answer', answer }));
                    break;
                case 'answer':
                    await peerConnection.setRemoteDescription(new RTCSessionDescription(data.answer));
                    break;
                case 'candidate':
                    await peerConnection.addIceCandidate(new RTCIceCandidate(data.candidate));
                    break;
            }
        };

        startCallButton.onclick = async () => {
            localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
            localVideo.srcObject = localStream;

            peerConnection = new RTCPeerConnection(servers);
            peerConnection.onicecandidate = ({ candidate }) => {
                if (candidate) {
                    signalingSocket.send(JSON.stringify({ type: 'candidate', candidate }));
                }
            };
            peerConnection.ontrack = (event) => {
                remoteVideo.srcObject = event.streams[0];
            };

            localStream.getTracks().forEach(track => peerConnection.addTrack(track, localStream));

            const offer = await peerConnection.createOffer();
            await peerConnection.setLocalDescription(offer);
            signalingSocket.send(JSON.stringify({ type: 'offer', offer }));
            
            startCallButton.disabled = true;
            hangUpButton.disabled = false;
        };

        hangUpButton.onclick = () => {
            peerConnection.close();
            peerConnection = null;
            startCallButton.disabled = false;
            hangUpButton.disabled = true;
        };
    </script>






</body>
</html>

</body>
</html>