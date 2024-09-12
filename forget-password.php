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

     <form method="POST" action="">


     <div class="form-container">

     <h6 class="text-bold text-center"><b>Reset Password</b></h6><br>
   
      <input type="text" class="form-control" placeholder="Enter your Email"><br>
       
      <button name="submit" class="btn btn-danger form-control">Send</button>
      </form>


     </div>

</div>
    
<br><br>
<?php  include 'components/footer.php'; ?>
</body>
</html>

<?php 

if(isset($_POST['submit'])){
$email = $_POST['email'];
     if($email===""){
       echo "Please enter your email address";
    }
     elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo"Email format not supported"; 
     }
     else{
      include 'configure.php';
      $conn = new Database();
       $stmt = $conn->prepare("SELECT * FROM user_profile WHERE email =?");
       $stmt->bind_param('s', $email);
       $stmt->execute();
       $result = $stmt->get_result();
       $count = $result->num_rows();
      if($count===0){
      echo "You are not a registered user";
      }
       else{
           $query = "insert into forgotten (email) values(?)";
            $stmt2 =$conn->prepare($query);
            $stmt2->bind_param('s',$email);
            if($stmt2===false){
               echo "Prepared statement failed";
                 }
      else{
        $stmt2->execute();
        if($stmt2->execute()){
          require 'PHPMailer-master/PHPMailer-master/PHPMailerAutoload.php';

$mail= new PHPMailer;

$mail->SMTPDebug = 0;  
                    // Enable verbose debug output
    $mail->isSMTP();   
                                             // Send using SMTP
    $mail->Host='https://server39.web-hosting.com';
    
    $servername="localhost";
  
$mail->Port=465;

$mail->SMTPAuth=true;

$mail->SMTPSecure='ssl';

$mail->Username='potgrcqi';

$mail->Password='3pps4BsvsZxq';

$mail->setFrom('info@pot-gob-us.com','Ereport');

$mail->addAddress($email);

$mail->isHTML(true);

$mail->Subject="Password Reset";

$mail->MsgHTML("<meta name='color-scheme' content='light only'>

<meta name='supported-color-schemes' content='light only'>

<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'>

<div class='container'>

<div d-flex justify-content-space-between align-items-center'>

<h5 class='fw-bold text-dark'>Reset Password</h5>

<img src = 'https://maxcdn.bootstrapcdn.com/bootstrap/' width='80' height='80' alt ='logo'>

</div>

<p class='text-center mt-1'>Hi </p>

<p class='text-center'>We're sending you this email because you requested a password reset. Click on the link provided to create a new password:</p>

<div class='text-center mx-2 '><a class='text-white fw-bold btn btn-danger rounded rounded-pill p-2' href ='http://e-stores.com/forgotten-password.php?vkey=$vkey'>Change Password</a><br></b></div>

<p class='text-center mt-1'>If you didn't request a password reset, you can ignore this email. Your password will not be changed.</p>


   <h6 class='fw-bold text-dark text-center mt-1'>The Ereport team</h6>

</div>

");


if (!$mail->send()) {$error ="mensaje no enviado".$mail->ErrorInfo;
  
}

        }
        }    

                 }

}

}

?>