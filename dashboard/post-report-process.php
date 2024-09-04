<?php
session_start();
include('configure.php');
error_reporting(E_ALL ^ E_NOTICE);

$conn = new Database();
date_default_timezone_set('Africa/Lagos');

// Retrieve user ID from session
$user_id = $_SESSION['id'];

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Retrieve user inputs
    $reporterName = $_POST["reporterName"] ?? '';
    $addressOffender = $_POST['addressOffender'] ?? '';
    $eventDate = $_POST['eventDate'] ?? '';
    $eventTime = $_POST['eventTime'] ?? '';
    $eventDetails = $_POST['eventDetails'] ?? '';
    $reportPurpose = $_POST['reportPurpose'] ?? '';
    $anonymous = $_POST['anonymous'] ?? '';

    // Handle multiple reportTo and reportCategory values
    $selectedreportTo = isset($_POST['reportTo']) ? implode(', ', $_POST['reportTo']) : '';
    $selectedreportCategory = isset($_POST['reportCategory']) ? implode(', ', $_POST['reportCategory']) : '';
   // File upload handling
    $imageFolder = "report_uploads/";
    $basename = basename($_FILES['fileupload']['name']);
    $myimage = $imageFolder . $basename;
    $max_upload = 50 * 1024 * 1024; // 50MB limit
    $imageExtension = strtolower(pathinfo($myimage, PATHINFO_EXTENSION));
    $ImageSize = $_FILES['fileupload']['size'];
    $image_temp_name = $_FILES['fileupload']['tmp_name'];


    // Allowed file exte nsions
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'mov', 'avi'];

    // Validate the file upload
    if (in_array($imageExtension, $allowedExtensions) && $ImageSize <= $max_upload) { // Check file size
        if (move_uploaded_file($image_temp_name, $myimage)) {
            $date = date("D, F d, Y g:iA");

            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO report (user_id, reporterName, addressOffender, eventDate, eventTime, eventDetails, reportPurpose, anonymous, reportTo, reportCategory, fileupload, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Check if preparation was successful
            if ($stmt === false) {
                die("Prepare failed: " . $conn->error);
            }

            // Sanitize input
            $selectedreportTo = htmlspecialchars($selectedreportTo, ENT_QUOTES, 'UTF-8');
            $selectedreportCategory = htmlspecialchars($selectedreportCategory, ENT_QUOTES, 'UTF-8');

            // Bind parameters and execute the statement
            $stmt->bind_param("isssssssssss", $user_id, $reporterName, $addressOffender, $eventDate, $eventTime, $eventDetails, $reportPurpose, $anonymous, $selectedreportTo, $selectedreportCategory, $myimage, $date);
            if ($stmt->execute()) {
                echo "1"; // Success message
            } else {
                echo "Error in adding report: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Failed to upload file.";
        }
    } else {
        echo "Invalid file type or size.";
    }

    // Close database connection
    $conn->close();
}
?>
