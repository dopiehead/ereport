<?php
include('configure.php');
$conn = new Database();
error_reporting(E_ALL ^ E_NOTICE);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $protest_id = intval($_POST['protest_id']); // Sanitize input
    $user_id = intval($_POST['user_id']); // Sanitize input
    $date = date("D, F d, Y g:iA"); // Use a standard format for date and time
  
    // Check if the user has already liked the comment
    $checkLikeQuery = "SELECT COUNT(*) FROM protest_likes_unlikes WHERE user_id = ? AND protest_id = ?";
    $stmt = $conn->prepare($checkLikeQuery);
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("ii", $user_id, $protest_id);
    $stmt->execute();
    $stmt->bind_result($likeCount);
    $stmt->fetch();
    $stmt->close();

    if ($likeCount == 0) {
        // User has not liked this comment
        echo "You have not liked this comment"; // Or any appropriate message for not found
        $conn->close();
        exit();
    }
else{
    // Delete the like from report_likes_unlikes table
    $deleteLikeQuery = "DELETE FROM protest_likes_unlikes WHERE protest_id = ? AND user_id = ?";
    $stmt = $conn->prepare($deleteLikeQuery);
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param("ii", $protest_id, $user_id);

    if ($stmt->execute()) {
        // Update likes count in comments table
        $likesUpdateQuery = "UPDATE protest SET likes = likes - 1 WHERE protest_id = ?";
        $stmt2 = $conn->prepare($likesUpdateQuery);
        if ($stmt2 === false) {
            die('Prepare failed: ' . $conn->error);
        }
        $stmt2->bind_param("i", $protest_id);

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
