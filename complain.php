<?php session_start(); // Start the session
error_reporting(E_ALL ^ E_NOTICE);
if (isset($_SESSION['name']) && $_SESSION['name'] !== "") {
   $user_name =  $_SESSION['name']; 
   $user_id =  $_SESSION['id']; 
   $img_upload = $_SESSION['img']; 

} 
else{
    $user_name = "John Smith";
    $img_upload = "<i class='fa fa-user-alt'></i>";
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
            
         <div class="complain-comment-container mx-3">

         <img class="user_image mr-2 mb-2" src="assets/images/IMG_E7548.jpg" alt=""><span class="user_name">Name</span>
        
         <form id="complainForm">
             
         <input type="hidden" name="complain_id" id="complain_id"> 

            <input type="hidden" name="user_name" id="user_name" value="<?php echo$user_name?>">

            <input type="hidden" name="user_id" id="user_id" value="<?php echo$user_id ?>"><br>

            <textarea name="complain" style="font-size:13px;" id="complain" class="form-control" wrap="physical" placeholder="...Write a complain" rows="5" ></textarea> 

            <div class="d-flex justify-content-space-between align-items-center">
            <button class="btn-comment mt-3 w-50 mr-3">Post <i class="fa fa-chevron-right"></i></button>
            <label class="btn-comment mt-3 w-50 p-1 d-flex justify-content-center align-items-center gap-5">
               Upload Photo<i class="fa fa-camera ml-3"></i>
               <input type="file" name="fileupload" id="fileupload" class="d-none">
</label>
            <form>
         </div>
       <br><br>
        
         <div class="complain-comment-section" id="complain-comment-section">
               <div class="user-container">        
                     <div>
                          <img src="assets/images/IMG_E7548.jpg" alt=""> 
                          <span class="user_name">Adewale Musa</span>
                     </div>
                     <div>
                          <span class="user_time">2 hours ago</span>
                     </div>
               </div>
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Optio adipisci laboriosam odio voluptas cum blanditiis provident laudantium aperiam a sunt! Libero minus corrupti animi inventore tenetur velit, modi veniam id.</p>
              <span class="heart p-4 likes"><i class="fa fa-heart"></i> </span>   <span class="hand p-3 dislikes"><i class="fa fa-hand"></i> </span> <span class="reply p-3"><a class="reply">Reply</a></span>
         
         </div>

     </div>

</div>


<?php include 'components/footer.php'; ?>
<script>
$(document).ready(function() {
    $("#complain-comment-section").load("engine/view-complains.php");
    $(document).on("click", '.reply', function() {
        var comment_id = $(this).attr('id');
        $('#complain_id').val(complain_id);  // Set the comment ID in the hidden input field
        $("#name").focus();  // Focus the name input field
    
    });
$('#complainForm').on('submit', function(e) {
        e.preventDefault(); 
        $("#loading-image").show(); // Show loading image

        var formdata = new FormData(this); // Create FormData object with the form's data

        $.ajax({
            type: "POST",
            url: "engine/complain-process.php",
            data: formdata, // Send FormData object
            cache: false,
            processData: false,
            contentType: false,

            success: function(response) {
                $("#loading-image").hide(); // Hide loading image

                if (response == 1) {
                    // On success, reload comments and reset form
                    $("#complain-comment-section").load("engine/view-complains.php");

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
$(document).on('click', '.likes', function() {
    var user_id = "<?php echo $user_id; ?>";
    var comment_id = $(this).attr('id');
    
    $.ajax({
        type: "POST",
        url: "engine/update-complain-likes.php",
        data: { 'user_id': user_id, 'complain_id': complain_id },
        success: function(response) {
        
            $('#bom').load(location.href + " #cy"); // Reload specific part of the page
            if (response == 1) {
                swal({
                    title: "Success!",
                    text: "Like added successfully",
                    icon: "success",
                });
            } else if (response == 2) {
                swal({
                    title: "Notice",
                    text: "You have already liked this complain",
                    icon: "info",
                });
            } else {

                alert(response);
                // swal({
                //     title: "Error",
                //     text: "An error occurred while liking the comment",
                //     icon: "error",
                // });
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
    var comment_id = $(this).attr('id');
    
    $.ajax({
        type: "POST",
        url: "engine/update-complain-dislikes.php",
        data: { 'user_id': user_id, 'complain_id': complain_id },
        success: function(response) {
            if (response == 1) {
                swal({
                    title: "Success!",
                    text: "Like removed successfully",
                    icon: "success",
                });
            } else {

                swal(response);
                
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
            
</body>
</html>