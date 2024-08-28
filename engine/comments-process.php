<?php
include('configure.php');
$conn = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id']; // Retrieve from session or request
    $content = $_POST['content'];
    
    $stmt = $conn->prepare("INSERT INTO comments (user_id, content) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $content);
    if ($stmt->execute()) {
        echo "Comment added successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>