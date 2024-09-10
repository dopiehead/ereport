<?php
error_reporting(E_ALL ^ E_NOTICE);
include('configure.php');
$conn = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input
    $complain_id = intval($_POST['complain_id']);
    $user_id = intval($_POST['user_id']);
    $date = date("D, F d, Y g:iA"); // Using a standard format for date and time
  

    // Check if user has already liked this comment
    $checkLikeQuery = "SELECT COUNT(*) FROM complain_likes_unlikes WHERE user_id = ? AND complain_id = ?";
    $stmt = $conn->prepare($checkLikeQuery);
    
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("ii", $user_id, $complain_id);
    $stmt->execute();
    $stmt->bind_result($likeCount);
    $stmt->fetch();
    $stmt->close();

    if ($likeCount > 0) {
        // User has already liked this comment
        echo "2"; // Or any other appropriate error code/message
        $conn->close();
        exit();
    }
    else{

    // Insert into report_likes_unlikes table
    $insertLikeQuery = "INSERT INTO complain_likes_unlikes (user_id, complain_id, date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertLikeQuery);

    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("iis", $user_id, $complain_id, $date);

    if ($stmt->execute()) {
        // Update likes count in comments table
        $likesUpdateQuery = "UPDATE complain SET likes = likes + 1 WHERE complain_id = ?";
        $stmt2 = $conn->prepare($likesUpdateQuery);
        
        if ($stmt2 === false) {
            die('Prepare failed: ' . $conn->error);
        }

        $stmt2->bind_param("i", $complain_id);

        if ($stmt2->execute()) {
            echo "1"; // Success
        } else {
            die('Execute failed: ' . $stmt2->error);
        }

        $stmt2->close();
    } else {
        die('Execute failed: ' . $stmt->error);
    }

}

    $stmt->close();
    $conn->close();
}
?>
