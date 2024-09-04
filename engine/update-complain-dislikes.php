<?php
include('configure.php');
$conn = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $complain_id = intval($_POST['complain_id']); // Sanitize input
    $user_id = intval($_POST['user_id']); // Sanitize input
    $date = date("D, F d, Y g:iA"); // Use a standard format for date and time
  
    // Check if the user has already liked the comment
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

    if ($likeCount == 0) {
        // User has not liked this comment
        echo "You have not liked this comment"; // Or any appropriate message for not found
        $conn->close();
        exit();
    }

    // Delete the like from report_likes_unlikes table
    $deleteLikeQuery = "DELETE FROM complain_likes_unlikes WHERE complain_id = ? AND user_id = ?";
    $stmt = $conn->prepare($deleteLikeQuery);
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param("ii", $complain_id, $user_id);

    if ($stmt->execute()) {
        // Update likes count in comments table
        $likesUpdateQuery = "UPDATE complain SET likes = likes - 1 WHERE complain_id = ?";
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

    $stmt->close();
    $conn->close();
}
?>
