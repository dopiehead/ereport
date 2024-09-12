<?php 
session_start(); 
$user_name = "John Smith";
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
if (isset($_SESSION['id'])): 
    // Sanitize session variables
    $user_name = htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8');
    $user_img = htmlspecialchars($_SESSION['img'], ENT_QUOTES, 'UTF-8');
    
?>

    <img class="user_image mr-2 mb-1" src="<?php  echo 'dashboard/'.$user_img; ?>" alt=""><span class="user_name"><?php echo $user_name; ?></span>        

<?php else: ?>

    <i class="fa fa-user-alt user_image mr-2 mb-1"></i> <span class="user_name">John Smith</span>    

<?php endif; ?>

            
         <form  id="protestForm">

         <input type="hidden" name="protest_id" class="protest_id" id="protest_id">

            <input type="hidden" name="user_id" id="user_id" value="<?php echo$user_id ?>"><br>

            <input type="hidden" name="name" id="user_name" value="<?php echo$user_name ?>">

            <input type="hidden" name="user_email" id="user_email" value="<?php echo$_SESSION['email'] ?>"><br>

            <textarea name="protest" style="font-size:13px;" id="protest" class="form-control protest_section" wrap="physical" placeholder="...Start a protest" rows="5" ></textarea> 
             
            <div class="d-flex justify-content-space-around align-items-center">
             
            <?php if(isset($_SESSION['id'])){ ?>
            <button class="btn-comment mt-2 w-50 mr-3 p-2 ">Post <i class="fa fa-chevron-right"></i></button>
            <label class="btn-comment mt-3 w-50 p-2 d-flex justify-content-center align-items-center gap-5">
              <span id="file-label"> Upload Photo<i class="fa fa-camera ml-3"></i></span> <span id="fileName">
    
    </span>
               <input type="file" name="fileupload" id="fileupload" class="d-none" accept="image/*"  onchange="updateFileName(this)">
               
</label> <?php } else{?>
    <a class="btn btn-primary" href="sign-in.php?id=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">Login to continue</a>
    <?php } ?>
       </form>
          </div>
     
         </div>
       <br><br>
        
         <div class="protest-comment-section" id="protest-comment-section">
               <div class="user-container">        

               </div>
            
         </div>

     </div>

</div>
<br><br>


<?php include 'components/footer.php';?>
<script>
$(document).ready(function() {
    // Load the initial content
    $("#protest-comment-section").load("engine/view-protest.php");

    // Handle reply button click
    $(document).on("click", '.btn_reply', function() {
        var protest_id = $(this).attr('id');
        $('.protest_id').val(protest_id);
        $(".protest_section").focus();
    });

    // Handle form submission
    $('#protestForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Show loading image
        $("#loading-image").show();

        // Get form values
        var name = $("#user_name").val(); 
        var protest = $("#protest").val();

        // Validate form inputs
        if (name === '') {
            $("#loading-image").hide(); // Hide loading image
            swal({
                title: "Notice",
                icon: "warning",
                text: "Name field cannot be empty"
            });
            return; // Stop the execution of the function
        }

        if (protest === '') {
            $("#loading-image").hide(); // Hide loading image
            swal({
                title: "Notice",
                icon: "warning",
                text: "Protest field cannot be empty"
            });
            return; // Stop the execution of the function
        }

        // Create FormData object
        var formdata = new FormData(this);

        // Send AJAX request
        $.ajax({
            type: "POST",
            url: "engine/protest-process.php",
            data: formdata, 
            contentType: false, // Required for FormData
            processData: false, // Required for FormData
            success: function(response) {
                $("#loading-image").hide(); // Hide loading image

                if (response == 1) {
                    // On success, reload comments and reset form
               

                    swal({
                        text: "Protest added successfully",
                        icon: "success",
                    });

                    $("#protest-comment-section").load("engine/view-protest.php");

                    // Clear form fields
                    $("#name").val("");
                    $("#protest").val("");
                    $("#protest_id").val("");
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
    var protest_id = $(this).attr('id');
    
    $.ajax({
        type: "POST",
        url: "engine/update-protest-likes.php",
        data: { 'user_id': user_id, 'protest_id': protest_id },
        success: function(response) {
            
            $('.fa-thumbs-up').load(location.href + " #cy"); // Reload specific part of the page
            if (response == 1) {
                swal({
                    title: "Success!",
                    text: "Like added successfully",
                    icon: "success",
                });
                $("#protest-comment-section").load("engine/view-protest.php");
            } else if (response == 2) {
                swal({
                    title: "Notice",
                    text: "You have already liked this comment",
                    icon: "info",
                });
            } else {

               
                swal({
                    title: "Error",
                    text: "An error occurred while liking the comment",
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
$(document).on('click', '.dislike', function() {
    var user_id = "<?php echo $user_id; ?>";
    var protest_id = $(this).attr('id');

     // Using data attribute


    $.ajax({
        type: "POST",
        url: "engine/update-protest-dislikes.php",
        data: { 'user_id': user_id, 'protest_id': protest_id },
        success: function(response) {
     
            if (response == 1) {
                swal({
                    title: "Success",
                    text: "Dislike removed successfully",
                    icon: "success",
                });
                $("#protest-comment-section").load("engine/view-protest.php");

           $('#bom').load(location.href + " #cy");
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