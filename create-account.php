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

     <h6 class="text-bold text-center"><b>Join Us</b></h6><br>
    
 
      <input type="text" class="form-control" placeholder="Enter your Fullname"><br>
       
       
   
      <input type="text" class="form-control" placeholder="Enter your Email"><br>
       
     
      <input type="password" class="form-control" placeholder="Ener your Password"><br>

 
      <input type="password" class="form-control" placeholder="Confirm your Password"><br>

      <button class="btn btn-danger form-control">Sign Up</button>
       
      <br>
      
             <div class="account-container">
                 <a href="sign-in.php">Have an account? Log in</a>
                               
             </div>

             <br>
     </div>

</div>
    
<br><br>
<?php  include 'components/footer.php'; ?>
</body>
</html>