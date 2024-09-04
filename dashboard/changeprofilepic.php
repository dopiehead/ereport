<?php
session_start();
include('configure.php');
error_reporting(E_ALL ^ E_NOTICE);

$conn = new Database();
date_default_timezone_set('Africa/Lagos');

$user_id = $_SESSION['id'];
$myid = $_POST['id'];

$imageFolder = "uploads/";
$basename = basename($_FILES["fileupload"]["name"]);
$myimage = $imageFolder . $basename;
$imageExtension = strtolower(pathinfo($myimage, PATHINFO_EXTENSION));
$ImageSize = $_FILES['fileupload']['size'];
$image_temp_name = $_FILES["fileupload"]["tmp_name"];

// Validate image file
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
if (!in_array($imageExtension, $allowedExtensions)) {
    echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
    exit;
}

if ($ImageSize > 2 * 1024 * 1024) { // 2MB
    echo "File size exceeds 2MB.";
    exit;
}

// Move uploaded file
if (!move_uploaded_file($image_temp_name, $myimage)) {
    echo "Error uploading file.";
    exit;
}

// Prepare SQL statement
$sql = "UPDATE user_profile SET img_upload=? WHERE id=?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters and execute statement
$stmt->bind_param('si', $myimage, $myid);

if ($stmt->execute()) {
    if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
        $_SESSION['img'] = $myimage;
    }
    echo "1";
} else {
    echo "Error in changing picture: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
