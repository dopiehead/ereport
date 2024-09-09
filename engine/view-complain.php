<?php
session_start();
include('configure.php');
$conn = new Database();

// Fetch comments
$query = "SELECT complain.complain_id AS complain_id,
complain.user_id AS user_id, 
complain.complain AS complain,
complain.parent_complain_id AS parent_complain_id,
complain.fileupload AS fileupload,
complain.complain_sender_name AS complain_sender_name,
complain.likes AS likes,
complain.unlikes AS unlikes,
complain.date AS date,
user_profile.id,
user_profile.img_upload AS img_upload
 
FROM complain
JOIN user_profile ON user_id = user_profile.id 
WHERE parent_complain_id = '0' 
ORDER BY complain_id DESC";

$stmt = $conn->prepare($query);
if($stmt===false){
    echo "stmt prepare failed";
}
$stmt->execute();
$result = $stmt->get_result();

$output = '';
while ($row = $result->fetch_assoc()) {
    $output .= '<div class="user-container">
        <div>
           <img class="user_image" src="'.$row['img_upload'].'" alt="">
           <span class="user_name">' . htmlspecialchars($row["complain_sender_name"]) . '</span>
        </div>
        <div>
            <span class="user_time">' . htmlspecialchars(time_ago($row['date'])) . '</span>
        </div>
        <p>' . htmlspecialchars($row["complain"]) . '</p>
        <span class="heart p-4 likes">
            <i id="' . $row['complain_id'] . '" class="likes fa-regular fa-thumbs-up"></i>' . $row["likes"] . '
        </span>   
        <span class="hand p-3 dislikes">
            <i id="' . $row['complain_id'] . '" class="dislikes fa fa-hand"></i>' . $row["unlikes"] . '
        </span> 
        <span class="reply p-3">
            <a class="reply" id="' . $row["complain_id"] . '" onClick="reply()">Reply</a>
        </span>

        </div>

        <div class="sender_image_container d-flex justify-content-center align-items-center mt-5">
            <img src="' . htmlspecialchars($row['fileupload']) . '">
        </div>

        
        <hr>';

    // Fetch and append replies
    $output .= get_reply_comment($conn, $row["complain_id"]);
}

echo $output;

// Function to get time ago in human-readable format
function time_ago($date) {
    $now = new DateTime();
    $ago = new DateTime($date);
    
    // Calculate the time difference
    $interval = $now->diff($ago);
    
    if ($interval->y > 0) {
        return ($interval->y == 1) ? "A year ago" : $interval->y . " years ago";
    } elseif ($interval->m > 0) {
        return ($interval->m == 1) ? "A month ago" : $interval->m . " months ago";
    } elseif ($interval->d > 0) {
        return ($interval->d == 1) ? "Yesterday" : $interval->d . " days ago";
    } elseif ($interval->h > 0) {
        return ($interval->h == 1) ? "An hour ago" : $interval->h . " hours ago";
    } elseif ($interval->i > 0) {
        return ($interval->i == 1) ? "A minute ago" : $interval->i . " minutes ago";
    } else {
        return ($interval->s <= 5) ? "Just now" : $interval->s . " seconds ago";
    }
}

// Function to fetch and display reply comments
function get_reply_comment($conn, $parent_id = 0, $marginleft = 0) {
    $query = "SELECT * FROM complain WHERE parent_complain_id = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param('i', $parent_id); // Bind integer parameter
    $statement->execute();
    $result = $statement->get_result();
    
    $output = '';
    
    while ($row = $result->fetch_assoc()) {
        $output .= '<div class="user-container" style="margin-left:' . $marginleft . 'px">
            <div>
               <img src="assets/images/IMG_E7548.jpg" alt="">
               <span class="user_name">' . htmlspecialchars($row["complain_sender_name"]) . '</span>
            </div>
            <div>
                <span class="user_time">' . htmlspecialchars(time_ago($row['date'])) . '</span>
            </div>
            <p>' . htmlspecialchars($row["complain"]) . '</p>
            <span class="heart p-4 likes">
                <i id="' . $row['complain_id'] . '" class="likes fa-regular fa-thumbs-up"></i>' . $row["likes"] . '
            </span>   
            <span class="hand p-3 dislikes">
                <i id="' . $row['complain_id'] . '" class="dislikes fa fa-hand"></i>' . $row["unlikes"] . '
            </span> 
            <span class="reply p-3">
                <a class="reply" id="' . $row["complain_id"] . '" onClick="reply()">Reply</a>
            </span>
            <hr>';
        // Fetch and append replies to this reply
        $output .= get_reply_comment($conn, $row["complain_id"], $marginleft + 25);
    }
    
    return $output;
}
?>
