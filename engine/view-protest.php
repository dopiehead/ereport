<?php
session_start();
include('configure.php');
$conn = new Database();
date_default_timezone_set('Africa/Lagos');

// Fetch main protests
$query = "SELECT 
            protest.protest_id AS protest_id,
            protest.user_id AS user_id, 
            protest.protest AS protest,
            protest.parent_protest_id AS parent_protest_id,
            protest.fileupload AS fileupload,
            protest.protest_sender_name AS protest_sender_name,
            protest.likes AS likes,
            protest.unlikes AS unlikes,
            protest.date AS date,
            user_profile.id,
            user_profile.img_upload AS img_upload
          FROM protest
          JOIN user_profile ON protest.user_id = user_profile.id 
          WHERE parent_protest_id = '0' 
          ORDER BY protest_id DESC";

$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$output = '';

while ($row = $result->fetch_assoc()) {
    $output .= '<div>
        <div class="user-container">
            <div>
                <img class="user_image" src="' . htmlspecialchars("dashboard/" . $row['img_upload']) . '" alt="">
                <span class="user_name">' . htmlspecialchars($row["protest_sender_name"]) . '</span>
            </div>
            <div>
                <span class="user_time small text-primary">' . htmlspecialchars(time_ago($row['date'])) . '</span>
            </div>
            <br>
        </div>
        <p class="small">' . htmlspecialchars($row["protest"]) . '</p>

       
        <span class="heart p-4 ">
            <i id="' . $row['protest_id'] . '" class="likes fa-regular fa-thumbs-up"></i>' . htmlspecialchars($row["likes"]) . '
        </span>   
        <span class="hand p-3 ">
            <i id="' . $row['protest_id'] . '" class="dislike fa fa-hand"></i>' . ''. '
        </span> 
        <span class=" p-3">
            <a class="btn_reply" id="' . $row["protest_id"] . '">Reply</a>
        </span>
     
        
        ' . (!empty($row['fileupload']) ? '<div class="sender_image_container d-flex justify-content-center align-items-center mt-2 rounded-0">
            <img class="rounded-0 w-100 h-100" src="ereport/' . htmlspecialchars($row['fileupload']) . '">
        </div>' : '') . '
        <hr><br>
    </div>';
    $output .= get_reply_comment($conn, $row["protest_id"]);
}

echo $output;

// Function to get time ago in human-readable format
function time_ago($date) {
    $now = new DateTime();
    $ago = new DateTime($date);
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
function get_reply_comment($conn, $parent_id = 0, $marginleft = 15) {
    $query = "SELECT 
                protest.protest_id AS protest_id,
                protest.user_id AS user_id, 
                protest.protest AS protest,
                protest.parent_protest_id AS parent_protest_id,
                protest.fileupload AS fileupload,
                protest.protest_sender_name AS protest_sender_name,
                protest.likes AS likes,
                protest.unlikes AS unlikes,
                protest.date AS date,
                user_profile.id,
                user_profile.img_upload AS img_upload
              FROM protest
              JOIN user_profile ON protest.user_id = user_profile.id 
              WHERE parent_protest_id = ? 
              ORDER BY protest_id ASC";

    $statement = $conn->prepare($query);
    $statement->bind_param('i', $parent_id);
    $statement->execute();
    $result = $statement->get_result();
    
    $output = '';
    
    while ($row = $result->fetch_assoc()) {
        $output .= '<div style="margin-left:' . $marginleft . 'px;">
            <div class="user-container">
                <div>
                    <img class="user_image" src="' . htmlspecialchars("dashboard/" . $row['img_upload']) . '" alt="">
                    <span class="user_name">' . htmlspecialchars($row["protest_sender_name"]) . '</span>
                </div>
                <div>
                    <span class="user_time small text-primary">' . htmlspecialchars(time_ago($row['date'])) . '</span>
                </div>
                <br>
            </div>
            <p class="small">' . htmlspecialchars($row["protest"]) . '</p>
                  <div id="bom"><div id="cy">
            <span class="heart p-1">
                <i id="' . $row['protest_id'] . '" class="likes fa-regular fa-thumbs-up"></i>' . htmlspecialchars($row["likes"]) . '
            </span>   
            <span class="hand p-1">
                <i id="' . $row['protest_id'] . '" class="dislike fa fa-hand"></i>' . ''. '
            </span> 
            <span class=" p-1">
            
                <a class="btn_reply" id="' . $row["protest_id"] . '">Reply</a>
            </span>
            </div></div>
            ' . (!empty($row['fileupload']) ? '<div class="sender_image_container d-flex justify-content-center align-items-center mt-2 rounded-0">
                <img style="width:120px;height:100px;" class="rounded-0" src="' ."ereport/". htmlspecialchars($row['fileupload']) . '">
            </div>' : '') . '
            <hr>
        </div>';
        
        $output .= get_reply_comment($conn, $row["protest_id"], $marginleft + 20);
    }
    
    return $output;
}
?>

