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

     <div class="form-container">
       
      <label for="email">Email</label>
      <input type="text" class="form-control" placeholder="Enter your Email"><br>
       
       <label for="password">Password</label>
      <input type="password" class="form-control" placeholder="Ener your Password"><br>

      <button class="btn btn-danger form-control">Sign in</button>
       
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
</body>
</html>