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
$verified = $_POST['verified'] ?? '0'; // Default to '0' if not set
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
    if ($UserAuth->register($name, $email, $password, $verified, $date, $vkey)) {
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
