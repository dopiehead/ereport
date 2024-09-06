<?php
require_once '../engine/Session.php'; // Include the Session class

$session = new Session(); // Create an instance of the Session class
$session->checkLogin(); // Check if the user is logged in

// The rest of your code
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
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
    <link rel="stylesheet" href="../css/dashboard/dashboard.css">
    <link rel="stylesheet" href="../css/dashboard/profile_pic.css">
    
    
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

                          <input type="search" id="q" name="q" placeholder="Search">

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
  echo"<i style='font-size:20px;color:black;' class='fa fa-user-alt profile_pic' ></i>";
echo$_SESSION['img']; }
else{ ?>
  
   <img class="profile_pic" src="<?php echo $_SESSION['img']; ?>" alt="image">
   
<?php }  } 
?>

             <h6>Dashboard</h6>
               


             </div>

                  
        <div class="manage">

             <div>
         
                <h6>Manage Reports</h6>

             </div>

             <!-- <div class="add-delete">
                 <a class="add_report"><i class="fa fa-plus"></i> Add New Report</a> 
                 <a  class="remove_report"> <i class="fa fa-minus"></i>Delete</a>
             </div> -->

         </div>

       
         
         <div class="table-container">

    


            
          

         </div>

          
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




<script type="text/javascript">

$("#loading-image").hide();
$(".table-container").load("read-report.php");
$("#q").on('keyup',function() {
var x = $('#q').val();
if (x=='') {$("#reset").hide();}
else{
$("#reset").show();
}
getData(x);
});

$(document).on('click','.btn-success',function(){
var page = $(this).attr('id');
var x = $('#q').val();
getData(x,page);
});


function getData(x,page) {
$.ajax({
url:"read-report.php",
type:"POST",
data:{'q':x,'page':page},
success:function(data) {
$("#loading-image").hide();
$(".table-container").html(data).show();
}

});

};
</script>

</body>
</html>