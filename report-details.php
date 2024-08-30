<?php session_start(); // Start the session

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
   <title>Reports / News</title>
   <link href="https://fonts.cdnfonts.com/css/helvetica-neue-55" rel="stylesheet">
   <?php  include 'components/links.php'; ?>
<link rel="stylesheet" href="css/report-details.css"> 
</head>
<body>
<?php  include 'components/layout.php'; ?>

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
              <img src="assets/images/group.jpg" alt="">
              <figcaption>
                <b>Topic of Discussion</b>       
              </figcaption>
             
           </figure>
<br>
           <p class="p_details">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, expedita! Ut, ex expedita nesciunt beatae blanditiis aliquam enim facilis possimus, consequatur eius soluta neque? Ex dicta nostrum earum quae porro?</p>
         
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
             <optionn value="suggestions">Suggestions</option>  
         </select>

     </div>

      <div class="commenter"><img class="reporter" src="<?php echo $_SESSION['img']?>" alt=""> <span><?php echo $user_name; ?></span></div>
        

       <input type="hidden" name="comment_id" id="comment_id">

       <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">

       <input type="hidden" name="name" id="name" value="<?php echo $user_name; ?>" >
    
      <textarea name="comment" id="comment" class="form-control comment" wrap="physical" rows="5">

     </textarea>
    
     <div class="button-comments">

     <input type="file" name='fileupload' id='fileupload' class="btn btn-file">
     <input type="submit" class="btn btn-success" value="Send">
     </div>

    </form>
    

</div>

    
        
        </div>




        <div class="col-md-6" >

             <div class="other-news">

                 <div>
                  <img src="assets/images/blog-y.jpg" alt="">
                 </div>

                 <div class="other-news-details">
                    <div>
                          <small>21 Aug 2024</small>

                          <small>10 min read</small>
                     </div>

                     <h6>Topic of Discussion</h6>
                 </div>

             </div>   
             
             <div class="other-news">

                 <div>
                  <img src="assets/images/blog-y.jpg" alt="">
                 </div>

                 <div class="other-news-details">
                    <div>
                          <small>21 Aug 2024</small>

                          <small>10 min read</small>
                     </div>

                     <h6>Topic of Discussion</h6>
                 </div>

             </div> 

             <div class="other-news">

                 <div>
                  <img src="assets/images/blog-y.jpg" alt="">
                 </div>

                 <div class="other-news-details">
                    <div>
                          <small>21 Aug 2024</small>

                          <small>10 min read</small>
                     </div>

                     <h6>Topic of Discussion</h6>
                 </div>

             </div> 



               <div class="comment-show" id="comment-show">


                
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
<br><br>
<?php  include 'components/footer.php'; ?>

<!-- Include jQuery and SweetAlert2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
</script>
            

</body>
</html>