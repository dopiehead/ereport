<?php session_start();
error_reporting(E_ALL ^ E_NOTICE);
?>
<?php

if (isset($_GET['details']) && !empty($_GET['details'])) {
$details = $_GET['details'];
$url_details = $details;

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>log in</title>
    <?php  include 'components/links.php'; ?>
    <link rel="stylesheet" href="css/sign-in.css">

</head>
<body>

<?php  include 'components/layout.php'; ?>

<br><br>

<div class="container login-container">

     <div class="img_container">
       
       <img src="assets/images/sign-in/popo.png" alt="">

     </div>

     <div class="form-container mt-5">
       <form id="signin-form">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email"><br>
       
       <label for="password">Password</label>
      <input type="password" name="password" id="password" class="form-control" placeholder="Enter your Password"><br>
   
      <button class="btn btn-danger btn-signin form-control">Sign in</button>

      <?php include 'components/loader.php'; ?>
      </form>
      <br>
      
             <div class="account-container">
                 <a href="forget-password.php">Forget Password</a>
                 <a href="create-account.php" >Create Account</a>                
             </div>

             <br>
     </div>

</div>
    
<br><br>
<?php  include 'components/footer.php'; ?>


<input type="hidden" id="url_details" value="<?php echo$url_details;?>">
<script type="text/javascript">

// var url = $('#url').val();
var url_details = $('#url_details').val();
$('.btn-signin').on('click',function(e){
e.preventDefault();
$("#loading-image").show();
$('.btn-signin').prop('disabled', true);
 $.ajax({

            type: "POST",
            url: "engine/sign-in-process.php",
            data:  $("#signin-form").serialize(),
            cache:false,
            contentType: "application/x-www-form-urlencoded",
             success: function(response) {
             $("#loading-image").hide();
             if (response==1)  {
                if(url_details==''){
              window.location.href = "../ereport/dashboard/dashboard.php";}
              else{
                 window.location.href = url_details;
              }
                 $("#signin-form")[0].reset();
             }                                 
          else{            
            swal({
            	icon:"error",
            	text:response
            });
          $('.btn-signin').prop('disabled', false);         
           $("input").css('border-color','red');           
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