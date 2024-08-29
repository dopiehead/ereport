<?php
include('configure.php');
$conn = new Database();
date_default_timezone_set('Africa/Lagos');

date_default_timezone_get();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id']; // Retrieve from session or request
    $comment = $_POST['comment'];
    $comment_sender_name = $_POST['name'];
    $comment_id = $_POST['comment_id'];
    $date=date("D, F d, Y g:iA");
    $stmt = $conn->prepare("INSERT INTO comments (user_id,comment,parent_comment_id,comment_sender_name,date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isiss", $user_id, $comment, $comment_id, $comment_sender_name, $date);
    if ($stmt->execute()) {
        echo "1";
    } else {
        echo "Error in adding comment". $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>