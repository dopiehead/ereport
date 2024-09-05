<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forget Password</title>
    <?php  include 'components/links.php'; ?>
    <link rel="stylesheet" href="css/forget-password.css">

</head>
<body>

<?php  include 'components/layout.php'; ?>

<br><br>

<div class="container login-container">

     <div class="img_container">
    
       <img src="assets/images/sign-in/popo.png" alt="">

     </div>

     <div class="form-container">

     <h6 class="text-bold text-center"><b>Reset Password</b></h6><br>
   
      <input type="text" class="form-control" placeholder="Enter your Email"><br>
       

      <button class="btn btn-danger form-control">Send</button>



     </div>

</div>
    
<br><br>
<?php  include 'components/footer.php'; ?>
</body>
</html>