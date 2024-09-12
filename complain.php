<?php 
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$user_name = "Fikayo Ereport";
$img_upload = "<i class='fa fa-user-alt'></i>";
$user_id = null;
if (isset($_SESSION['name']) && isset($_SESSION['id'])) {
   $user_name = htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8'); 
   $user_id = $_SESSION['id']; 
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Complaints</title>
    <?php  include 'components/links.php'; ?>
    <link rel="stylesheet" href="css/complain.css">
    <link rel="stylesheet" href="css/navlinks.css">
</head>
<body>
<?php  include 'components/layout.php'; ?>

<div class="hero-section">
     <div class="hero-text">
         <h3>
              Complaints
         </h3>
<br><br>
</div>
</div>
<br><br>
<div class="container">
  
      
     <div class="complain-container">
            
         <div class="complain-comment-container mx-3" style="height:80vh;overflow:auto;">

         <?php 
if (isset($_SESSION['id'])): 
    // Sanitize session variables
    $user_name = htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8');
    $user_img = htmlspecialchars($_SESSION['img'], ENT_QUOTES, 'UTF-8');
    
?>

    <img class="user_image mr-2 mb-2" src="<?php  echo 'dashboard/'.$user_img; ?>" alt=""><span class="user_name"><?php echo $user_name; ?></span>        

<?php else: ?>

    <i class="fa fa-user-alt user_image mr-2 mb-2"></i> <span class="user_name">John Smith</span>    

<?php endif; ?>
       
         <form id="complainForm">
             
         <input type="hidden" name="complain_id" id="complain_id"> 

            <input type="hidden" name="name" id="name" value="<?php echo$user_name?>">

            <input type="hidden" name="user_id" id="user_id" value="<?php echo$user_id ?>"><br>

            <textarea name="complain" style="font-size:13px;" id="complain" class="form-control complain_section" wrap="physical" placeholder="...Write a complain" rows="5" ></textarea> 

            <div class="d-flex justify-content-space-between align-items-center">

            <?php if(isset($_SESSION['id'])){ ?>
            <button class="btn-comment mt-2 w-50 mr-3 p-2">Post <i class="fa fa-chevron-right"></i></button>
       <?php } else{ ?> 
        <a href="sign-in.php?details='<?php echo urlencode($_SERVER['REQUEST_URI'])?>'" class="btn btn-primary mt-3 w-50 mr-3">login to continue <i class="fa fa-chevron-right"></i></a>
           <?php } ?>

            <label class="btn-comment mt-3 w-50 p-2 d-flex justify-content-center align-items-center gap-5">
              <span id="file-label"> Upload Photo<i class="fa fa-camera ml-3"></i></span> <span id="fileName">
    
    </span>
               <input type="file" name="fileupload" id="fileupload" class="d-none" accept="image/*"  onchange="updateFileName(this)">
               
</label>
            <form>
         </div>
       <br><br>
        
         <div class="complain-comment-section" id="complain-comment-section">
               <div class="user-container">        
                     
                     
         </div>

     </div>

</div>

</div>

</div>

<!-- footer -->
<?php include 'components/footer.php'; ?>
<script>
$(document).ready(function() {
    $("#complain-comment-section").load("engine/view-complain.php");
    $(document).on("click", '.btn_reply', function() {
       
        var complain_id = $(this).attr('id');

        $('#complain_id').val(complain_id);  // Set the comment ID in the hidden input field
        $(".complain_section").focus();  // Focus the name input field
    
    });
$('#complainForm').on('submit', function(e) {
        e.preventDefault(); 
        $("#loading-image").show(); // Show loading image
         var complain = $("#complain").val();
         if (complain==""){
            swal({ 
                   title:"Notice",
                   icon:"warning",
                   text:"Complain field cannot be empty.",
            });
         }

        var formdata = new FormData(this); 

        // Create FormData object with the form's data

        $.ajax({
            type: "POST",
            url: "engine/complain-process.php",
            data:  new FormData(this), // Send FormData object
            cache: false,
            processData: false,
            contentType: false,

            success: function(response) {
                $("#loading-image").hide(); // Hide loading image
       $('#bom').load(location.href + " #cy");
                if (response == 1) {
                    // On success, reload comments and reset form
                    $("#complain-comment-section").load("engine/view-complain.php");

                    swal({
                        text: "Complain added successfully",
                        icon: "success",
                    });

                    $("#name").val(""); // Clear name input
                    $("#complain").val(""); // Clear comment input
                    $("#complain_id").val(""); // Clear comment_id input
                    $("#fileupload").val("");
                } else {
                    swal({
                        icon: "error",
                        text: response
                    });
                }
            },

            error: function(jqXHR, textStatus, errorThrown) {
                $("#loading-image").hide(); // Hide loading image on error
                console.log("Error: " + errorThrown); // Log error
                swal({
                    icon: "error",
                    text: "An error occurred: " + errorThrown
                });
            }
        });
    });
});
</script>


<script>
    $(".likes").show();
       $(".dislikes").hide();
$(document).on('click', '.likes', function() {
    var user_id = "<?php echo$user_id ?>";
    var complain_id = $(this).attr('id');

    $.ajax({
        type: "POST",
        url: "engine/update-complain-likes.php",
        data: { 'user_id': user_id, 'complain_id': complain_id },
        success: function(response) {
        
            // Reload specific part of the page
            if (response == 1) {
                swal({
                    title: "Success!",
                    text: "Like added successfully",
                    icon: "success",
                });
                $("#complain-comment-section").load("engine/view-complain.php");

            } else if (response == 2) {
                swal({
                    title: "Notice",
                    text: "You have already liked this comment",
                    icon: "info",
                });
            } else {
              
                swal({
                    title: "Error",
                    text: response,
                    icon: "error",
                });
            }
        },
        error: function(xhr, status, error) {
            swal({
                title: "Error",
                text: "An unexpected error occurred.",
                icon: "error",
            });
        }
    });
});
</script>


<script>

$(document).on('click', '.dislikes', function() {
   var user_id = "<?php echo $user_id; ?>";
    var complain_id = $(this).attr('id');// Using data attribute



    $.ajax({
        type: "POST",
        url: "engine/update-complain-dislikes.php",
        data: { 'user_id': user_id, 'complain_id': complain_id },
        success: function(response) {
            if (response == 1) {
                swal({
                    title: "Success",
                    text: "like has been removed successfully",
                    icon: "success",
                });
                $("#complain-comment-section").load("engine/view-complain.php");

            } else {
               swal({
                    title: "Notice",
                    text: response,
                    icon: "error",
                });
            }
        },
        error: function(xhr, status, error) {
            swal({
                title: "Error",
                text: "An unexpected error occurred.",
                icon: "error",
            });
        }
    });
});
</script>
           


<script type="text/javascript">
  
function updateFileName(input) {
var fileName = input.files[0].name;
  document.getElementById('file-label').innerText = fileName;
}

</script>








</body>
</html>