<?php 
include('configure.php');
include('UserAuth.php');

$db = new Database();
$UserAuth = new UserAuth($db);

// Get POST data
$name = $_POST['name'] ?? ''; // Use null coalescing operator to provide a default value
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$cpassword = $_POST['cpassword'] ?? '';
// Default to '0' if not set
$country = $_POST['country'] ??'0';
$img_upload = $_POST['img_upload'] ??'0';
$blacklist = $_POST['blacklist'] ??'0';
$whatsapp = $_POST['whatsapp'] ??'0';
$location = $_POST['location'] ??'0';
$facebook = $_POST['facebook'] ??'0';
$twitter = $_POST['twitter'] ??'0';
$linkedin = $_POST['linkedin'] ??'0';
$instagram = $_POST['instagram'] ??'0';
$verified = $_POST['verified'] ?? '0'; 
$date = date("D, F d, Y g:iA", strtotime('+1 hours'));
$vkey = md5(time() . $email);

// Perform validation
$errors = [];

if (empty($email.$name.$password.$cpassword)) {
    $errors[] = "All fields are required";
}


elseif ($password !== $cpassword) {
    $errors[] = "Passwords do not match";
}

if (empty($errors)) {
    if ($UserAuth->register($name, $email, $password, $img_upload, $country, $whatsapp , $location, $facebook, $twitter, $linkedin, $instagram, $blacklist, $date, $verified, $vkey)) {
        echo "1";
        exit();
    } else {
        $errors[] = "Registration failed. Please try again.";
    }
}

// Output errors
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "$error";
    }
}
?>
