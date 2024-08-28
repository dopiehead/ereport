<?php
include('configure.php');
$conn = new Database();
$sql = "SELECT * FROM comments order by id desc";
$result = $conn->query($sql);

while ($comment = $result->fetch_assoc()) {
 
    echo'<div class="comment-box">';                
    echo'<img src="assets/images/IMG_E7548.jpg"><span class="status"><i class="fa fa-circle"></i></span><span class="commenter-name">Name</span>';
    echo"<p>".htmlspecialchars($comment['content'])."</p>";

    echo'<div class="comment-options">

    <div class="smiley">
        <i class="fa-regular fa-face-smile"></i>
    </div>

    <div class="comment-likes">
         <i class="fa-regular fa-thumbs-up"></i>
    </div> 

    <div class="comment-ban">
       <i class="fa fa-ban"></i>
    </div> 

    <div class="comment-reply">
        <a class="btn-reply cursor-pointer">Reply</a>                      
   </div>

   <div class="comment_reply_time">

   <span class="comment-time">6hours</span>
   </div>

</div>

';





    // Fetch and display replies
    $comment_id = $comment['id'];
    $reply_sql = "SELECT * FROM replies WHERE comment_id = ?";
    $reply_stmt = $conn->prepare($reply_sql);
    $reply_stmt->bind_param("i", $comment_id);
    $reply_stmt->execute();
    $reply_result = $reply_stmt->get_result();

    while ($reply = $reply_result->fetch_assoc()) {
        echo "<div class='reply'>";
        echo "<p>User ID: " . htmlspecialchars($reply['user_id']) . "</p>";
        echo "<p>Reply: " . htmlspecialchars($reply['content']) . "</p>";
        echo "</div>";
    }


    echo'  <div class="reply-container comment mt-2">
                 <!-- Comment content here -->              
                     <form class="replyForm" id="replyForm">
                         <input type="hidden" name="comment_id" id="comment_id" value="1"> <!-- Replace with actual comment ID -->
                         <input type="hidden" name="user_id" id="user_id" value="1"> <!-- Replace with actual user ID -->
                         <textarea name="content" id="content-reply" class="form-control"></textarea>
                         <div class=" d-flex justify-content-end align-items-end mt-1">
                         <input type="submit" name="submit" class="reply-btn btn-success border border-0" value="Add Reply">
                         </div>
                     </form>
                 </div>';

    $reply_stmt->close();
    echo "</div><hr>";
}

$result->free();
$conn->close();
?>
