<?php
require_once '../engine/Session.php'; // Include the Session class

$session = new Session(); // Create an instance of the Session class
$session->checkLogin(); // Check if the user is logged in
$user_id = $_SESSION['id'];
// The rest of your code
?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat|sofia|Trirong|Poppins">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/dashboard/profile.css">
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

                 <?php if (file_exists($_SESSION['img'])) {
$extension = strtolower(pathinfo($_SESSION['img'],PATHINFO_EXTENSION));
$image_extension  = array('jpg','jpeg','png');
if (!in_array($extension , $image_extension)) {
    $_SESSION['img'] = "<i style='font-size:20px;color:black;' class='fa fa-user-alt' ></i>";
echo$_SESSION['img']; }
else{ ?>
    <div id="bom"><div id="my">
   <img class="profile_pic" src="<?php echo $_SESSION['img']; ?>" alt="image">
   </div></div>
<?php }  } 
?>

             <h6>Profile</h6>
               


             </div>

                  
        <div class="manage">

             <div>
         
                <h6>Manage Profile</h6>

             </div>

             <div class="add-delete b">
                 <a class="add_report tablinks"  onclick="openCity(event,'London')"  id="defaultOpen"> Change Profile pic</a> 
                 <a  class="remove_report tablinks"  onclick="openCity(event,'Paris')"> Edit Profile</a>
             </div>

         </div>

 <!------------------------- background-details--------------------------- -->
        
 <div class="table-container">

<div id="label">

<div id="London" class="tabcontent">

<table style="width: 100%;">
<thead>
<tr style="border-top: 2px solid rgba(192,192,192,0.4);border-bottom: 2px solid rgba(192,192,192,0.4);">
 <td style="padding:8px;" class="inbox" id="Home">Personal details</td>
</tr>
</thead>
</table>

<div style="padding:10px;">
 <small> <?php echo$_SESSION['name']; ?> </small><br>

 <small> <?php 
if (!empty($_SESSION['contact'])) {
    echo htmlspecialchars($_SESSION['contact']);
} else {
    echo "No phone number provided yet";
}
?></small><br>

<small>Dial code +234</small><br>

<small><?php if(!empty($_SESSION['contact'])) {echo$_SESSION['contact2'];} else{echo"No Other number";} ?></small><br>


<small>Dial code +234</small><br>

<small><?php echo $_SESSION['email']?></small>

   <br>

   <i class="fa fa-user-alt" style=" border-radius: 50%;border:1px solid #2e2d2d;padding: 20px;margin:20px;"></i><br>

<form id="editpage-form" method="post">

<input type="hidden" name="id" value="<?php echo$_SESSION['id'] ?>">
<input type="file" name="fileupload" accept="image/*"><br><br>
<input type="submit" name="submit" id="submit" value="Change photo" class="btn btn-success " style="color: white;font-size:14px;"><br>
<?php include '../components/loader.php'; ?>
</form>

</div>
</div>


<div id="Paris" class="tabcontent" style="padding:20px;">

<h6>My profile</h6>

<form id="editpage-details">

<input type="text" id="first_name" name="name" placeholder="Full Name" class="form-control"><br>

<input type="hidden"  name="sid" value="<?php echo $user_id ?>">

<h6>Password</h6>

<div class="password-container" style="display:flex;justify-content:space-between;">

<input id="password"  type="password" name="password" placeholder="Password" class="form-control"><input id="first_name"  type="password" name="cpassword" placeholder="Confirm Password" class="form-control"><br>

</div>

<br>

<h6>Contact information</h6>

<div  style="display:flex;justify-content:space-between;">

<input type="text" name="country" placeholder="Country" id="contact"  class="form-control">

<input type="text" name="contact" id="contact"  placeholder="Phone number"  class="form-control">

<input type="text" name="whatsapp" id="whatsapp" placeholder="Whatsapp"  class="form-control"><br>
</div>



<br>
<h6> Address Details</h6>
<textarea name="location" id="" class="form-control" placeholder="..Write something" wrap="physical">
</textarea>

<br>

<h6>Social Media</h6>
<div  style="display:flex;justify-content:space-between;">
<input id="links" type="text" name="facebook" placeholder="Facebook" class="form-control">
<input id="links" type="text" name="twitter" placeholder="Twitter" class="form-control">
<input id="links" type="text" name="linkedin" placeholder="Linkedin" class="form-control">
<input id="links" type="text" name="instagram" placeholder="Instagram" class="form-control">
</div>

<br><br>
<div style="text-align: right;">
<a class="btn btn-danger" onclick="cancel()">Cancel</a>&nbsp;<a id="btn-submit" class="btn btn-success">Submit</a>
</div>
<?php include '../components/loader.php'; ?>
</form>

</div>


</div>

<!-----------------------------End of background-details----------------------------- -->
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

function openCity(evt, cityName) {
var i, tabcontent, tablinks;
tabcontent = document.getElementsByClassName("tabcontent");
for (i = 0; i < tabcontent.length; i++) {
tabcontent[i].style.display = "none";
 }
tablinks = document.getElementsByClassName("tablinks");
for (i = 0; i < tablinks.length; i++) {
 tablinks[i].className = tablinks[i].className.replace(" active", "");
 }
document.getElementById(cityName).style.display = "block";
evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();
</script>


<script>
  
function cancel() {
$("#editpage-details")[0].reset();
}
</script>





<script type="text/javascript">

$('#editpage-form').on('submit',function(e){
if (confirm("Are you sure to change this?")) {
e.preventDefault();
$(".loading-image").show();
let formdata = new FormData();
   $.ajax({
           type: "POST",

           url: "engine/changeprofilepic.php",

           data:new FormData(this),

           cache:false,

           processData:false,

           contentType:false,

           success: function(response) {

           $(".loading-image").hide();

          if(response==1){

            swal({

          text:"Image has been changed",
          icon:"success",
        });
       $('#bom').load(location.href + " #my");
}

else
 { 
  swal({
            icon:"error",
            text:response

           });
            $("#editpage-form")[0].reset();      

            }
 }
        });
 }
    });

</script>


<script type="text/javascript">
  $('#btn-submit').on('click',function(){
    $.ajax({
        type: "POST",
        url: "engine/edit-page.php",
        data:  $("#editpage-details").serialize(),
        cache:false,
        contentType: "application/x-www-form-urlencoded",
        success: function(response) {
              if (response==1) {
                swal({
              text:"Details update is saved",
               icon:"success",
 });
           $("#editpage-details")[0].reset();
            $("#myformx").hide();
 }
   else{
          swal({
                    text:response,
                   icon:"error",

              });
             }

            },

            error: function(jqXHR, textStatus, errorThrown) {

                console.log(errorThrown);

            }

        })

    });


</script>

</body>
</html>