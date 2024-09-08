<?php session_start(); ?>

<?php 
include('configure.php');
$conn = new Database();
date_default_timezone_set('Africa/Lagos');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user inputs
    $user_id =$_POST['user_id']; // Ensure user_id is an integer
    $comment =$_POST['comment']; // Sanitize and trim comment
    $comment_sender_name = $_POST['name']; // Sanitize and trim sender name
    $comment_id = $_POST['comment_id']; // Ensure comment_id is an integer
    $comment_category = $_POST['comment_category']; // Sanitize and trim category
    $news_id = $_POST['news_id']; 
    $date = date("D, F d, Y g:iA");
    // Handle file upload
    // $imageFolder = "../report-uploads/";
    // $basename = basename($_FILES["fileupload"]["name"]);
    // $myimage = $imageFolder . $basename;
    // $imageExtension = strtolower(pathinfo($myimage, PATHINFO_EXTENSION));
    // $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Example allowed extensions
    // $ImageSize = $_FILES['fileupload']['size'];
    // $image_temp_name = $_FILES["fileupload"]["tmp_name"];

    // Validate the file upload
    // if (in_array($imageExtension, $allowedExtensions) && $ImageSize < 5000000) { // Check file size (e.g., max 5MB)
    //     if (move_uploaded_file($image_temp_name, $myimage)) {
       

            // Prepare and execute the SQL statement
            $stmt = $conn->prepare("INSERT INTO comments (user_id, comment, news_id, parent_comment_id, comment_category, comment_sender_name, date) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isiisss", $user_id, $comment, $news_id, $comment_id, $comment_category, $comment_sender_name, $date);

            if ($stmt->execute()) {
                echo "1";
            } else {
                echo "Error in adding comment: " . $stmt->error;
            }

            $stmt->close();
        }
    // } 

    $conn->close();
// }
?>
