<?php session_start();
include('../../engine/configure.php');
error_reporting(E_ALL ^ E_NOTICE);

$conn = new Database();
date_default_timezone_set('Africa/Lagos');

// Retrieve user ID from session
$user_id = $_SESSION['id'];

// Check request method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve and sanitize POST data
    $sid = $_POST['sid'];
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);
    $cpassword = trim($_POST['cpassword']);
    $country = trim($_POST['country']);
    $contact = trim($_POST['contact']);
    $whatsapp = trim($_POST['whatsapp']);
    $location = trim($_POST['location']);
    $facebook = trim($_POST['facebook']);
    $twitter = trim($_POST['twitter']);
    $linkedin = trim($_POST['linkedin']);
    $instagram = trim($_POST['instagram']);

    // Validate input
    if (strlen($name) > 22) {
        echo "Character number limit exceeded";
    } elseif ($password !== $cpassword) {
        echo "Password mismatch";
    } elseif (empty($contact)) {
        echo "Contact field cannot be empty";
    } elseif (empty($location)) {
        echo "Location field cannot be empty";
    } else {
        // Hash password
        $secret_password = sha1(md5($password));

        // Prepare and execute update statement
        $stmt = $conn->prepare("
            UPDATE user_profile 
            SET name = ?, 
                password = ?, 
                contact = ?, 
                country = ?, 
                whatsapp = ?, 
                location = ?, 
                facebook = ?, 
                twitter = ?, 
                linkedin = ?, 
                instagram = ? 
            WHERE id = ?
        ");

        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param(
            "sssssssssi",
            $name,
            $secret_password,
            $contact,
            $country,
            $whatsapp,
            $location,
            $facebook,
            $twitter,
            $linkedin,
            $instagram,
            $sid
        );

        if ($stmt->execute()) {
            echo "1";
        } else {
            echo "Error in editing profile: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }
}
?>
