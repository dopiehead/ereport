<?php
session_start();
include('configure.php');
error_reporting(E_ALL & ~E_NOTICE);

$conn = new Database();
date_default_timezone_set('Africa/Lagos');

// Retrieve user ID from session
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;

// Check request method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve and sanitize POST data
    $sid = $user_id;
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $cpassword = isset($_POST['cpassword']) ? trim($_POST['cpassword']) : '';
    $country = isset($_POST['country']) ? trim($_POST['country']) : '';
    $contact = isset($_POST['contact']) ? trim($_POST['contact']) : '';
    $whatsapp = isset($_POST['whatsapp']) ? trim($_POST['whatsapp']) : '';
    $location = isset($_POST['location']) ? trim($_POST['location']) : '';
    $facebook = isset($_POST['facebook']) ? trim($_POST['facebook']) : '';
    $twitter = isset($_POST['twitter']) ? trim($_POST['twitter']) : '';
    $linkedin = isset($_POST['linkedin']) ? trim($_POST['linkedin']) : '';
    $instagram = isset($_POST['instagram']) ? trim($_POST['instagram']) : '';

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
        $secret_password = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : '';

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
            error_log("Prepare failed: " . $conn->error);
            echo "An error occurred. Please try again later.";
            exit;
        }

        $stmt->bind_param(
            "ssssssssssi",
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
            error_log("Error in editing profile: " . $stmt->error);
            echo "An error occurred. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }
}
?>
