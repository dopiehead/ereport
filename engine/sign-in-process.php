<?php 
include('configure.php');
include('UserAuth.php');

$db = new Database();
$UserAuth = new UserAuth($db);

        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($UserAuth->login($email, $password)) {
            echo"1";
        } else {
            echo"Incorrect details. Try again.";
        }
    

?>
