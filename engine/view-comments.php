<?php
include('configure.php');
$conn = new Database();

$query = "
SELECT * FROM comments 
WHERE parent_comment_id = '0' 
ORDER BY comment_id DESC
";

$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

$output = '';
while ($row = $result->fetch_assoc()) {
    $output .= '
     <div class="comment-box">

    

     <img src="assets/images/IMG_E7548.jpg" alt=""><span class="status"><i class="fa fa-circle"></i></span><span class="commenter-name">'.htmlspecialchars($row["comment_sender_name"]).'</span>
            <p>'.htmlspecialchars($row["comment"]).'</p> 
         <div class="comment-options">

         <div class="smiley"> 

         <i class="fa-regular fa-face-smile"></i>

         </div>

          <div class="comment-likes">
                          <i id="'.$row['comment_id'].'" class="likes fa-regular fa-thumbs-up"></i>'.$row["likes"].'
                     </div> 


                     <div class="comment-ban">
                        <i id="'.$row['comment_id'].'"  class="dislikes fa fa-ban"></i>'.$row["unlikes"].'
                     </div> 

                     <div class="comment-reply">
                       <button type="button" class="btn btn-default reply" id="' . $row["comment_id"] . '" onClick="reply()">Reply</button>                     
                    </div>

                    <div class="comment_reply_time">
              
                    <span class="comment-time">'.htmlspecialchars($row["date"]).'</span>
                    </div>

                        </div>

                           </div>
                  
                        <hr>
                    
        </div>
    ';
    $output .= get_reply_comment($conn, $row["comment_id"]);
}

echo $output;

function get_reply_comment($conn, $parent_id = 0, $marginleft = 0) {
    $query = "
    SELECT * FROM comments WHERE parent_comment_id = ?
    ";
    
    $statement = $conn->prepare($query);
    $statement->bind_param('i', $parent_id); // Bind integer parameter
    $statement->execute();
    $result = $statement->get_result();
    
    $output = '';
    $count = $result->num_rows;
    
    if ($parent_id == 0) {
        $marginleft = 0;
    } else {
        $marginleft += 25;
    }
    
    if ($count > 0) {
        while ($row = $result->fetch_assoc()) {
            $output .= '
            <div class="comment-box"  style="margin-left:' . $marginleft . 'px">
            
              

     <img src="assets/images/IMG_E7548.jpg" alt=""><span class="status"><i class="fa fa-circle"></i></span><span class="commenter-name">'.htmlspecialchars($row["comment_sender_name"]).'</span>
            <p>'.htmlspecialchars($row["comment"]).'</p> 
         <div class="comment-options">

         <div class="smiley"> 

         <i class="fa-regular fa-face-smile"></i>

         </div>

          <div class="comment-likes">
                          <i id="'.$row['comment_id'].'"  class="likes fa-regular fa-thumbs-up"></i>'.$row["likes"].'
                     </div> 


                     <div class="comment-ban">
                        <i id="'.$row['comment_id'].'" class="dislikes fa fa-ban"></i>'.$row["unlikes"].'
                     </div> 
`
                     <div class="comment-reply">
                       <button type="button" class="btn btn-default reply" id="' . $row["comment_id"] . '" onClick="reply()">Reply</button>                     
                    </div>

                    <div class="comment_reply_time">
              
                    <span class="comment-time">'.htmlspecialchars($row["date"]).'</span>
                    </div>

                        </div>

                           </div>
                  
                        <hr>


            </div>
            ';
            $output .= get_reply_comment($conn, $row["comment_id"], $marginleft);
        }
    }
    
    return $output;
}
?>
