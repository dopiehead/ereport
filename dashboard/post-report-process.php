<?php
session_start();
include('configure.php');
error_reporting(E_ALL);

// Initialize database connection
$conn = new Database();
date_default_timezone_set('Africa/Lagos');

// Retrieve user ID from session
$user_id = $_SESSION['id'] ?? null;

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve user inputs
    $eventTitle = $_POST["eventTitle"] ?? '';
    $reporterName = $_POST["reporterName"] ?? '';
    $addressOffender = $_POST['addressOffender'] ?? '';
    $eventDate = $_POST['eventDate'] ?? '';
    $eventTime = $_POST['eventTime'] ?? '';
    $eventDetails = $_POST['eventDetails'] ?? '';
    $reportPurpose = $_POST['reportPurpose'] ?? '';
    $anonymous = $_POST['anonymous'] ?? '';
    $comments = $_POST['anonymous'] ?? '0';
    $views = $_POST['views'] ?? '0';
    $pending = $_POST['pending'] ?? '0';
    // Handle multiple reportTo and reportCategory values
    $selectedreportTo = isset($_POST['reportTo']) ? implode(', ', $_POST['reportTo']) : '';
    $selectedreportCategory = isset($_POST['reportCategory']) ? implode(', ', $_POST['reportCategory']) : '';

    // File upload handling
    $imageFolder = "report_uploads/";
    $basename = $_FILES['fileupload']['name'] ?? '';
    $basenamex = $_FILES['fileuploadx']['name'] ?? '';

    $myimage = $imageFolder . basename($basename);
    $myimagex = $imageFolder . basename($basenamex);

    $max_upload = 50 * 1024 * 1024; // 50MB limit
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'mov', 'avi'];

    $imageExtension = strtolower(pathinfo($myimage, PATHINFO_EXTENSION));
    $imageExtensionx = strtolower(pathinfo($myimagex, PATHINFO_EXTENSION));

    $ImageSize = $_FILES['fileupload']['size'] ?? 0;
    $ImageSizex = $_FILES['fileuploadx']['size'] ?? 0;
    $image_temp_name = $_FILES['fileupload']['tmp_name'] ?? '';
    $image_temp_namex = $_FILES['fileuploadx']['tmp_name'] ?? '';

    $uploadSuccess = true;

    // Validate and upload the first file
    if (!empty($basename) && in_array($imageExtension, $allowedExtensions) && $ImageSize <= $max_upload) {
        if (!move_uploaded_file($image_temp_name, $myimage)) {
            $uploadSuccess = false;
            echo "Failed to upload file: $basename.";
        }
    }

    // Validate and upload the second file
    if (!empty($basenamex) && in_array($imageExtensionx, $allowedExtensions) && $ImageSizex <= $max_upload) {
        if (!move_uploaded_file($image_temp_namex, $myimagex)) {
            $uploadSuccess = false;
            echo "Failed to upload file: $basenamex.";
        }
    }

    if ($uploadSuccess) {
        $date = date("D, F d, Y g:iA");

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO report (user_id, reporterName, eventTitle, addressOffender, eventDate, eventTime, eventDetails, reportPurpose, anonymous, reportTo, reportCategory, fileupload, images, comments, views, pending, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        // Sanitize input
        $selectedreportTo = htmlspecialchars($selectedreportTo, ENT_QUOTES, 'UTF-8');
        $selectedreportCategory = htmlspecialchars($selectedreportCategory, ENT_QUOTES, 'UTF-8');

        // Bind parameters
        $stmt->bind_param("isssssssssssssiii", $user_id, $reporterName, $eventTitle, $addressOffender, $eventDate, $eventTime, $eventDetails, $reportPurpose, $anonymous, $selectedreportTo, $selectedreportCategory, $myimage, $myimagex, $comments, $views, $pending, $date);

        if ($stmt->execute()) {
            echo "1"; // Success message
        } else {
            echo "Error in adding report: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }

    // Close database connection
    $conn->close();
}
?>
