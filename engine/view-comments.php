<?php session_start();
include('configure.php');
$conn = new Database();
// Fetch comments
$query = "SELECT
    comments.comment_id AS comment_id,
    comments.user_id AS user_id,
    comments.comment AS comment,
    comments.news_id AS news_id,
    comments.parent_comment_id AS parent_comment_id,
    comments.comment_category AS comment_category,
    comments.comment_sender_name AS comment_sender_name,
    comments.likes AS likes,
    comments.unlikes AS unlikes,
    report.user_id AS report_user_id,
    report.id AS report_id,
    user_profile.id AS user_profile_id,
    user_profile.img_upload AS img_upload,
    comments.date AS date
FROM comments
CROSS JOIN report ON comments.news_id = report.id
JOIN user_profile ON comments.user_id = user_profile.id
WHERE comments.parent_comment_id = '0'"; 

if (isset($_POST['comment_category'])) {
    $comment_category = $_POST['comment_category'];

    
    // Validate input to prevent SQL injection and handle unexpected values
    if (in_array($comment_category, ['positive', 'negative', 'suggestions'])) {
        $query .= " AND comments.comment_category = '$comment_category'";
    }
}



if(isset($_POST['id'])){

    $id = $_POST['id'];

  $query .=" AND comments.news_id = $id";
}


$query .= " ORDER BY comment_id DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$output = '';
while ($row = $result->fetch_assoc()) {
    $output .= '<div class="comment-box">
        <img src = '."dashboard/".$row["img_upload"].'>
        <span class="status"><i class="fa fa-circle"></i></span>
        <span class="commenter-name">' . htmlspecialchars($row["comment_sender_name"]) . '</span>
        <p>' . htmlspecialchars($row["comment"]) . '</p>
        <div class="comment-options">
            <div class="smiley"><i class="fa-regular fa-face-smile"></i></div>
            <div class="comment-likes">
                <i id="' . $row['comment_id'] . '" class="likes fa-regular fa-thumbs-up"></i>' . $row["likes"] . '
            </div>
            <div class="comment-ban">
                <i id="' . $row['comment_id'] . '" class="dislikes fa fa-ban"></i>' . $row["unlikes"] . '
            </div>
            <div class="comment-reply">
                <button type="button" class="btn btn-default reply" id="' . $row["comment_id"] . '" onClick="reply()">Reply</button>
            </div>
            <div class="comment_reply_time">
                <span class="comment-time">' . htmlspecialchars(time_ago($row['date'])) . '</span>
            </div>
        </div>
    </div><hr>';
    $output .= get_reply_comment($conn, $row["comment_id"]);
}

echo $output;

// Function to get time ago in human-readable format

function time_ago($date) {
    // Create DateTime objects for the current time and the input date
    $now = new DateTime();
    $ago = new DateTime($date);
    
    // Subtract 1 hour from the current time
    $now->modify('-1 hour');
    
    // Calculate the time difference
    $interval = $now->diff($ago);
    
    // Determine the time ago
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
function get_reply_comment($conn, $parent_id = 0, $marginleft = 15) {

    $query = "SELECT
    comments.comment_id AS comment_id,
    comments.user_id AS user_id,
    comments.comment AS comment,
    comments.news_id AS news_id,
    comments.parent_comment_id AS parent_comment_id,
    comments.comment_category AS comment_category,
    comments.comment_sender_name AS comment_sender_name,
    comments.likes AS likes,
    comments.unlikes AS unlikes,
    report.user_id AS report_user_id,
    report.id AS report_id,
    user_profile.id AS user_profile_id,
    user_profile.img_upload AS img_upload,
    comments.date AS date
FROM comments
CROSS JOIN report ON comments.news_id = report.id
JOIN user_profile ON comments.user_id = user_profile.id
WHERE comments.parent_comment_id = ?";

if(isset($_POST['id'])){

    $id = $_POST['id'];

  $query .=" AND comments.news_id = $id";
}

if (isset($_POST['comment_category'])) {
    $comment_category = $_POST['comment_category'];

    
    // Validate input to prevent SQL injection and handle unexpected values
    if (in_array($comment_category, ['positive', 'negative', 'suggestions'])) {
        $query .= " AND comments.comment_category = '$comment_category'";
    }
}

$query .= " ORDER BY comment_id DESC";

    $statement = $conn->prepare($query);
    $statement->bind_param('i', $parent_id); // Bind integer parameter
    $statement->execute();
    $result = $statement->get_result();
    
    $output = '';
    $count = $result->num_rows;
    
    if ($count > 0) {
        while ($row = $result->fetch_assoc()) {
            $output .= '<div class="comment-box" style="margin-left:' . $marginleft . 'px">
                <img src="assets/images/IMG_E7548.jpg" alt="">
                <span class="status"><i class="fa fa-circle"></i></span>
                <span class="commenter-name">' . htmlspecialchars($row["comment_sender_name"]) . '</span>
                <p>' . htmlspecialchars($row["comment"]) . '</p>
                <div class="comment-options">
                    <div class="smiley"><i class="fa-regular fa-face-smile"></i></div>
                    <div class="comment-likes">
                        <i id="' . $row['comment_id'] . '" class="likes fa-regular fa-thumbs-up"></i>' . $row["likes"] . '
                    </div>
                    <div class="comment-ban">
                        <i id="' . $row['comment_id'] . '" class="dislikes fa fa-ban"></i>' . $row["unlikes"] . '
                    </div>
                    <div class="comment-reply">
                        <button type="button" class="btn btn-default reply" id="' . $row["comment_id"] . '" onClick="reply()">Reply</button>
                    </div>
                    <div class="comment_reply_time">
                        <span class="comment-time">' . htmlspecialchars(time_ago($row['date'])) . '</span>
                    </div>
                </div>
            </div><hr>';
            $output .= get_reply_comment($conn, $row["comment_id"], $marginleft + 15);
        }
    }
    
    return $output;
}


?>

