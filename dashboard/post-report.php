<?php
require_once '../engine/Session.php'; // Include the Session class

$session = new Session(); // Create an instance of the Session class
$session->checkLogin(); // Check if the user is logged in

// The rest of your code
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post report</title>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat|sofia|Trirong|Poppins">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard/post-report.css">
    <link rel="stylesheet" href="../css/dashboard/profile_pic.css">
    <link rel="stylesheet" href="../css/loader.css">
  
</head>
<body>
    <div class="dashboard">

         <div class="menu-body">

             <div class="logo-container">
                
  
                 <h6>Ereport</h6>

             </div>
       
             <?php include '../components/dashboard/overlay.php'; ?>

         </div> 

     
       
              <!------------------------- section || ---------------->
     

         <div class="board">

             <div class="menu-container">

                 <div class="menu-board">

                     <div class="menu">
         
                          <i class="fa fa-bars"></i>

                          <input type="search" placeholder="Search">

                     </div>


                     <div class="menu">
         
                          <i class="fa fa-bell"></i>

                          <i class="fa fa-comments"></i>

                     </div>
     
                 </div>

                 <?php if (file_exists($_SESSION['img'])) {
$extension = strtolower(pathinfo($_SESSION['img'],PATHINFO_EXTENSION));
$image_extension  = array('jpg','jpeg','png');
if (!in_array($extension , $image_extension)) {
    $_SESSION['img'] = "<i style='font-size:20px;color:black;' class='fa fa-user-alt profile_pic' ></i>";
echo$_SESSION['img']; }
else{ ?>
   <img class="profile_pic" src="<?php echo $_SESSION['img']; ?>" alt="image">
<?php }  } 
?>
              
             <h6>Post report</h6>
               


             </div>

                  
        <div class="manage">

             <div>              

             </div>

             <div class="add-delete">
                 <a class="add_report"><i class="fa fa-plus"></i> Add New Report</a> 
                 <a  class="remove_report"> <i class="fa fa-minus"></i>Delete</a>
             </div>

         </div>

       
         
         <div class="table-container">

<!-------------------------  menu     -------------------------------->
<div class="d-flex justify-content-end aign-items-end">
    
</div>  

<div class="page_1">

<!------------------- page 1 ----------------------------------->
<form id="reportForm">

      <div class="row">

          <div class="col-md-6">

             <label for="offender" class="mb-2 mt-3 fw-bold">Name Of Offender</label>
 
             <input type="text" name="reporterName" class="form-control" placeholder="Name">

         </div>

         <div class="col-md-6">

             <label for="addressOffender"  class="mb-2 mt-3 fw-bold">Address of Offender</label>

             <input type="text" name="addressOffender" class="form-control" placeholder="Address">

         </div>

     </div>

     <div class="row">

         <div class="col-md-4">

         <label for="Title of Event"  class="mb-2 mt-3 fw-bold">Title of Event</label>

         <input type="text" name="eventTitle" class="form-control" placeholder="Event title">

        </div>


         <div class="col-md-4">

              <label for="Date of Event"  class="mb-2 mt-3 fw-bold">Date of Event</label>
 
              <input type="date" name="eventDate" class="form-control" placeholder="Date">

         </div>

         <div class="col-md-4">

              <label for="Time of Event"  class="mb-2 mt-3 fw-bold">Time of Event</label>

              <input type="time" name="eventTime" class="form-control" placeholder="Time">

         </div>

     </div>
   
                  
                       <label for="Details of Event"  class="mb-2 mt-3 fw-bold">Details of Event</label>

                      <textarea  name="eventDetails"  class="form-control w-100" placeholder="....Write details" rows="4" wrap="physical"></textarea>

                      <label for="Purpose of reporting"  class="mb-2 mt-3 fw-bold">Purpose of reporting</label>

                       <input type="text" name="reportPurpose" class="form-control" placeholder="Text Here">
              
                       <div class="d-flex justify-content-space-between px-2 mt-3 gap-1">

             
             
                 <div class="mr-5">

                       <h6  class=" fw-bold mb-2 mt-3">Who would you like us to report to (Please thick)</h6>
                        <div class="row">
                       <div class="col-md-3">
                       <input name="reportTo[]" value="manager" type="checkbox"> Manager <br>
                       <input name="reportTo[]" value="owner" type="checkbox"> Owner <br>
                       <input name="reportTo[]" value="government" type="checkbox"> The government <br>
                       <input name="reportTo[]" value="police" type="checkbox"> Police <br>
                       <input name="reportTo[]" value="individual" type="checkbox"> individual <br>
                       <input name="reportTo[]" value="insurance" type="checkbox"> insurance <br>
                        </div>


                        <div class="col-md-3">
                       <input name="reportTo[]" value="bank" type="checkbox"> bank <br>
                       <input name="reportTo[]" value="service_provider" type="checkbox">service provider <br>
                       <input name="reportTo[]" value="drugs" type="checkbox"> drugs <br>
                       <input name="reportTo[]" value="army" type="checkbox"> army <br>
                       <input name="reportTo[]" value="teacher" type="checkbox">teacher <br>
                        </div>

                        
                        <div class="col-md-3">
                       <input name="reportTo[]" value="electricity" type="checkbox"> electricity <br>
                       <input name="reportTo[]" value="court_matters" type="checkbox">court matters <br>
                       <input name="reportTo[]" value="relationship" type="checkbox"> relationship <br>
                       <input name="reportTo[]" value="wanted_person" type="checkbox"> wanted person <br>
                       <input name="reportTo[]" value="hotel" type="checkbox"> hotel <br>
                        </div>


                        <div class="col-md-3">
                       <input name="reportTo[]" value="stolen_vehicles" type="checkbox"> stolen vehicles <br>
                       <input name="reportTo[]" value="inventions" type="checkbox"> inventions <br>
                       <input name="reportTo[]" value="spiritual" type="checkbox"> spiritual <br>
                       <input name="reportTo[]" value="landlord" type="checkbox"> landlord <br>
                       <input name="reportTo[]" value="civil_service" type="checkbox"> civil service <br>
                        </div>

                        </div>




                          <br>

                         <h6 class="mb-2 mt-3 fw-bold">Will you like to be anonymous (Please thick)</h6>

                        <input name="anonymous" type="checkbox"   value="yes"> Yes <br>
                         <input name="anonymous" type="checkbox" value="no"> No<br>
                           <br>
                 </div>

                 <div>

                       <h6 class="mb-2 mt-3 fw-bold">Which category are you reporting for (Please thick)</h6>

                          <input name="reportCategory[]" type="checkbox" value="inefficiency"> Inefficiency <br>
                          <input name="reportCategory[]" type="checkbox" value="negligence"> Negligence <br>
                          <input name="reportCategory[]" type="checkbox" value="rape"> Rape <br>
                          <input name="reportCategory[]" type="checkbox" value="insult"> Insult<br>
                          <input  name="reportCategory[]" type="checkbox" value="assault "> Assault <br>
                           <input  name="reportCategory[]" type="checkbox" value="bad approach"> Bad Approach<br>
                          <input  name="reportCategory[]" type="checkbox" value="murder"> Murder<br>
                          <input  name="reportCategory[]" type="checkbox" value="abuse"> Abuse<br>
                          <input  name="reportCategory[]" type="text" class="form-control" placeholder="Others">         <br>
                 </div> 

                 </div> 
                         <br><br>

           <span class='arrow-right btn-next'><a>Next <i class="fa fa-arrow-right"></i></a></span>

               <br><br>

               </div>

<!------------------------end of page 1---------------------------------------->

<!-- ------------------page 2---------------------------- -->
<br><br>

 <div class="page_2">
  

 <div class="picture_upload">

<h6 class="mb-2 mt-3 fw-bold">Picture Upload</h6>
<label class="form-control p-5 w-100 text-center bg-light">
<small  id="file-labelx"  style="font-size: 14px;padding: 1px;background-color: rgba(0,0,0,0.6);color: white;">Choose a file</small><br></span>
<span id="fileNamex"></span>
<input style="display: none;" type="file" class="form-control" name="imager" id="imager" accept="image/*" onchange="updateFileNameAndPreview(this)">
</label>

<div class="d-flex justify-content-center align-items-center">
<img id="image-preview" alt="Image preview">
</div>

</div>





     <div class="video_upload">

         <h6 class="mb-2 mt-3 fw-bold">Video record Upload</h6>
         <label class="form-control p-5 w-100 text-center bg-light">
        <small id="file-label" style="font-size: 14px; padding: 1px; background-color: rgba(0,0,0,0.6); color: white;">
            Choose a file
        </small>
        <br>
        <span id="fileName">No file chosen</span>
        <input id="fileInput" style="display: none;" type="file" class="form-control" name="fileupload" accept="video/*" onchange="previewFile(this)">
    </label>
              <span id="fileName"></span>
              <div id="preview-container" class="d-flex justify-content-center align-items-center">
        <video id="preview-video" controls></video>
    </div> 

     </div>

           <br>

     <!-- <div>


           <h6 class="mb-2 mt-3 fw-bold">Voice evidence Upload</h6>
             <div  id="file-label" class="file-container">
                 <label class="form-control p-5 w-100 text-center bg-light"  style="">
                      <small  id="file-labelx"  style="font-size: 14px;padding: 1px;background-color: rgba(0,0,0,0.6);color: white;">Choose a file</small><br></span><span id="fileNamex"></span><input style="display: none;" type="file" class="form-control" name="imager"  onchange="updateFileNamex(this)"></label>
                      <span id="fileNamex"></span>
             </div>
     </div> -->

         
        <br>
        <span class='arrow-left btn-previous'><a><i class="fa fa-arrow-left"></i> Previous</a></span>
             
        <span class='arrow-right'><input name="submit" type="submit"  class="btn-report bg-inherit" value="Done"></span>

        <?php include '../components/loader.php'; ?>

        </form>

  </div>      

     <br>

 </div>

</div>

</div>

<br>

<!-------------------------  end of menu     -------------------------------->
   
         </div>


         </div>   
         
     
     </div>


     <script>

$(".fa-bars").on('click', function() {
    $(this).toggleClass('active');
    
    if ($(this).hasClass('active')) {
        $(".fa-bars").css('backgroundColor', 'lightgreen');
        $(".board").css('width', '100%');
        $(".menu-body").css('width', '7%');
        $("label").css('display', 'none');
    } else {
        $(".fa-bars").css('backgroundColor', ''); // Reset background color
        $(".board").css('width', '80%'); // Reset width to default or initial state
        $(".menu-body").css('width', '30%'); // Reset width to default or initial state
        $("label").css('display', 'inline-block');
    }
});

     </script>

<script>


$(document).ready(function(){

$(".page_2").hide();
 $('.btn-next').click(function() {
   $(".page_1").slideUp(100);
    $(".page_2").slideDown(100);
});


 $('.btn-previous').click(function() {
   $(".page_2").slideUp(100);
    $(".page_1").slideDown(100);
});

});


</script>


<script>
        function previewFile(input) {
            var file = input.files[0];
            var fileName = file ? file.name : 'No file chosen';
            document.getElementById('fileName').textContent = fileName;

            var video = document.getElementById('preview-video');
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    video.src = e.target.result;
                    video.style.display = 'block'; // Show the video element
                };
                reader.readAsDataURL(file); // Read the file as a data URL
            } else {
                video.style.display = 'none'; // Hide the video element
            }
        }
    </script>


 
<script type="text/javascript">
        function updateFileNameAndPreview(input) {
            var file = input.files[0];
            if (file) {
                // Update file name
                document.getElementById('file-labelx').innerText = file.name;

                // Show image preview
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imagePreview = document.getElementById('image-preview');
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block'; // Show the image
                };
                reader.readAsDataURL(file);
            } else {
                // Hide image preview if no file is selected
                document.getElementById('file-labelx').innerText = 'Choose a file';
                document.getElementById('image-preview').style.display = 'none';
            }
        }
    </script>



<script type="text/javascript">

$('#reportForm').on('submit',function(event){
if (confirm("Are you sure to submit this?")) {
 event.preventDefault();
$(".loading-image").show();
var formdata = new FormData();
   $.ajax({
           type: "POST",

           url: "post-report-process.php",

           data:new FormData(this),

           cache:false,

           processData:false,

           contentType:false,

           success: function(response) {

           $(".loading-image").hide();

          if(response==1){

            swal({

          text:"Report has been submitted successfully",
          icon:"success",
        });
       $('#bom').load(location.href + " #my");
    $("#reportForm")[0].reset();
    $("#imager").val("");
    $('#fileInput').val(''); // This will generally not work
    $('#fileInput').replaceWith($('#fileInput').clone(true)); 
}

else
 { 
  swal({
            icon:"error",
            text:response

           });
           $('#fileInput').val(''); // This will generally not work
           $('#fileInput').replaceWith($('#fileInput').clone(true));     

            }
 }
        });
 }
    });

</script>


</body>
</html>