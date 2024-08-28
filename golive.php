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
         </div>

        <div>

            <i id="stopCamera" class="fa fa-close"></i>


        </div>

     </div>




</div>

<div class="container video">

<video id="video" autoplay></video>
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
<script>
  $(document).ready(function() {
    let stream = null; // Store the media stream globally

    $('#startCamera').on('click', function() {
        // Check if the browser supports media devices
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            // Request access to the camera
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function(mediaStream) {
                    // Save the stream for later use
                    stream = mediaStream;
                    // Get the video element
                    const video = $('#video')[0];
                    // Set the video source to the stream
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

    $('#stopCamera').on('click', function() {
        if (stream) {
            // Get all tracks from the stream
            const tracks = stream.getTracks();
            // Stop each track
            tracks.forEach(track => track.stop());
            // Clear the video source
            $('#video')[0].srcObject = null;
            // Optionally, set the stream variable to null
            stream = null;
        }
    });
});

</script>
</body>
</html>