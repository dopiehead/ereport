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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Protest</title>
    <?php  include 'components/links.php'; ?>
    <link rel="stylesheet" href="css/protest.css">
    <link rel="stylesheet" href="css/navlinks.css">
</head>
<body>
<?php  include 'components/layout.php'; ?>

    <div class="hero-section">
         <div class="hero-text">
             <h3>
                  Protest
             </h3>
<br><br>
</div>
</div>
<br><br>
<div class="container">
  
      
     <div class="protest-container">
            
         <div class="post-comment-container mx-3">

         <?php

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $name = $_SESSION['name'];
    $img = '<img src="' . htmlspecialchars($_SESSION['img'], ENT_QUOTES, 'UTF-8') . '" alt="User Image" class="user_image mr-2 mb-2">';

} else {

    $img = '<i class="fa fa-user-alt"></i>';
}
?>

         <?php echo$img ?><span class="user_name"><?php echo$name?></span>
            
         <form  id="protestForm">
         <input type="hidden" name="protest_id" id="protest_id">

            <input type="hidden" name="user_id" id="user_id" value="<?php echo$user_id ?>"><br>

            <input type="hidden" name="name" id="user_name" value="<?php echo$name; ?>">

            <input type="hidden" name="user_email" id="user_email" value="<?php echo$id; ?>"><br>

            <textarea name="protest" style="font-size:13px;" id="message" class="form-control" wrap="physical" placeholder="...Start a protest" rows="5" ></textarea> 
             
            <div class="d-flex justify-content-space-around align-items-center">
            <button class="btn-comment mt-3 w-50 mr-3">Post <i class="fa fa-chevron-right"></i></button>
            <label class="btn-comment mt-3 w-50 p-1 d-flex justify-content-center align-items-center gap-5">
               Upload Photo<i class="fa fa-camera ml-3"></i>
               <input type="file" name="fileupload" id="fileupload" class="d-none">
            </label>
       </form>
          </div>
     
         </div>
       <br><br>
        
         <div class="protest-comment-section" id="protest-comment-section">
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
<br><br>


<?php include 'components/footer.php';?>

<script>
$(document).ready(function() {
    $("#protest-comment-section").load("engine/view-protest.php");
    $(document).on("click", '.reply', function() {
        var protest_id = $(this).attr('id');
        $('#protest_id').val(protest_id);  // Set the comment ID in the hidden input field
        $("#name").focus();  // Focus the name input field
    
    });
$('#protestForm').on('submit', function(e) {
        e.preventDefault(); 
        $("#loading-image").show(); // Show loading image

        var formdata = new FormData(this); // Create FormData object with the form's data

        $.ajax({
            type: "POST",
            url: "engine/protest-process.php",
            data: formdata, // Send FormData object
            cache: false,
            processData: false,
            contentType: false,

            success: function(response) {
                $("#loading-image").hide(); // Hide loading image

                if (response == 1) {
                    // On success, reload comments and reset form
                    $("#protest-comment-section").load("engine/view-protest.php");

                    swal({
                        text: "Protest added successfully",
                        icon: "success",
                    });

                    $("#name").val(""); // Clear name input
                    $("#protest").val(""); // Clear comment input
                    $("#protest_id").val(""); // Clear comment_id input
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
        url: "engine/update-protest-likes.php",
        data: { 'user_id': user_id, 'protest_id': protest_id },
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
                    text: "You have already liked this comment",
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
    var protest_id = $(this).attr('id');
    
    $.ajax({
        type: "POST",
        url: "engine/update-protest-dislikes.php",
        data: { 'user_id': user_id, 'protest_id': protest_id },
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