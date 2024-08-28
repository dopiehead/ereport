<?php
include('configure.php');
$conn = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id']; // Retrieve from session or request
    $content = $_POST['content'];
    $comment_id = $_POST['comment_id'];
    $query= "INSERT INTO replies (user_id, comment_id, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("iis", $comment_id, $user_id, $content);
    
    if ($stmt->execute()) {
        echo "Reply added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
