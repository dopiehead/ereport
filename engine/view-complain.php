<?php session_start(); ?>
<?php
include('configure.php');
$conn = new Database();

// Fetch comments
$query = "SELECT * FROM complain WHERE parent_complain_id = '0' ORDER BY complain_id DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

$output = '';
while ($row = $result->fetch_assoc()) {
    $output .= '<div class="user-container">
        <div>
           <img src="assets/images/IMG_E7548.jpg" alt="">
           <span class="user_name">' . htmlspecialchars($row["complain_sender_name"]) . '</span>
        </div>

         <div>
            <span class="user_time">' . htmlspecialchars(time_ago($row['date'])) . '</span>
         </div>

         </div>

        <p>' . htmlspecialchars($row["complain"]) . '</p>

  <span class="heart p-4 likes"> <i id="' . $row['complain_id'] . '" class="likes fa-regular fa-thumbs-up"></i>' . $row["likes"] . '</span>   
  
  <span class="hand p-3 dislikes"> <i id="' . $row['complain_id'] . '" class="dislikes fa fa-hand"></i>' . $row["unlikes"] . '</span> 
  
  <span class="reply p-3"><a class="reply"  id="' . $row["complain_id"] . '"  onClick="reply()">Reply</a></span>

  </div>

  </div><hr>';
    $output .= get_reply_comment($conn, $row["complain_id"]);
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
function get_reply_comment($conn, $parent_id = 0, $marginleft = 0) {
    $query = "SELECT * FROM complain WHERE parent_complain_id = ?";
    $statement = $conn->prepare($query);
    $statement->bind_param('i', $parent_id); // Bind integer parameter
    $statement->execute();
    $result = $statement->get_result();
    
    $output = '';
    $count = $result->num_rows;
    
    if ($count > 0) {
        while ($row = $result->fetch_assoc()) {
            $output .= '<div class="user-container" style="margin-left:' . $marginleft . 'px">
                  <div>
           <img src="assets/images/IMG_E7548.jpg" alt="">
           <span class="user_name">' . htmlspecialchars($row["complain_sender_name"]) . '</span>
        </div>

         <div>
            <span class="user_time">' . htmlspecialchars(time_ago($row['date'])) . '</span>
         </div>

         </div>

        <p>' . htmlspecialchars($row["complain"]) . '</p>

  <span class="heart p-4 likes"> <i id="' . $row['complain_id'] . '" class="likes fa-regular fa-thumbs-up"></i>' . $row["likes"] . '</span>   
  
  <span class="hand p-3 dislikes"> <i id="' . $row['complain_id'] . '" class="dislikes fa fa-hand"></i>' . $row["unlikes"] . '</span> 
  
  <span class="reply p-3"><a class="reply"  id="' . $row["complain_id"] . '"  onClick="reply()">Reply</a></span>

  </div>

  </div><hr>';
            $output .= get_reply_comment($conn, $row["complain_id"], $marginleft + 25);
        }
    }
    
    return $output;
}
?>

