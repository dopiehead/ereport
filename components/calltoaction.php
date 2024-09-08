
 <link rel="stylesheet" href="css/calltoaction.css">

 <div class="container">

     <div class="row calltoaction">
      
         <div class="col-md-2">
                <br>
              <a class="agents">Agents</a>
              <br>
              <br>
        
         </div>

         <div class="col-md-4">
          
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores totam quibusdam ducimus soluta quasi! Omnis esse atque odit optio sunt.</p>
        
         </div>

         <div class="col-md-6">
          
              <img src="assets/images/handshake.jpg" alt="">
        
         </div>


     </div>


     <br>

     <br>

     <div class="row">
       
         <div class='col-md-6  property_container'>

        

             <div class="property_note">
                   <h6>Post your property</h6><br>
                  <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa assumenda, vero dignissimos tempore dolor minima neque nulla sequi.</p>
                  <a>Post your Property</a>
             </div>

             <div>

                 <img src="assets/images/house.jpg">

             </div>

            

         </div>

         <div class="col-md-6 request">

           <h6>Make a request</h6>
           <br>
           <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa assumenda,vero dignissimos tempore dolor minima neque nulla sequi.</p>
           <br>
           <a class="aRequest">Requests</a><a class="vRequest">View Requests</a>

         </div>
           
     </div>


     <div class="banner_info">

      <h6>Whatever information shared with us is Protected</h6>
      
      <br>
  <?php if(isset($_SESSION['id'])){ ?>
     <a href="dashboard/post-report.php">Report</a>
  <?php }else{ ?>
       <a href="sign-in.php?details=dashboard/post-report.php">Report</a>
       <?php } ?> 

     </div>

</div>
