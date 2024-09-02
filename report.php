<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report</title>
</head>
<body>
<?php  include 'components/links.php'; ?>
    <link rel="stylesheet" href="css/blog.css">
</head>
<body>
   
<?php  include 'components/layout.php'; ?>

<div class="hero-section">

<div class="hero-text">


  <h3>
   E-report's <span>Updates</span>  
  </h3>
 <br><br>
</div>

</div>

<div class="container search-container">
     
      <input type="text" name="" placeholder="Search for reports...">
              
        <select name="newsType" id="newsType">
            
             <option value="video">Video</option>

             <option value="audio">Audio</option>

             <option value="news">News</option>

         </select>

</div>

<br><br>  
<div>

<div class="blog-post-container">
                
            <div class="people-container">
                <!-- display content from db--->
                <div class="db-user">
                    <h3 id="txt-trending-post">Trending Posts</h3>

              <div class="container time_posted">
                
                <select name="date_posted" id="date_posted" class="date_posted">
                  
                   <option value="video">Recently added</option>
      
                   <option value="audio">Most viewed</option>
      
                   <option value="news">Most comment</option>
      
               </select>
             </div>
                    <div class="container trending-section">
                        <div class="post">
                            <div class="post-image"><img src="https://placehold.co/600x400/000000/FFFFFF/png" alt="The post image"></div>
                            <div class="calendar"><i class="fa fa-calendar"></i> FEBRUARY 28,2024 <i class="fa fa-user"></i> BY  <small style="color:red">ADMIN</small></div>
                            <div class="post-title"><h3>Short Event title on Topic</h3></div>
                            <div class="post-link"><a href="report-details.php">Read More <i class="fas fa-arrow-right"></i></a></div>
                        </div>
                
                        <div class="post">
                            <div class="post-image"><img src="https://placehold.co/600x400/000000/FFFFFF/png" alt="The post image"></div>
                            <div class="calendar"><i class="fa fa-calendar"></i> FEBRUARY 28,2024 <i class="fa fa-user"></i> BY  <small style="color:red">ADMIN</small></div>
                            <div class="post-title"><h3>Short Event title on Topic</h3></div>
                            <div class="post-link"><a href="#">Read More <i class="fas fa-arrow-right"></i></a></div>
                        </div>
                
                        <div class="post">
                            <div class="post-image"><img src="https://placehold.co/600x400/000000/FFFFFF/png" alt="The post image"></div>
                            <div class="calendar"><i class="fa fa-calendar"></i> FEBRUARY 28,2024 <i class="fa fa-user"></i> BY  <small style="color:red">ADMIN</small></div>
                            <div class="post-title"><h3>Short Event title on Topic</h3></div>
                           <div class="post-link"><a href="#">Read More <i class="fas fa-arrow-right"></i></a></div>
                        </div>
                       
                        <div class="post">

                        
                            <div class="post-image"><img src="https://placehold.co/600x400/000000/FFFFFF/png" alt="The post image"></div>
                            <div class="calendar"><i class="fa fa-calendar"></i> FEBRUARY 28,2024 <i class="fa fa-user"></i> BY  <small style="color:red">ADMIN</small></div>
                            <div class="post-title"><h3>Short Event title on Topic</h3></div>
                            
                            <div class="post-link"><a href="#">Read More <i class="fas fa-arrow-right"></i></a></div>
                        </div>
                
                        <div class="post">
                            <div class="post-image"><img src="https://placehold.co/600x400/000000/FFFFFF/png" alt="The post image"></div>
                            <div class="calendar"><i class="fa fa-calendar"></i> FEBRUARY 28,2024 <i class="fa fa-user"></i> BY  <small style="color:red">ADMIN</small></div>
                            <div class="post-title"><h3>Short Event title on Topic</h3></div>
                            <div class="post-link"><a href="#">Read More <i class="fas fa-arrow-right"></i></a></div>
                        </div>
                    </div>
                </div>
                <!--- end of each user item container -->
<br><br><br>
</div>

<div class="container">
    
<div class="ads-right">
        
        <img src="assets/images/ads/ad1.png" alt="">
    
        <img src="assets/images/ads/ad2.png" alt="">
    
        <img src="assets/images/ads/ad3.png" alt="">
    
        <img src="assets/images/ads/ad4.png" alt="">
    
        </div>
        </div>


<?php  include 'components/footer.php'; ?>




</body>
</html>