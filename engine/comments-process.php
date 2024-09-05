<?php session_start(); ?>

<?php 
include('configure.php');
$conn = new Database();
date_default_timezone_set('Africa/Lagos');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user inputs
    $user_id = intval($_POST['user_id']); // Ensure user_id is an integer
    $comment = htmlspecialchars(trim($_POST['comment'])); // Sanitize and trim comment
    $comment_sender_name = htmlspecialchars(trim($_POST['name'])); // Sanitize and trim sender name
    $comment_id = intval($_POST['comment_id']); // Ensure comment_id is an integer
    $comment_category = htmlspecialchars(trim($_POST['comment_category'])); // Sanitize and trim category
    
    // Handle file upload
    $imageFolder = "../report-uploads/";
    $basename = basename($_FILES["fileupload"]["name"]);
    $myimage = $imageFolder . $basename;
    $imageExtension = strtolower(pathinfo($myimage, PATHINFO_EXTENSION));
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Example allowed extensions
    $ImageSize = $_FILES['fileupload']['size'];
    $image_temp_name = $_FILES["fileupload"]["tmp_name"];

    // Validate the file upload
    if (in_array($imageExtension, $allowedExtensions) && $ImageSize < 5000000) { // Check file size (e.g., max 5MB)
        if (move_uploaded_file($image_temp_name, $myimage)) {
            $date = date("D, F d, Y g:iA");

            // Prepare and execute the SQL statement
            $stmt = $conn->prepare("INSERT INTO comments (user_id, comment, parent_comment_id, comment_category, fileupload, comment_sender_name, date) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isissss", $user_id, $comment, $comment_id, $comment_category, $myimage, $comment_sender_name, $date);

            if ($stmt->execute()) {
                echo "1";
            } else {
                echo "Error in adding comment: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Failed to upload file.";
        }
    } else {
        echo "Invalid file type or size.";
    }

    $conn->close();
}
?>
