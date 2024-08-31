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
    <title>Dashboard</title>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat|sofia|Trirong|Poppins">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard/post-report.css">
    <link rel="stylesheet" href="../css/dashboard/profile_pic.css">
    <link rel="stylesheet" href="../css/loader.css">
    
    
    <style>
        body{
        font-family:poppins;
        }
    </style>
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
                 
                 <img class="profile_pic" src="<?php echo $_SESSION["img"]; ?>" alt="image">
    
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
     

<div class="page_1">

<!------------------- page 1 ----------------------------------->
<form id="reportForm">

      <div class="row">

          <div class="col-md-6">

             <label for="offender" class="mb-2 mt-3 fw-bold">Name Of Offender</label>
 
             <input type="text" class="form-control" placeholder="Name">

         </div>

         <div class="col-md-6">

             <label for="addressOffender"  class="mb-2 mt-3 fw-bold">Address of Offender</label>

             <input type="text" class="form-control" placeholder="Address">

         </div>

     </div>

     <div class="row">

         <div class="col-md-6">

              <label for="Date of Event"  class="mb-2 mt-3 fw-bold">Date of Event</label>
 
              <input type="text" class="form-control" placeholder="Date">

         </div>

         <div class="col-md-6">

              <label for="Time of Event"  class="mb-2 mt-3 fw-bold">Time of Event</label>

              <input type="text" class="form-control" placeholder="Time">

         </div>

     </div>
   
                  
                       <label for="Details of Event"  class="mb-2 mt-3 fw-bold">Details of Event</label>

                      <input type="text" class="form-control w-100" placeholder="Text Here">

                      <label for="Purpose of reporting"  class="mb-2 mt-3 fw-bold">Purpose of reporting</label>

                       <input type="text" class="form-control" placeholder="Text Here">
              
                       <div class="d-flex justify-content-space-between px-2 mt-3 gap-1">

             
             
                 <div class="mr-5">
                       <h6  class=" fw-bold mb-2 mt-3">Who would you like us to report to (Please thick)</h6>

                       <input type="checkbox"> Manager <br>
                       <input type="checkbox"> Owner <br>
                       <input type="checkbox"> The government <br>
                       <input type="checkbox"> Police <br>

                          <br>

                         <h6 class="mb-2 mt-3 fw-bold">Will you like to be anonymous (Please thick)</h6>

                        <input type="checkbox"> Yes <br>
                         <input type="checkbox"> No<br>
                           <br>
                 </div>

                 <div>

                       <h6 class="mb-2 mt-3 fw-bold">Which category are you reporting for (Please thick)</h6>

                          <input type="checkbox"> Inefficiency <br>
                          <input type="checkbox"> Negligence <br>
                          <input type="checkbox"> Rape <br>
                          <input type="checkbox"> Insult<br>
                          <input type="checkbox"> Assault <br>
                           <input type="checkbox"> Bad Approach<br>
                          <input type="checkbox"> Murder<br>
                          <input type="checkbox"> Abuse<br>
                          <input type="checkbox"> Others<br>
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



     <div>

         <h6 class="mb-2 mt-3 fw-bold">Voice record Upload</h6>
         <label class="form-control p-5 w-100 text-center bg-light"  style="">
            <small  id="file-label"  style="font-size: 14px;padding: 1px;background-color: rgba(0,0,0,0.6);color: white;">Choose a file</small><br></span><span id="fileName"></span><input style="display: none;" type="file" class="form-control" name="imager"  onchange="updateFileName(this)"></label>
              <span id="fileName"></span>
          

     </div>

           <br>

     <div>


           <h6 class="mb-2 mt-3 fw-bold">Voice evidence Upload</h6>
             <div  id="file-label" class="file-container">
                 <label class="form-control p-5 w-100 text-center bg-light"  style="">
                      <small  id="file-labelx"  style="font-size: 14px;padding: 1px;background-color: rgba(0,0,0,0.6);color: white;">Choose a file</small><br></span><span id="fileNamex"></span><input style="display: none;" type="file" class="form-control" name="imager"  onchange="updateFileNamex(this)"></label>
                      <span id="fileNamex"></span>
             </div>
     </div>

         
        <br>
        <span class='arrow-left btn-previous'><a><i class="fa fa-arrow-left"></i> Previous</a></span>
             
        <span class='arrow-right'><a class="btn-report">Done</a></span>

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


<script type="text/javascript">
  
  function updateFileName(input) {
  var fileName = input.files[0].name;
    document.getElementById('file-label').innerText = fileName;
  }
  
  </script>


 
<script type="text/javascript">
  
  function updateFileNamex(input) {
  var fileNamex = input.files[0].name;
    document.getElementById('file-labelx').innerText = fileNamex;
  }
  
  </script>



<script type="text/javascript">

$('#reportForm').on('submit',function(e){
if (confirm("Are you sure to submit this?")) {
 e.preventDefault();
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
    //    $('#bom').load(location.href + " #my");
}

else
 { 
  swal({
            icon:"error",
            text:response

           });
            $("#reportForm")[0].reset();      

            }
 }
        });
 }
    });

</script>

</body>
</html>