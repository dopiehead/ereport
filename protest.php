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

         <img class="user_image mr-2 mb-2" src="assets/images/IMG_E7548.jpg" alt=""><span class="user_name">Name</span>

            <input type="hidden" name="user_name" id="user_name" value="">

            <input type="hidden" name="user_email" id="user_email" value=""><br>

            <textarea name="message" style="font-size:13px;" id="message" class="form-control" wrap="physical" placeholder="...Start a protest" rows="5" ></textarea> 
             
            <div class="d-flex justify-content-space-around align-items-center">
            <button class="btn-comment mt-3 w-50 mr-3">Post <i class="fa fa-chevron-right"></i></button>
            <button class="btn-comment mt-3 w-50 p-1">Upload Photo <i class="fa fa-camera"></i></button>
            </div>
     
         </div>
       <br><br>
        
         <div class="protest-comment-section">
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
              <span class="heart p-4"><i class="fa fa-heart"></i> </span>   <span class="hand p-3"><i class="fa fa-hand"></i> </span> <span class="reply p-3"><a href="">Reply</a></span>
         
         </div>

     </div>

</div>
<br><br>


<?php include 'components/footer.php';?>
</body>
</html>