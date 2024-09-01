<?php
session_start();
include('../../engine/configure.php');
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
    $selectedreportTo = isset($_POST['reportTo']) ? $_POST['reportTo'] : [];
    $selectedreportCategory = isset($_POST['reportCategory']) ? $_POST['reportCategory'] : [];
    
    // Debugging output
    // echo "<pre>";
    // print_r($selectedreportTo);
    // print_r($selectedreportCategory);
    // echo "</pre>";

    // File upload handling
    $imageFolder = "../report_uploads/";
    $basename = basename($_FILES['fileupload']['name']);
    $myimage = $imageFolder . $basename;
    $max_upload = 50 * 1024 * 1024; // 50MB limit
    $imageExtension = strtolower(pathinfo($myimage, PATHINFO_EXTENSION));
    $ImageSize = $_FILES['fileupload']['size'];
    $image_temp_name = $_FILES['fileupload']['tmp_name'];

    // Debugging output
    // echo "File Name: " . htmlspecialchars($basename) . "<br>";
    // echo "File Extension: " . htmlspecialchars($imageExtension) . "<br>";
    // echo "File Size: " . htmlspecialchars($ImageSize) . "<br>";
    // echo "Max Upload Size: " . htmlspecialchars($max_upload) . "<br>";
    // echo "Temporary File Name: " . htmlspecialchars($image_temp_name) . "<br>";

    // Allowed file extensions
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

            // Insert multiple rows for each combination of reportTo and reportCategory
            $success = true;
            foreach ($selectedreportTo as $reportTo) {
                foreach ($selectedreportCategory as $reportCategory) {
                    // Sanitize input
                    $reportTo = htmlspecialchars($reportTo, ENT_QUOTES, 'UTF-8');
                    $reportCategory = htmlspecialchars($reportCategory, ENT_QUOTES, 'UTF-8');

                    // Bind parameters and execute the statement
                    $stmt->bind_param("isssssssssss", $user_id, $reporterName, $addressOffender, $eventDate, $eventTime, $eventDetails, $reportPurpose, $anonymous, $reportTo, $reportCategory, $myimage, $date);
                    if (!$stmt->execute()) {
                        echo "Error in adding report: " . $stmt->error;
                        $success = false; // Set flag if any insert fails
                    }
                }
            }

            if ($success) {
                echo "1"; // Success message
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
