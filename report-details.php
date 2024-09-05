<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Reports / News</title>
   <link href="https://fonts.cdnfonts.com/css/helvetica-neue-55" rel="stylesheet">
   <?php  include 'components/links.php'; ?>
<link rel="stylesheet" href="css/report-details.css"> 
</head>
<body>
<?php  include 'components/layout.php'; ?>
<?php  // Start the session

if (isset($_SESSION['name']) && $_SESSION['name'] != "") {
   $user_name =  $_SESSION['name']; 
   $user_id =  $_SESSION['id']; 
  

} 
else{
    $user_name = "John Smith";
    $img_upload = "<i class='fa fa-user-alt'></i>";
}
?>

<?php 
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id']; // Ensure $id is an integer to prevent SQL injection

    include_once('engine/configure.php');
    $conn = new Database();

    // Prepare the SQL statement
    $sql = "SELECT * FROM report WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Failed to prepare statement: " . $stmt->error); // Display the actual error
    }

    // Bind the parameter
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute() === false) {
        die("Failed to execute statement: " . $stmt->error); // Display the actual error
    }

    // Get the result set
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $title = htmlspecialchars(substr($row['eventDetails'], 0, 15)); // Use htmlspecialchars to prevent XSS
            $content = htmlspecialchars($row['eventDetails']);
            $date = htmlspecialchars($row['eventDate']);
            $author = htmlspecialchars($row['reporterName']);          
            $category = explode(" ", htmlspecialchars($row['reportCategory']));
            
            foreach ($category as $report) {
               $news = htmlspecialchars($report) . "<br>";
            }
            
            $image = "uploads/" . htmlspecialchars($row['fileupload']);
            
        }
    } else {
        echo "No reports found for the given ID.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid or missing ID.";
}
?>










<!-- <div class="hero-section">

<div class="hero-text">

  <h3>
   E-report's <span>Updates</span>  
  </h3>
 <br><br>
</div>

</div> -->

<br><br><br><br>


<div class="container">


    <div class="filter">
      
       <a href="">Video</a>
     
       <a href="">News</a>

    </div>


<br><br>

    <div class="row">
     
         <div class="col-md-6">
             
           <figure>
            <span>Featured Story</span>
              
              <?php $thumbnailPath = 'dashboard/thumbnails/' . basename($image) . '.jpg';
              ?>
              <img src ="<?php echo $thumbnailPath ?>" >
              <figcaption>
                <b><?php echo$title?></b>       
              </figcaption>
             
           </figure>
<br>
           <p class="p_details"><?php echo $content; ?></p>
         
<!----------------------comment---------------------->
<div class="comment-button">
      <a>Positive <i class="fa fa-comments positive"></i></a> 
      <a>Negative  <i class="fa fa-comments negative"></i></a> 
      <a>Suggestions</a>
</div>
<form id="commentForm">
<div class="comment-section">
     <div class="user-selection">
         <select name="comment_category" id="comment_category"> 
             <option value="">Choose Category</option>  
             <option value="positive">Positive Comments</option>
             <option value="negative">Negative Comments</option> 
             <option value="suggestions">Suggestions</option>  
         </select>

     </div>

      <div class="commenter">
        
      <?php 
      if(isset($_SESSION['id'])){?>
 <img class="reporter" src="<?php echo $_SESSION['img'] ?>" alt=""> <span><?php echo $user_name; ?></span>
      <?php } else{ ?>

        <div class="d-none">
        <img class="reporter" src="<?php echo $_SESSION['img'] ?>" alt=""> <span><?php echo $user_name; ?></span>
        </div>
      <?php } ?>

     </div>
        

       <input type="hidden" name="comment_id" id="comment_id" value="<?php echo $id ?>">

       <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">

       <input type="hidden" name="name" id="name" value="<?php echo $user_name; ?>" >
    
      <textarea name="comment" id="comment" class="form-control comment" wrap="physical" rows="5">

     </textarea>
    
     <div class="button-comments">

     <!-- <input type="file" name='fileupload' id='fileupload' class="btn bg-primary mr-1 border border-0 rounded-pill btn-file"> -->
     
     <?php
     if(isset($_SESSION['id'])){?>
        <input type="submit" class="btn btn-success" value="Send">
     <?php }else{?>
        <a href="login.php?details=<?php echo urlencode($_SERVER['REQUEST_URI']) ?>" class="btn btn-success">Login to continue</a>
     <?php } ?>


     </div>

    </form>
    

</div>

    
        
        </div>

        <div class="col-md-6" >

        <?php 

    $conn = new Database();

    // Prepare the SQL statement
    $get_all = "SELECT * FROM report order by id desc limit 4";
    $getreport = $conn->prepare($get_all);
    
    if ($getreport === false) {
        die("Failed to prepare statement: " . $getreport->error); // Display the actual error
    }

    // Bind the parameter
   

    // Execute the statement
    if ($getreport->execute() === false) {
        die("Failed to execute statement: " . $getreport->error); // Display the actual error
    }

    // Get the result set
    $result_report = $getreport->get_result();
    
    if ($result_report->num_rows > 0) {
        while ($data = $result_report->fetch_assoc()) { 
            
            $thumbnailPath_all = 'dashboard/thumbnails/' . basename($data['fileupload']) . '.jpg';
            $image = "uploads/" . htmlspecialchars($data['fileupload']); 
       

         

            ?>
    
    

     <div class="other-news">

            <div> 
                  
                  <img src ="<?php echo $thumbnailPath_all ?>" alt="">
             </div>

             <div class="other-news-details">
                     <div>
                        <small><?php echo $data['date'] ?></small>

                        <small>10 min read</small>
                     </div>

                        <h6><?php echo htmlspecialchars(substr($data['eventDetails'], 0, 15));?></h6>
             </div>

     </div>     
          
            
           
   <?php 

        }
    } else {
        echo "No report(s) found .";
    }

    // Close the statement and connection
    $getreport->close();
    $conn->close();

?>
  
   
    <div class="comment-show" id="comment-show">


                
               </div> 

             </div>







        </div>

</div>

</div>

<br>

<div class="container">

<div class="ads-right">
        
        <img src="assets/images/ads/ad1.png" alt="">
    
        <img src="assets/images/ads/ad2.png" alt="">
    
        <img src="assets/images/ads/ad3.png" alt="">
    
        <img src="assets/images/ads/ad4.png" alt="">
    
        </div>



<br>
        <h4><b>Top Stories</b></h4><br>

     <div class="top_stories">

        <div>
           <img src="assets/images/blog-x.jpg" alt="">
           <h6>Topic of Discussion</h6>
           <small>Essential news <i class="fa fa-check"></i> </small>
           <small>23k views .2 Days ago</small>
        </div>

        <div>
           <img src="assets/images/blog-x.jpg" alt="">
           <h6>Topic of Discussion</h6>
           <small>Essential news <i class="fa fa-check"></i> </small>
           <small>23k views .2 Days ago</small>
        </div>

        <div>
           <img src="assets/images/blog-x.jpg" alt="">
           <h6>Topic of Discussion</h6>
           <small>Essential news <i class="fa fa-check"></i> </small>
            <small>23k views .2 Days ago</small>
        </div>

        <div>
           <img src="assets/images/blog-x.jpg" alt="">
           <h6>Topic of Discussion</h6>
           <small>Essential news <i class="fa fa-check"></i> </small>
           <small>23k views .2 Days ago</small>
        </div>

        <div>
           <img src="assets/images/blog-x.jpg" alt="">
           <h6>Topic of Discussion</h6>
           <small>Essential news <i class="fa fa-check"></i> </small>
           <small>23k views .2 Days ago</small>
        </div>

        <div>
           <img src="assets/images/blog-x.jpg" alt="">
           <h6>Topic of Discussion</h6>
           <small>Essential news <i class="fa fa-check"></i> </small>
           <small>23k views .2 Days ago</small>
        </div>



    </div>


     <br><br>
  
      <h6><b>Latest Stories</b></h6><br>
         

     <div class="row">

         <div class="col-md-6 latest_stories">
          
             <div>
                 <img class="reporter" src="assets/images/IMG_E7548.jpg" alt="">
          
                 <span class="reporter_name">Adewale Musa</span> <br>

                 <h6>Top reports in your area</h6>

                 <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, incidunt debitis. Maiores vero iste tenetur eligendi delectus id in iure velit adipisci, eius quasi molestiae magnam, nam, perspiciatis possimus reprehenderit!</small>
<br><br>
                 <div class="read">
                                   
                     <p>July 20th 2024</p>

                     <p>10 min read</p>
            
                  </div>

             </div>

             <div class="latest_stories_img">

                 <img src="assets/images/blog-z.jpg" alt="">

             </div>



         </div>

     

         <div class="col-md-6" class="upcoming_streams">


                       
                 <div class="upcoming_details">
                   
                     <div>
                         <img src="assets/images/blog.jpg" alt="">
                     </div>

                     <div>
                        
                         <div class="upcoming_read">

                                <p>Aug 21 2024</p>
                                <p>10 mins read</p>

                          </div> 

                        <h6>Topic of Discussion</h6>

                     </div>

                 </div>




                 <div class="upcoming_details">
                   
                   <div>
                       <img src="assets/images/blog.jpg" alt="">
                   </div>

                   <div>
                      
                       <div class="upcoming_read">

                              <p>Aug 21 2024</p>
                              <p>10 mins read</p>

                        </div> 

                      <h6>Topic of Discussion</h6>

                   </div>

               </div>








                 <div class="upcoming_details">
                   
                   <div>
                       <img src="assets/images/blog.jpg" alt="">
                   </div>

                   <div>
                      
                       <div class="upcoming_read">

                              <p>Aug 21 2024</p>
                              <p>10 mins read</p>

                        </div> 

                      <h6>Topic of Discussion</h6>

                   </div>

               </div>



         
         </div>

     </div>

</div>

</div>
<br><br>
<?php  include 'components/footer.php'; ?>

<!-- Include jQuery and SweetAlert2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $("#comment-show").load("engine/view-comments.php");

    $(document).on("click", '.reply', function() {
        var comment_id = $(this).attr('id');
        $('#comment_id').val(comment_id);  // Set the comment ID in the hidden input field
        $("#name").focus();  // Focus the name input field
    
    });
$('#commentForm').on('submit', function(e) {
        e.preventDefault(); 
        $("#loading-image").show(); // Show loading image

        var formdata = new FormData(this); // Create FormData object with the form's data

        $.ajax({
            type: "POST",
            url: "engine/comments-process.php",
            data: formdata, // Send FormData object
            cache: false,
            processData: false,
            contentType: false,

            success: function(response) {
                $("#loading-image").hide(); // Hide loading image

                if (response == 1) {
                    // On success, reload comments and reset form
                    $("#comment-show").load("engine/view-comments.php");

                    swal({
                        text: "Comment added successfully",
                        icon: "success",
                    });

                    $("#name").val(""); // Clear name input
                    $("#comment").val(""); // Clear comment input
                    $("#comment_id").val(""); // Clear comment_id input
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
        url: "engine/update-report-likes.php",
        data: { 'user_id': user_id, 'comment_id': comment_id },
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
    var comment_id = $(this).attr('id');
    
    $.ajax({
        type: "POST",
        url: "engine/update-report-dislikes.php",
        data: { 'user_id': user_id, 'comment_id': comment_id },
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

            $(document).on('click', '.btn-play', function(){
                let id = $(this).attr('id');
                $.ajax({
                    url: "uploaded-video.php",
                    method: "POST",
                    data: { 'id': id },
                    success: function(data){
                        $(".popup").show();
                        $(".video-player").html(data);
                    }
                });
            });

            $(document).on('click', '.close', function(){
                $(".popup").hide();
    });
});
</script>
            

</body>
</html>
