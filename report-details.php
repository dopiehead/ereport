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
 
    include('engine/configure.php');
    $conn = new Database();

     // Prepare the SQL statement for views
   
     $views = "UPDATE report SET views = views +1 where id =?";
     $stmt_views = $conn->prepare($views);
     $stmt_views->bind_param('i', $id);
     $stmt_views->execute();


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
            $title = htmlspecialchars(substr($row['eventTitle'], 0, 15)); // Use htmlspecialchars to prevent XSS
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
    
} else {
    echo "Invalid or missing ID.";
}
?>


<?php

function time_ago($date) {
    // Create DateTime objects for the current time and the input date
    $now = new DateTime();
    $ago = new DateTime($date);
    
    // Subtract 1 hour from the current time
    $now->modify('-1 hour');
    
    // Calculate the time difference
    $interval = $now->diff($ago);
    
    // Determine the time ago
    if ($interval->y > 0) {
        return ($interval->y == 1) ? "A year ago" : $interval->y . " years ago";
    } elseif ($interval->m > 0) {
        return ($interval->m == 1) ? "A month ago" : $interval->m . " months ago";
    } elseif ($interval->d > 0) {
        return ($interval->d == 1) ? "Yesterday" : $interval->d . " days ago";
    } elseif ($interval->h > 0) {
        return ($interval->h == 1) ? "An hour ago" : $interval->h . " hours ago";
    } elseif ($interval->i > 0) {
        return ($interval->i == 1) ? "A minute ago" : $interval->i . " minutes ago";
    } else {
        return ($interval->s <= 5) ? "Just now" : $interval->s . " seconds ago";
    }
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

<br><br><br><br><br>

<div class="container">


    <div class="filter">
      
       <a href="">Video</a>
     
   

    </div>


<br><br>

    <div class="row">
     
         <div class="col-md-6">
             
           <figure>
            <span>Featured Story</span>
              
              <?php $thumbnailPath = 'dashboard/thumbnails/' . basename($image) . '.jpg';
              ?>
              <a id="<?php echo$id ?>" class="btn-play"><img src ="<?php echo $thumbnailPath ?>" ></a>
              <figcaption>
                <b><?php echo"<a href='report-details.php?id=".$id.">'".$title."></a>"?></b>       
              </figcaption>
             
           </figure>
<br>
           <p class="p_details"><?php echo $content; ?></p>
         
<!----------------------comment---------------------->





<div class="comment-button">
      <a id="positive" class="category-button">Positive <i class="fa fa-comments positive"></i></a> 
      <a id="negative" class="category-button">Negative  <i class="fa fa-comments negative"></i></a> 
      <a id="suggestions" class="category-button">Suggestions</a>
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
    if (isset($_SESSION['id'])){
    // Sanitize session variables
    $user_name = htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8');
    $user_img = htmlspecialchars($_SESSION['img'], ENT_QUOTES, 'UTF-8');
}
     ?>

      <?php 
      if(isset($_SESSION['id'])){?>
 <img class="reporter" src="<?php echo 'dashboard/'.$user_img ?>" alt=""> <span><?php echo $user_name; ?></span>
      <?php } else{ ?>

        <div class="d-none">
        <img class="reporter" src="<?php echo "dashboard/".$_SESSION['img'] ?>" alt=""> <span><?php echo "dashboard/".$user_name; ?></span>
        </div>
      <?php } ?>

     </div>
 
     <input type="hidden" name="id" id="id" value="<?php echo$id ?>">

       <input type="hidden" name="news_id" id="news_id" value="<?php echo$id ?>">

       <input type="hidden" name="comment_id" id="" value="">

       <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">

       <input type="hidden" name="name" id="name" value="<?php echo $user_name; ?>" >
    
      <textarea name="comment" id="comment" class="form-control comment" wrap="physical" rows="5">

     </textarea>
    
     <div class="button-comments">

     <!-- <input type="file" name='fileupload' id='fileupload' class="btn bg-primary mr-1 border border-0 rounded-pill btn-file"> -->
     
     <?php
     if(isset($_SESSION['id'])){?>
        <input type="submit" name="submit" id="submit" class="btn btn-success" value="Send">
     <?php }else{?>
        <a href="sign-in.php?details=<?php echo urlencode($_SERVER['REQUEST_URI']) ?>" class="btn btn-success">Login to continue</a>
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

            
            $id_all = $data['id'];
            $thumbnailPath_all = 'dashboard/thumbnails/' . basename($data['fileupload']) . '.jpg';
            $image = "uploads/" . htmlspecialchars($data['fileupload']); 
       

         

            ?>
    
    

     <div class="other-news">

            <div> 
                  
                  <a class='btn-play' id='<?php echo $id_all?>'><img src ="<?php echo $thumbnailPath_all ?>" alt=""></a>
             </div>

             <div class="other-news-details">
                     <div>
                        <small><?php echo $data['date'] ?></small>

                        <small>10 min read</small>
                     </div>

                        <h6><a class="text-dark" href="report-details.php?id=<?php echo$id_all; ?>"><?php echo htmlspecialchars(substr($data['eventTitle'], 0, 15));?></a></h6>
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
        <?php
    
    $conn = new Database();    
    $topdiscussions = $conn->prepare("SELECT * FROM report order by views, date desc limit 8");    
    $topdiscussions->execute();
    $topstories = $topdiscussions->get_result();
    ?>

<br>
        <h4><b>Top Stories</b></h4><br>

     <div class="top_stories">

 
<?php
    while ($datatopstories= $topstories->fetch_assoc()){
            $thumbnailPath_topstories = 'dashboard/thumbnails/' . basename($datatopstories['fileupload']) . '.jpg';
            $image = "uploads/" . htmlspecialchars($datatopstories['fileupload']); 
            $datatopstoriesId = $datatopstories['id'];
            ?>

         <div>
           <a class='btn-play' id='<?php echo$datatopstoriesId  ?>'><img src="<?php echo htmlspecialchars($thumbnailPath_topstories) ?>" alt=""></a>
           <h6><a class="text-dark" href="report-details.php?id=<?php echo $datatopstoriesId?>"><?php echo substr($datatopstories['eventTitle'],0,15) ?></a></h6>
           <small>Essential news <i class="fa fa-check"></i> </small>
           <small><?php echo$datatopstories['views']." views"." ". time_ago($datatopstories['date']) ?></small>
        </div>


    <?php } ?>

    </div>


     <br><br>  <br><br>  
  
      <h6><b>Latest Stories</b></h6>
      <?php
    
    $conn = new Database();     
    $latestdiscussions = $conn->prepare("SELECT * FROM report order by id desc limit 1");     
    $latestdiscussions->execute();
    $lateststories =  $latestdiscussions->get_result();
while ($datalateststories= $lateststories->fetch_assoc()){
        $thumbnailPath_lateststories = 'dashboard/thumbnails/' . basename($datalateststories['fileupload']) . '.jpg';
        $image = "uploads/" . htmlspecialchars($datalateststories['fileupload']); 
        $reportername = $datalateststories['reporterName'];
        $details = $datalateststories['eventDetails'];
        $date = $datalateststories['date'];
        $reporterid = $datalateststories['user_id'];
        $areaid = $datalateststories['id'];
   } ?>
      
      <?php
    
    $conn = new Database();     
    $latestdiscussionsreporter = $conn->prepare("SELECT * FROM user_profile where id =?");
    $latestdiscussionsreporter->bind_param("i",$reporterid);     
    $latestdiscussionsreporter->execute();
    $lateststoriesreporter =  $latestdiscussionsreporter->get_result();
while ($datalateststoriesreporter= $lateststoriesreporter->fetch_assoc()){       
        $reporterpic = $datalateststoriesreporter['img_upload'];
        $reporterpId = $datalateststoriesreporter['id'];
        $reporterlocation = $datalateststoriesreporter['location'];
   } ?>    


     <div class="row">

         <div class="col-md-6 latest_stories">
          
             <div>
                 <img class="reporter" src="<?php echo"dashboard/" .htmlspecialchars($reporterpic)  ?>" alt="">
          
                 <span class="reporter_name"><?php echo htmlspecialchars($reportername) ?></span> <br>

                 <h6>Top reports in your area</h6>

                 <small><?php  echo htmlspecialchars($details) ?></small>
<br><br>
                 <div class="read">
                                   
                     <p><?php  echo htmlspecialchars(time_ago($date)) ?></p>

                     <p><?php echo htmlspecialchars($reporterlocation) ?></p>
            
                  </div>

             </div>

             <div class="latest_stories_img">

                 <img class='btn-play' id='<?php echo$areaid ?>' src="<?php echo  $thumbnailPath_lateststories ?>" alt="">

             </div>



         </div>

     

         <div class="col-md-6" class="upcoming_streams">

         <?php  

$conn = new Database();

$upcoming = "SELECT * FROM report ORDER BY views ASC, date DESC LIMIT 2";

$statement = $conn->prepare($upcoming);

$statement->execute();

$result = $statement->get_result();

while($rowupcoming = $result->fetch_assoc()){

    // Correcting the path for the thumbnail image
    $thumbnailPath_upcoming = 'dashboard/thumbnails/' . basename($rowupcoming['fileupload']) . '.jpg';
    $image = "uploads/" . htmlspecialchars($rowupcoming['fileupload']); 
?>
 
 <div class="upcoming_details">
                   
    <div>
        <a class='btn-play'  id="<?php echo $rowupcoming['id'] ?>"><img src="<?php echo htmlspecialchars($thumbnailPath_upcoming); ?>" alt="Thumbnail"></a>
    </div>

    <div>
        <div class="upcoming_read">
            <p><?php echo htmlspecialchars($rowupcoming["date"]); ?></p> 
            <p>10 mins read</p>
        </div> 
        <h6><a class='text-dark' href="report-details.php?id=<?php echo $rowupcoming['id'] ?>"><?php echo htmlspecialchars($rowupcoming["eventTitle"]); ?></a></h6>
    </div>

 </div>

<?php
}
?>
             

     </div>

     </div>

</div>

</div>
<br><br>


<!-- popup video player -->

<div class="pop" id="pop">

<a class="close" id="close">&times;</a>

  <div class="video-player">


 </div>

</div>

<!-- footer -->


<?php  include 'components/footer.php'; ?>

        <script>
$(document).ready(function() {

    $("#comment-show").load("engine/view-comments.php");
    $(document).on("click", '.reply', function() {
        let comment_id = $(this).attr('id');
        $('#comment_id').val(comment_id);  // Set the comment ID in the hidden input field
        $("#comment").focus(); 
         // Focus the name input field
    });
  
    $('#commentForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission behavior
        $("#loading-image").show(); // Show loading image
       let name = $('#name').val();
       let comment = $('#comment').val();
       let comment_category = $('#comment_category').val();
       let news_id = "<?php echo $id ?>";
       if (comment ==='') {
        swal({
            title: 'Error',
            icon: 'warning',
            text:"Comment field cannot be empty"
       });
    }

    else if (name ==='') {
        swal({
            title: 'Error',
            icon: 'warning',
            text:"Name field cannot be empty"
       });
    }

    
    else if (comment_category ==='') {
        swal({
            title: 'Error',
            icon: 'warning',
            text:"Please select a comment category"
       });
    }

    else{

        let formdata = $("#commentForm").serialize(); // Create FormData object with the form's data
  
        $.ajax({
            type: "POST",
            url: "engine/comments-process.php",
            data: formdata, // Send FormData object
            cache: false,            
           success: function(response) {
                $("#loading-image").hide(); // Hide loading image

                if (response == 1) {
                    // On success, reload comments and reset form
                    $("#comment-show").load("engine/view-comments.php?id="+news_id);

                    swal({
                        text: "Comment added successfully",
                        icon: "success",
                    });

                    // Clear form inputs
                    $("#name").val("");
                    $("#comment").val("");
                    $("#comment_id").val("");
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

    }


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
                   $("#comment-show").load("engine/view-comments.php");
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

                   $("#comment-show").load("engine/view-comments.php");
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
 

<script>
$(document).on('click','.btn-play',function(){
var id = $(this).attr('id');
$.ajax({
url:"uploaded-video.php",
method:"POST",
data:{'id':id},
// cache:false,
// processData:false,
// contentType:false,
success:function(data){
$(".pop").show();
$(".video-player").html(data);

}

});
});
$(document).on('click','.close',function(){
    $(".pop").hide();
});

</script>

<script>

$(document).ready(function () {
    // Array of video sources
    var videos = "<?php echo$row['fileupload'] ?>";
    // Track the current video index
    var currentVideo = 0;

    // Get the video player and source element
    var videoPlayer = $('#videoPlayer');
    var videoSource = $('#videoSource');

    // Listen for when the video ends
    videoPlayer.on('ended', function () {
        // Move to the next video in the array
        currentVideo++;

        // If there are more videos, load and play the next one
        if (currentVideo < videos.length) {
            videoSource.attr('src', videos[currentVideo]);
            videoPlayer[0].load();  // Load the new video
            videoPlayer[0].play();  // Play the new video
        } else {
            console.log("All videos have been played.");
        }
    });
});

</script>


<script>
$(document).ready(function() {
    $(".category-button").on('click', function() {
        var comment_category = $(this).attr('id');
        var button = $(this); // Save reference to the button

        $.ajax({
            method: "POST",
            url: "engine/view-comments.php",
            data: { 'comment_category': comment_category },
            success: function(data) {
                $("#comment-show").html(data);

                // Optional: Handle response if needed
                button.css("backgroundColor", "green");
            },
            error: function(xhr, status, error) {
                // Handle error if needed
                console.error("AJAX Error: " + status + error);
            }
        });
    });
});
</script>


<button name="btn-submit" id="<?php echo $id ?>" class="btn btn-dark btn-submit">click</button>


<script>
$(document).ready(function() {
  
    $(document).ready(function() {
$(".btn-submit").click();

});


    $(".btn-submit").on('click',function() {


        let id = $(this).attr("id");

        $.ajax({
            url: "engine/view-comments.php",
            data: {'id': id},
            method: "POST",
            success: function(data) {
          
        $("#comment-show").html(data);
        
            },
            error: function(xhr, status, error) {
               swal({
                title:"Error",
               icon:"error",
               text:"An error occurred: " + error});
            }
        });
    });
});
</script>



</body>
</html>
