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
<div class="trending-home">                
                        
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
    
    </div>


<?php  include 'components/footer.php'; ?>

<script>
$(".trending-home").load("engine/report-read-process.php");


</script>


</body>
</html>