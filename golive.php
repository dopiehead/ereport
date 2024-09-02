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

                 <i id="startCall" class="fa fa-plus"></i>

                 <!-- <i id="startRecording" class="fa fa-video-camera"></i> -->
<!-- 
                 <i class="fa fa-play" id="playRecording" style="display:none;"></i>

                 -->

          

         </div>

        <div>

            <i id="endCall" class="fa fa-close"></i>
          
            <i id="closeChatButton" class="fa fa-hand"></i>
            <!-- <i id="hangUp" class="fa fa-stop"></i> -->
               


        </div>

     </div>




</div>

<div class="container w-100 ">

<div class="video-container">

<video id="localVideo" autoplay></video>

<video id="remoteVideo" autoplay></video>

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


    <!-- <script>
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
    </script> -->




    <script>
        const signalingServerUrl = 'ws://localhost:8080';
        const localVideo = document.getElementById('localVideo');
        const remoteVideo = document.getElementById('remoteVideo');
        const startCallButton = document.getElementById('startCall');
        const endCallButton = document.getElementById('endCall');
        const closeChatButton = document.getElementById('closeChatButton');
        let localStream;
        let peerConnection;
        const ws = new WebSocket(signalingServerUrl);

        ws.onmessage = (message) => {
            const data = JSON.parse(message.data);
            if (data.offer) {
                handleOffer(data.offer);
            } else if (data.answer) {
                handleAnswer(data.answer);
            } else if (data.iceCandidate) {
                handleICECandidate(data.iceCandidate);
            }
        };

        async function startCall() {
            localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
            localVideo.srcObject = localStream;
            peerConnection = new RTCPeerConnection();

            peerConnection.onicecandidate = (event) => {
                if (event.candidate) {
                    ws.send(JSON.stringify({ iceCandidate: event.candidate }));
                }
            };

            peerConnection.ontrack = (event) => {
                remoteVideo.srcObject = event.streams[0];
            };

            localStream.getTracks().forEach(track => peerConnection.addTrack(track, localStream));

            const offer = await peerConnection.createOffer();
            await peerConnection.setLocalDescription(offer);
            ws.send(JSON.stringify({ offer: offer }));
        }

        async function handleOffer(offer) {
            peerConnection = new RTCPeerConnection();
            peerConnection.onicecandidate = (event) => {
                if (event.candidate) {
                    ws.send(JSON.stringify({ iceCandidate: event.candidate }));
                }
            };

            peerConnection.ontrack = (event) => {
                remoteVideo.srcObject = event.streams[0];
            };

            await peerConnection.setRemoteDescription(new RTCSessionDescription(offer));
            const answer = await peerConnection.createAnswer();
            await peerConnection.setLocalDescription(answer);
            ws.send(JSON.stringify({ answer: answer }));
        }

        async function handleAnswer(answer) {
            await peerConnection.setRemoteDescription(new RTCSessionDescription(answer));
        }

        function handleICECandidate(iceCandidate) {
            peerConnection.addIceCandidate(new RTCIceCandidate(iceCandidate));
        }

        function endCall() {
            peerConnection.close();
            localStream.getTracks().forEach(track => track.stop());
        }

        function closeChat() {
        endCall(); // End the current call
        ws.close(); // Close the WebSocket connection
    }

        startCallButton.addEventListener('click', startCall);
        endCallButton.addEventListener('click', endCall);
        closeChatButton.addEventListener('click', closeChat);
    </script>




</body>
</html>

</body>
</html>