<?php 
session_start();
include('configure.php');

$conn = new Database();
date_default_timezone_set('Africa/Lagos');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user inputs
    $user_id = intval($_POST['user_id']); // Ensure user_id is an integer
    $complain = htmlspecialchars(trim($_POST['complain'])); // Sanitize and trim comment
    $complain_sender_name = htmlspecialchars(trim($_POST['name'])); // Sanitize and trim sender name
    $complain_id = intval($_POST['complain_id']); // Ensure comment_id is an integer

    // Initialize file variables
    $imageFolder = "../complain-uploads/";
    $basename = "";
    $myimage = "";
    
    if (isset($_FILES["fileupload"]) && $_FILES["fileupload"]["error"] == 0) {
        $basename = basename($_FILES["fileupload"]["name"]);
        $myimage = $imageFolder . $basename;
        $imageExtension = strtolower(pathinfo($myimage, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Example allowed extensions
        $ImageSize = $_FILES['fileupload']['size'];
        $image_temp_name = $_FILES["fileupload"]["tmp_name"];
        
        // Validate the file upload
        if (in_array($imageExtension, $allowedExtensions) && $ImageSize < 5000000) { // Check file size (e.g., max 5MB)
            if (move_uploaded_file($image_temp_name, $myimage)) {
                // File upload successful
            } else {
                echo "Error uploading file.";
                $myimage = ""; // Clear file path if upload fails
            }
        } else {
            echo "Invalid file type or size.";
            $myimage = ""; // Clear file path if validation fails
        }
    }

    // If no file was uploaded, $myimage remains an empty string
    $date = date("D, F d, Y g:iA");

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO complain (user_id, complain, parent_complain_id, fileupload, complain_sender_name, date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isisss", $user_id, $complain, $complain_id, $myimage, $complain_sender_name, $date);

    if ($stmt->execute()) {
        echo "1";
    } else {
        echo "Error in adding comment: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
