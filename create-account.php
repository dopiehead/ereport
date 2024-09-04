<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <?php  include 'components/links.php'; ?>
    <link rel="stylesheet" href="css/create-account.css">

</head>
<body>

<?php  include 'components/layout.php'; ?>

<br><br>

<div class="container login-container">

     <div class="img_container">
     
     <br>

 
       <img src="assets/images/sign-in/popo.png" alt="">

     </div>

     <div class="form-container">

     <form id="create-account">

     <h6 class="text-bold text-center"><b>Join Us</b></h6><br>
     
      <input type="text" name="name"  id="name" class="form-control" placeholder="Enter your Fullname"><br>
       
      <input type="text" name="email" id="email" class="form-control" placeholder="Enter your Email"><br>
            
      <input type="password" name="password" class="form-control" placeholder="Enter your Password"><br>

      <input type="password" name="cpassword" class="form-control" placeholder="Confirm your Password"><br>

      <input type="hidden" name="blacklist" value="0">
   
      <input type="hidden" name="country" value="0">
   
      <input type="hidden" name="whatsapp" value="0">
   
      <input type="hidden" name="location" value="0">
   
      <input type="hidden" name="facebook" value="0">
   
      <input type="hidden" name="twitter" value="0">
   
      <input type="hidden" name="linkedin" value="0">
  
      <input type="hidden" name="instagram" value="0">
   
      <input type="hidden" name="verified" value="0">

      <input type="hidden" name="img_upload" id="img_upload" value="0">

      <button class="btn btn-danger btn-signup form-control">Sign Up</button>
       
      <?php include 'components/loader.php'; ?>

      </form>

      <br>
      
             <div class="account-container">

                 <a href="sign-in.php">Have an account? Log in</a>
                               
             </div>

             <br>
     </div>

</div>
    
<br><br>
<?php  include 'components/footer.php'; ?>

<script type="text/javascript">

$('#create-account').on('submit',function(e){

      e.preventDefault();

      $("#loading-image").show();

       $('.btn-signup').prop('disabled', true);
      
      var formdata = new FormData();


    $.ajax({

          type: "POST",

          url: "engine/sign-up-process.php",

          data:new FormData(this),

          cache:false,

          processData:false,

          contentType:false,

           success: function(response) {

           $("#loading-image").hide();

if (response==1) {

        
            swal({
                     text:"A verification link has been sent to the email provided",
                    icon:"success",

            });

            $("#create-account")[0].reset();
             

} 

else{
            swal({

              icon:"error",
              text:response

            });

            $('.btn-signup').prop('disabled', false);
          
            $('input').css('border-color','red');

            
          

          
             

         }

          },

          error: function(jqXHR, textStatus, errorThrown) {

              console.log(errorThrown);

          }

      })

  });





</script>





</body>
</html>