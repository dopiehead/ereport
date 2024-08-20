<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Groups</title>
    <?php  include 'components/links.php'; ?>
     <link rel="stylesheet" href="css/groups.css">
</head>
<body>
<?php  include 'components/layout.php'; ?>

<div class="hero-section">

<div class="hero-text">

  <h3>
 Ereport's Groups
  </h3>
<br><br>


</div>

</div> 




<div class="container">
<div class="join_group">
         <a href="" class="">
          Join
          </a>
     </div>

     <br><br><br><br>
     
     <div class="justify-start">
       <a onclick="openModal()" type="button" class="btn btn-primary">Post</a> 
       <a id="anonymous_post" class="anonymous_post btn btn-primary">Anonymous Post</a> 
       <a id="members" class="members btn btn-primary">Members</a>
     </div>
                              <br>
     <div class="row">

         <div class="col-md-6">
            
             <div class="comment_container">

             <div id='user_image'>

                 <img src="assets/images/IMG_E7548.jpg" alt="Placeholder" style="width:50px;height:50px;border-radius:50%;" class="">
                     <input type="text" placeholder="Type something..."><br>
                     <div class="secret_column">
                     <span id="secret"><i class="fa fa-user-secret"></i>Anonymous Post</span> <span><a class="btn btn-primary"> Post</a></span>
                     </div>

             </div>
                                                                                                               <br>

                                                                                                   <br>

                     <div id="comment_section">

                         <ul id="real_agent_info">

                                 <li>

                                    <img class="real_agent" src="" alt=""><strong>Anonymous</strong><span></span>

                                 </li>

                                 <li id="real_estate_agent">

                                   <!-- <strong >Real Estate Agent</strong> -->

                                 </li>

                         </ul>



                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem facilis voluptatem ab repudiandae tenetur nobis illum, expedita sequi. Maxime molestias dignissimos ipsam vero maiores non temporibus beatae excepturi soluta modi?</p>



                                                                                                                    <hr>

                         <div class="icons">

                             <span id="like"><i class="fa fa-thumbs-up"></i> like</span>

                             <span id="comment"><i class="fa fa-comment"></i> comment</span>

                    </div>


                                                                                                                     <hr>

                                                                    <br>

                 <span>View More Comment</span> <br><br>

                 <img class="real_agent" src="" alt=""> <span>Anonymous</span><br> <span class="time"></span>

                     <div id="reply">

                     <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis excepturi dolorem, possimus provident beatae modi maiores sed nemo obcaecati quod, deserunt ad culpa atque inventore ab a molestiae veritatis laboriosam.</p>

                     </div>

                     <div class="reply_icons">
                           <span><i class="fa fa-thumbs-up "></i> Like</span>
                           <span><i class="fa fa-comment "></i> Comment</span>

                     </div>
                           <br>


                           <div id='user_image'>

                            <img src="assets/images/IMG_E7548.jpg" alt="Placeholder" style="width:50px;height:50px;border-radius:50%;" class="">
                                <input type="text" class="border border-gray-300 rounded " placeholder="  Type something..."><br>


                        </div>

                       </div>  

                    </div>

                           <br><br>
                          




<!------------------------------------------ members--------------------------------->


                    <div id='user_details' class="user_details" style=''>



                             <div id="figure">

                                 <img src="assets/images/operator.png" alt="user">

                                 <h6>Mally Cleff</h6>

                                 <span>5 Followers</span>

                                 <button class="btn btn-primary">Connect</button>
                        
                             </div>






                             <div id="figure">

                                    <img src="assets/images/laundry.jpg" alt="user">

                                     <h6>Mally Cleff</h6>

                                     <span>5 Followers</span>

                                     <button class="btn btn-primary">Connect</button>

                             </div>



                             <div id="figure">
                                       <img src="assets/images/download.jpg" alt="user">
                                       <h6>Mally Cleff</h6>
                                        <span>5 Followers</span>
                                        <button class="btn btn-primary">Connect</button>

                             </div>


                             <div id="figure">
                                        <img src="assets/images/user-x.jpg" alt="user">

                                         <h6>Mally Cleff</h6>

                                      <span>5 Followers</span>

                                         <button class="btn btn-primary">Connect</button>

                             </div>






                    </div>



            </div>




            <div id="popup">
            <a onclick="openModal()" id="closeModal">&times;</a>
            <form>
             
            <img class="anonymous_img" src="assets/images/IMG_E7548.jpg"> 
            
            <br>
            <br>
            
            <input type="text" style=" width: 100%;" class="form-control" placeholder="Title">

            <div id="group_button" class="container">
            <button class="btn btn-cancel"><i class="fa fa-user-secret" style="opacity:0.7"></i> Cancel</button>
            <button class="btn btn-create">Create</button><br><br>
            </div>
            <label for="">Update group image</label><br>

            <div class="upload_photo">

             <i class="fa fa-upload"></i><br>
              
             <span class="click_to_upload">Click to upload</span><br>


            </div>
                     <br>

            <span class="file_type">GIF</span><span class="file_type">JPEG</span><span class="file_type">JPG</span> > <span>10MB</span>

            <div class="commentator">
            <img class="anonymous_img" src="assets/images/IMG_E7548.jpg" style="margin-top:-10px;">  <textarea name="brief_description" placeholder="Brief description" id="brief_description" cols="39" rows="3" wrap="physical"></textarea>
            </div>
            
            <div class="add_members_background">

            <div id="add_members">

            <span>Add members</span> <i class="fa fa-plus"></i>

            </div>

            </div>


            <div style="display: none;text-align:center;" id="loading-image"><img id="loader" height="50" width="50" src="loading-image.GIF"></div>
            </form>
             </div>


                      <br> 

   
<!----------------- Section b       ----------------->

<div class="col-md-6">


      <div id="group-home">

         <h4>About Group</h4>

          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quo dolore eius ipsam quibusdam nesciunt alias? Obcaecati ad facere corrupti temporibus officia, ipsum, excepturi libero quaerat nulla natus illo velit necessitatibus.</p>

         <button class="btn btn-primary">Share Group</button>

     </div>



<!----------------- Other groups       ----------------->


        <div class="other_groups" id="group-home">
              <h4>Other Groups</h4><br>


          <div class="group_inc_home">

             <div class="group_inc">
                      <img src="assets/images/group.jpg" alt="">
                      <h6><b>IT news</b></h6>
                     <span>1 member</span> <span> 0 posts today</span><br>

                     <a class="btn btn-primary" href="">Join</a>
             </div>


            <div  class="group_inc">
                     <img src="assets/images/group.jpg" alt="">
                         <h6><b>IT news</b></h6>
                              <span>1 member</span> <span> 0 posts today</span><br>
                              
                     <a class="btn btn-primary" href="">Join</a>

            </div>

             <div  class="group_inc">
                     <img src="assets/images/group.jpg" alt="">
                          <h6><b>IT news</b></h6>
                              <span>1 member</span> <span> 0 posts today</span><br>
                              
                     <a class="btn btn-primary" href="">Join</a>
             </div>

             <div  class="group_inc">
                  <img src="assets/images/group.jpg" alt="">
                     <h6><b>IT news</b></h6>
                     <span>1 member</span> <span> 0 posts today</span><br>

                     <a class="btn btn-primary" href="">Join</a>
              </div>

              </div>
            
         </div>

</div>

</div>


<!-- end of showing ads --->
</div>


<?php  include 'components/footer.php';?>

<script>

$('#user_details').hide();

$('#members').on('click',function(e){

 e.preventDefault();

 $("#members").addClass('btn-red');

 $("#anonymous_post").removeClass('btn-primary');

 $("#anonymous_post").removeClass('btn-red');

$(".comment_container").hide();

 $('#user_details').toggle(100);





});



$("#anonymous_post").on('click',function(e){

 $(this).addClass('btn-red');

 e.preventDefault();

 $('#members').removeClass('btn-red');

 $(".comment_container").toggle(100);

 $('#user_details').hide();

});


function openModal() {
 
 var popup = document.getElementById('popup');
 popup.classList.toggle('active');
 }


 function report(){
   var popup = document.getElementById('popup-report');
   popup.classList.toggle('active');
 }

</script>
</body>
</html>