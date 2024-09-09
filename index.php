<?php session_start(); ?>
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


<?php include('engine/configure.php'); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <?php  include 'components/links.php'; ?>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/navlinks.css">

</head>
<body>
   
<?php  include 'components/layout.php'; ?>

<div class="hero-section">

 <div class="hero-text">

     <div class="text-container" style="width:100%;">

         <div class="text-slide">
              <h3>Be a <span>Reporter</span> and an <br>Investigative Journalist</h3>
          </div>

         <div class="text-slide">
             <h3>
              Empower your <span>voice</span>,<br>
              Report injustice, Assault and Corruption.
             </h3>
         </div>

         <div  class="text-slide">
          <h3>Making public <span>complaint</span> <br>count</h3>
         </div> 

     </div> 

  <p>Help us build a transparent and trustworthy community <br>by reporting Bad Practices, Fraud and Negligence</p>
  <br><br>

  <?php if(isset($_SESSION['id'])){?>
 <a href="dashboard/post-report.php"  style='font-size:15px;'>Get started</a>
  <?php }else{ ?>
    <a href='sign-in.php?details=dashboard/post-report.php'  style='font-size:15px;'>Get started</a>
  <?php } ?>
  

 </div>

</div>


<div class="content_home">

  <div class="content-container container">

        <br><br>

     <div class="report">

         <div>
             <h5>Make a report</h5>

             <p>Ensure your voice is heard by submitting <br>detailed reports wih supporting evidence.</p>
         </div>


         <div>

              <a href='report.php' class="btn btn-danger">View all</a>

         </div>


         
         </div>


         <div class="navigation">

        
         <div class="naviLinks">

         <a href="report.php?search=hotel"><img src="assets/images/menu/hotel.png"></a>

         <p>hotel</p>

         </div>


        
         <div class="naviLinks">

         <a href="report.php?search=business owner"><img src="assets/images/menu/business-owner.png"></a>

         <p>business owner</p>

         </div>
         
         
         <div class="naviLinks">

         <a href="report.php?search=service provider"><img src="assets/images/menu/service-provider.png"></a>

         <p>service provider</p>

         </div>


         <div class="naviLinks">

         <a href="report.php?search=bank"><img src="assets/images/menu/bank.png"></a>

           <p>Banks</p>

         </div>

    

         <div class="naviLinks">

         <a href="report.php?search=drugs"><img src="assets/images/menu/drugs.png"></a>
            
           <p>drugs</p>

         </div>


         <div class="naviLinks">

         <a href="report.php?search=army"><img src="assets/images/menu/army.png"></a>

<p>army</p>

</div>




<div class="naviLinks">

<a href="report.php?search=electricity"><img src="assets/images/menu/electricity.png"></a>

<p>electricity</p>

</div>


<div style="background-color:skyblue;" class="naviLinks">

<p><a style="color:white;" href="categories.php">See more</a></p>

</div>


     </div>

     <br><br>
     
      <?php include 'components/ads.php' ?>     

     <br><br>

      </div> 

     </div>

      <?php include 'components/calltoaction.php';  ?>

   <br>

     <div class="container e_report">

        <br>
     <h6>Ereport in numbers</h6>
     <br>




         <div class="row in_numbers">

         <div class="col-md-2 sorted">
        <h6 id="counter1" class="counter" data-start="0" data-end="1" data-duration="2500">0</h6>
        <p>Sorted Reports</p>
         </div>
      
   







    <div class="col-md-2 nreports">
        <?php  $conn = new Database(); 
        $getreportnumber = $conn->prepare("SELECT  COUNT(*) AS count FROM report");
        $getreportnumber->execute();
        $getreportnumber_result =  $getreportnumber->get_result();
       while ($getnumrep = $getreportnumber_result->fetch_assoc()){
         $numberofreport = $getnumrep['count'];
       }  
       $conn->close();
         ?>

        <h6 id="counter2" class="counter" data-start="0" data-end="<?php echo$numberofreport; ?>" data-duration="2500">0</h6>
        <p>Number of Reports</p>
     </div>


     <div class="col-md-2 sorted ">
     <?php  $conn = new Database(); 
        $getreportnumberpending = $conn->prepare("SELECT  COUNT(*) AS count FROM report where pending = 0");
        $getreportnumberpending->execute();
        $getreportnumber_result_pending =  $getreportnumberpending->get_result();
       while ($getnumrep_pending = $getreportnumber_result_pending->fetch_assoc()){
         $numberofreportpending = $getnumrep_pending['count']; ?>
         <h6 id="counter3" class="counter" data-start="0" data-end="<?php echo$numberofreportpending ?>" data-duration="2500">0</h6>
       <?php } 
       $conn->close(); 
         ?>

     
        
        <p>Pending Reports</p>
     </div>


     <div class="col-md-2 nreports">
     <?php
$conn = new Database();
$result = $conn->prepare("SELECT COUNT(*) AS count FROM user_profile WHERE verified = 1");
$result->execute();
$get_result = $result->get_result();
while ($getnumresult = $get_result->fetch_assoc()){ $getnumresult = $getnumresult['count']; ?>
 <h6 id="counter4" class="counter" data-start="0" data-end="<?php echo$getnumresult ?>" data-duration="2500">0</h6>
<?php } ?> 

<p>Registered Members</p>
     </div>



<div class="col-md-2 sorted ">

     <?php
$conn = new Database();
$resultComplain = $conn->prepare("SELECT COUNT(*) AS count FROM complain");
$resultComplain->execute();
$get_result = $resultComplain->get_result();
while ($getnumresult = $get_result->fetch_assoc()){ echo"<h6 class='counter'>".$getnumresult = $getnumresult['count']."</h6>"; ?>
 <h6 id="counter5" class="counter d-none" data-start="0" data-end="<?php echo$getnumresult['count'];?>" data-duration="2500">0</h6>
        
<?php } ?> 
<p>number of complaints</p>
</div>


<div class="col-md-2 sorted ">
         <?php
$conn = new Database();
$resultProtest = $conn->prepare("SELECT COUNT(*) AS count FROM protest");
$resultProtest->execute();
$get_result = $resultProtest->get_result();
while ($getnumresult = $get_result->fetch_assoc()){ echo"<h6 class='counter text-danger'>".$getnumresult = $getnumresult['count']."</h6>"; ?>
 <h6 id="counter6" class="counter d-none" data-start="0" data-end="<?php echo$getnumresult['count'];?>" data-duration="2500">0</h6>
        
<?php } ?> 

       <p class="text-danger">number of protests</p>
         </div>

    

</div>

</div>

<br><br>



<div class="experience-section">
<br>
     <div class="row">

         <div class="col-md-6 ">

                  <a href="">Who we are</a>   <br>   

                 <h6>Your experience Matters</h6>

                 <p>At E-reports, We are dedicated to promoting transparency and accountability in consumer interactions. We believe individual deserves fair treatment and a voice to address grievances effecively.</p>

                  <br>
                 <div class="sub_experience">
                 <span><i class="fa fa-check"></i> Empowering Your Voice</span>
                 <p>We provide a platform for individuals to report misconduct with confidence</p><br>


                 <span><i class="fa fa-check"></i> Community-Driven Approach</span>
                 <p>We provide a platform for individuals to report misconduct with confidence</p><br>
                 
                 <?php if (!isset($_SESSION['id'])) {?>

                     <a class="btn btn-danger" href="sign-in.php?details=dashboard/post-report.php">Make a Report <i class="fa fa-arrow-right"></i></a>
                 <?php

                 } else{ ?>

                    <a class="btn btn-danger" href="dashboard/post-report.php">Make a Report <i class="fa fa-arrow-right"></i></a>
                 
                 <?php } ?>

                </div>
         </div>

         <div class="col-md-6 fade-in">

         <img src="assets/images/book.jpg" alt="">


         </div>

     </div>
</div>

<div class="container work-section">
<br>
<br>

       <div class="text-center">
     <h6 class="how_it_works">How it works</h6>
     <p class="steps">Four easy steps to carry out when you exprience a problem with your vehicle on the road.</p>
     </div>

     <div class="circle-container">
     <div>
         <div class="circle"><img src="assets/images/book.jpg"></div>
         <h6>Submit your report</h6>
         <p>Fill out our easy-to-use form with details about the incident</p>
     </div>
     
     <svg width="200" height="200" viewBox="0 0 100 100">
    <path d="M 10 80 A 45 45 0 0 1 90 80" fill="transparent" stroke="black" stroke-width="2" stroke-dasharray="4"/>
</svg>

     <div class="circle_Home">
         <div class="circle"><img src="assets/images/book.jpg"></div>
         <h6>Upload Evidence</h6>
         <p>Upload video and audio recordings that support your report.</p>
     
     </div>


     <div>
       
         <div class="circle"><img src="assets/images/book.jpg"></div>
         <h6>Review and Approval</h6>
         <p>Our team reviews your submission for validity and relevance.</p>
    
     </div>

     <svg width="200" height="200" viewBox="0 0 100 100">
    <path d="M 10 80 A 45 45 0 0 1 90 80" fill="transparent" stroke="black" stroke-width="2" stroke-dasharray="4"/>
</svg>


     <div class="circle_Home">
          <div class="circle"><img src="assets/images/book.jpg"></div>
          <h6>Resolution and Feedback </h6>
          <p>Recieve updates on the status of your reports and its resolution
          </p>
     </div>

  </div>

</div>


<!-- <div class="container blog-section">

     <h5>Reports <span class="see_more"><a href="report.php">See more</a></span></h5><br>

     <div class="blog-container">
      
         <div>
   
              <figure><img src="assets/images/blog.jpg" alt=""></figure>

              <span><i class="fa fa-calendar"></i> FEBRUARY 28,2024 <i class="fa fa-user"></i> BY  <small style="color:red">ADMIN</small></span>
 
             <strong>Short Event Title on Topic</strong><br>
             <br>
             <a href="report-details.php">Read more <i class="fa fa-arrow-right"></i></a>
         </div>


         <div>

              <figure><img src="assets/images/blog-x.jpg" alt=""></figure>

             <span><i class="fa fa-calendar"></i> FEBRUARY 28,2024 <i class="fa fa-user"></i> BY  <small style="color:red">ADMIN</small></span>
 
             <strong>Short Event Title on Topic</strong><br>
             <br>

             <a>Read more <i class="fa fa-arrow-right"></i></a>

         </div>


      
         <div>

              <figure><img src="assets/images/blog-z.jpg" alt=""></figure>

              <span><i class="fa fa-calendar"></i> FEBRUARY 28,2024 <i class="fa fa-user"></i> BY <small style="color:red">ADMIN</small></span>
 
             <strong>Short Event Title on Topic</strong><br>
              <br>
             <a href="report-details.php">Read more <i class="fa fa-arrow-right"></i></a>

             </div>


     </div> -->




</div>



<div class="container blog-section">

     <h5>Reports/Videos <span class="see_more"><a href="report.php">See more</a></span></h5><br>




     <div class="blog-container">
      
        
   
         <?php 


         $conn = new Database();
         $getvideo = $conn->prepare("select * from report");
         $getvideo->execute();
         $result=$getvideo->get_result();
         while ($row = $result->fetch_assoc()){
            $image = "uploads/" . htmlspecialchars($row['fileupload']);
            $id = $row['id'];
            ?>
          <?php $thumbnailPath = 'dashboard/thumbnails/' . basename($image) . '.jpg';
              ?>
         <div>
         <figure>
              
         <a id="<?php echo$id ?>" class="btn-play"><img src ="<?php echo $thumbnailPath ?>" ></a>
         </figure>

       <span><i class="fa fa-calendar"></i> <?php echo $row['eventDate'] ?> <i class="fa fa-user"></i> BY  <small class="text-capitalize" style="color:red"><?php echo$row['reporterName']  ?></small></span>

      <strong class="text-dark text-capitalize"><?php echo$row['eventTitle'] ?></strong>
      <br>
      <a href='report-details.php?id=<?php echo $row['id'] ?>'>Read more <i class="fa fa-arrow-right"></i></a><br>
<div class="d-flex justify-content-space-between align-items-center w-100 gap-20 pt-3">
      <span class=" mr-3"><i class="fa fa-eye"></i><?php echo $row['views'] ?></span>
        <span class="mr-3"><i class="fa fa-comments"></i><?php echo $row['comments'] ?></span>
         <span class="mr-3"  id='ereport/index.php?share =<?php echo$row["eventTitle"]?>'  onclick='share()'><i class="fa fa-share-alt"></i><?php echo $row['share'] ?></span> 
</div>
  </div>

     <?php } ?>

    
     </div>


<br><br>
<div class="w-100 ml-5">

         <h5>Short Videos   <span class="see_more"><a href="videos.php">See more</a></span></h5><br>

     <div style="margin-top:-100px;" class="video-container">

     <video  controls>
        <source src="assets/video/video.mp4" type="video/mp4">
     </video>

     <video  controls>
        <source src="assets/video/video.mp4" type="video/mp4">
     </video>

    <video  controls>
    <source src="assets/video/video.mp4" type="video/mp4">
    </video>


    <video  controls>
    <source src="assets/video/video.mp4" type="video/mp4">
    </video>
  

     </div>

</div>




<br><br>

<div class="container">

<h5>Groups you may like <span class="see_more"><a href="groups.php">See more</a></span></h5><br>

     <div class="group-container">

     <?php 
     $conn = new Database();
       $getgroup = $conn->prepare("SELECT * FROM groups");
       $getgroup->execute();
   
        $group_result = $getgroup->get_result();
        while ($data = $group_result->fetch_assoc()) {
          ?>

<div class="group_inc">
      
      <img src="<?php echo $data['group_img'] ?>" alt="group">

      <h6><?php echo $data['group_name'] ?></h6>

      <p><span>Member</span> <span><?php echo $data['member'] ?></span>  <span><?php echo $data['posts'] ?> Posts</span>   <span><?php echo time_ago($data['date']) ?></span></p>

      <a href=groups.php>Join</a>

      <br>

</div>


      <?php  }

       
     ?>

     </div>


</div>



<div class="pop" id="pop">

<a class="close" id="close">&times;</a>

  <div class="video-player">


 </div>

</div>

</div>

<br><br><br>

<?php  include 'components/footer.php';  ?>

<script>
$('.video-container').flickity({
 
 cellAlign: 'left',
 contain: true,
 autoPlay:true,
 pageDots:false,
 prevNextButtons: false,
 imagesLoaded:true

});
</script>



<script>
$('.group-container').flickity({
 
 cellAlign: 'left',
 contain: true,
 autoPlay:true,
 pageDots:false,
 prevNextButtons: false,
 imagesLoaded:true

});
</script>


<script>
$(document).ready(function() {
    // Function to animate the counter
    function animateValue(id, start, end, duration) {
        var range = end - start;
        var current = start;
        var increment = end > start ? 1 : -1;
        var stepTime = Math.abs(Math.floor(duration / range));
        var obj = $('#' + id);
        var timer = setInterval(function() {
            current += increment;
            obj.text(current);
            if (current == end) {
                clearInterval(timer);
            }
        }, stepTime);
    }

    // Function to check if an element is in viewport
    function isElementInViewport(el) {
        var rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    // Function to start counter animation when the element is in view
    function startCounterWhenInView() {
        $('.counter').each(function() {
            var $this = $(this);
            if (isElementInViewport(this) && !$this.hasClass('started')) {
                $this.addClass('started');
                animateValue(this.id, parseInt($this.data('start')), parseInt($this.data('end')), parseInt($this.data('duration')));
            }
        });
    }

    // Attach scroll event listener to trigger the animation when in view
    $(window).on('scroll', function() {
        startCounterWhenInView();
    });

    // Initial check if counters are in view
    startCounterWhenInView();
});

</script>

<script>

    $(document).ready(function() {
        var slides = $('.text-slide');
        var currentSlide = 0;

        function showNextSlide() {
            var previousSlide = currentSlide;
            currentSlide = (currentSlide + 1) % slides.length;

            $(slides[previousSlide]).removeClass('active').addClass('previous');
            $(slides[currentSlide]).removeClass('previous').addClass('active');
        }

        // Initialize the first slide
        $(slides[currentSlide]).addClass('active');

        // Set interval to slide through the text
        setInterval(showNextSlide, 3800); // Change text every 3 seconds
    });

</script>

<script>
    $(document).ready(function() {
        // Check if the element is in the viewport
        function checkVisibility() {
            $('.fade-in').each(function() {
                var elementTop = $(this).offset().top;
                var viewportBottom = $(window).scrollTop() + $(window).height();
                if (elementTop < viewportBottom - 50) {
                    $(this).addClass('visible');
                }
            });
        }

        // On scroll event
        $(window).on('scroll', function() {
            checkVisibility();
        });

        // Initial check
        checkVisibility();
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
    // PHP array of video sources should be output as a JSON array
    var videos = <?php echo json_encode($row['fileupload']); ?>;
    
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

    // Initialize the first video
    if (videos.length > 0) {
        videoSource.attr('src', videos[currentVideo]);
        videoPlayer[0].load();  // Load the first video
        videoPlayer[0].play();  // Play the first video
    }
});
</script>




<script>
function share() {
    var url = $('.share').attr('id');
    var encodedUrl = encodeURIComponent(url);
    var facebookShare = "https://www.facebook.com/sharer/sharer.php?u=" + encodedUrl;
    var twitterShare = "https://twitter.com/intent/tweet?url=" + encodedUrl;
    var linkedinShare = "https://www.linkedin.com/shareArticle?url=" + encodedUrl;
    window.open(facebookShare, "_blank");
    window.open(twitterShare, "_blank");
    window.open(linkedinShare, "_blank");
}
</script>

</body>
</html>








