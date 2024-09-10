<?php
include('configure.php');
$conn = new Database();
date_default_timezone_set('Africa/Lagos');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user inputs
    $user_id = intval($_POST['user_id']); // Ensure user_id is an integer
    $protest = htmlspecialchars(trim($_POST['protest']));// Sanitize and trim protest
    $protest_sender_name = htmlspecialchars(trim($_POST['name'])) ; // Sanitize and trim sender name
    $protest_id = $_POST['protest_id']; // Ensure protest_id is an integer
   
    // Initialize file upload variables
    $myimage = ""; // Default value if no file is uploaded

    if (isset($_FILES["fileupload"]) && $_FILES["fileupload"]["error"] == 0) {
        // Handle file upload
        $imageFolder = "../protest-uploads/";
        $basename = basename($_FILES["fileupload"]["name"]);
        $myimage = $imageFolder . $basename;
        $imageExtension = strtolower(pathinfo($myimage, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Allowed extensions
        $ImageSize = $_FILES['fileupload']['size'];
        $image_temp_name = $_FILES["fileupload"]["tmp_name"];

        // Validate the file upload
        if (in_array($imageExtension, $allowedExtensions) && $ImageSize < 5000000) { // Check file size (e.g., max 5MB)
            if (!move_uploaded_file($image_temp_name, $myimage)) {
                echo "Error uploading file.";
                $myimage = ""; // Clear file path if upload fails
            }
        } else {
            echo "Invalid file type or size.";
            $myimage = ""; // Clear file path if validation fails
        }
    }

    // Prepare and execute the SQL statement
    $date = date("D, F d, Y g:iA");
    $stmt = $conn->prepare("INSERT INTO protest (user_id, protest, parent_protest_id, fileupload, protest_sender_name, date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isisss", $user_id, $protest, $protest_id, $myimage, $protest_sender_name, $date);
 

    if ($stmt->execute()) {
        echo "1";
    } else {
        echo "Error in adding protest: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
