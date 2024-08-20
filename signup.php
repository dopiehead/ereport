<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <?php  include 'components/links.php'; ?>
    <link rel="stylesheet" href="css/signup.css">

</head>
<body>
       
<?php  include 'components/layout.php'; ?>

 

<br><br>

 <div class="container">

     <div class="form-container">

         <div class="user">

             <div class="step_1">
                  <i class="fa fa-user-alt"></i> 
                  <h6>Step 1</h6>
                  <p>Personal information</p>
             </div>  
             
             <div class="step_2">
                  <i class="fa fa-user-alt"></i> 
                  <h6>Step 2</h6>
                  <p>Complaint Details</p>
             </div> 

             <div class="step_3">
                  <i class="fa fa-user-alt"></i> 
                  <h6>Step 3</h6>
                  <p>Evidence Upload</p>
             </div> 
                 
             
         </div>


        <div class="form-input">

         <div class="row">

             <div class="col-md-6">

                  <label for="first_name">First Name</label>
             
                  <input type="text" class="form-control" placeholder="Your First Name">
             
             </div>

             <div class="col-md-6">

                  <label for="last_name">First Name</label>
             
                 <input type="text" class="form-control"  placeholder="Your Last Name">
             
             </div>

         </div>

         <div class="row">

             <div class="col-md-6">

                  <label for="email_address">Email Address</label>

                  <input type="email" class="form-control" placeholder="Your Email Lddress">

              </div>

             <div class="col-md-6">

                   <label for="phone_number">Phone Number</label>

                    <input type="number" class="form-control"  placeholder="Your Phone number">

              </div>

          </div>


          <label for="address">Address</label>

          <input type="text" class="form-control" placeholder="Your Home Address">

<br><br>
          <span class='arrow-right'><a href="">Next <i class="fa fa-arrow-right"></i></a></span>

<br><br>

<!------------------------Step 2---------------------------------------->
  
     <div class="row">

         <div class="col-md-6">

         <label for="offender">Name Of Offender</label>
          
         <input type="text" class="form-control" placeholder="Name">
         
        </div>

         <div class="col-md-6">

         <label for="addressOffender">Address of Offender</label>

         <input type="text" class="form-control" placeholder="Address">
  
         </div>

     </div>

     <div class="row">

         <div class="col-md-6">

         <label for="Date of Event">Date of Event</label>
          
         <input type="text" class="form-control" placeholder="Date">
         
        </div>

         <div class="col-md-6">

         <label for="Time of Event">Time of Event</label>

         <input type="text" class="form-control" placeholder="Time">
  
         </div>

     </div>

     <label for="Details of Event">Details of Event</label>

     <input type="text" class="form-control" placeholder="Text Here">
  
    
     <label for="Purpose of reporting">Purpose of reporting</label>

     <input type="text" class="form-control" placeholder="Text Here">
    
     <br>

     <h6>Who would you like us to report to (Please thick)</h6>

     <input type="checkbox"> Manager <br>
     <input type="checkbox"> Owner <br>
     <input type="checkbox"> The government <br>
     <input type="checkbox"> Police <br>

     <br>

     <h6>Will you like to be anonymous (Please thick)</h6>
     
     <input type="checkbox"> Yes <br>
     <input type="checkbox"> No<br>
     <br>


     <h6>Which category are you reporting for (Please thick)</h6>
     
     <input type="checkbox"> Inefficiency <br>
     <input type="checkbox"> Negligence <br>
     <input type="checkbox"> Rape <br>
     <input type="checkbox"> Insult<br>
     <input type="checkbox"> Assault <br>
     <input type="checkbox"> Bad Approach<br>
     <input type="checkbox"> Murder<br>
     <input type="checkbox"> Abuse<br>
     <input type="checkbox"> Others<br>

     <br><br>
     <span class='arrow-left'><a href=""> <i class="fa fa-arrow-left"></i> Previous</a></span>
     <span class='arrow-right'><a href="">Next <i class="fa fa-arrow-right"></i></a></span>

 <br><br>
     
<!------------------------Step 3---------------------------------------->
 <br><br>
 <div>

       <h6>Voice record Upload</h6>

       <div class="file-container">
       <label class="file-upload" for="file-upload">Upload voice record
       <input type="file">
       </label>

       </div>

 </div>

                    <br>

 <div>


       <h6>Voice evidence Upload</h6>
       <div class="file-container">
       <label class="file-upload" for="file-upload">Upload Evidence record
       <input type="file">
       </label>
       </div>

 </div>

    <br><span class='arrow-right'><a href="">Done</a></span>
<br>











      </div>


    
 </div>

</div>

 <br>  <br> 

<?php  include 'components/footer.php'; ?>
</body>
</html>