<?php 
if(isset($_POST['id'])){
$id=$_POST['id'];
include("../engine/configure.php");
$conn = new Database();
$query ="UPDATE admin_alert SET pending = 1 WHERE id = ?";
$stmt = $conn->prepare($query);
if($stmt==false){ echo "Prepare statement failed"; }{
$stmt->bind_param("i",$id);
$stmt->execute();
if($stmt->execute()){
$query = "SELECT 
                    admin_alert.id AS id,
                    admin_alert.user_id,
                    admin_alert.message,
                    admin_alert.date AS date,
                    user_profile.id, 
                    user_profile.name AS name
                  FROM admin_alert 
                  LEFT JOIN user_profile 
                  ON user_profile.id = admin_alert.user_id
                  WHERE admin_alert.id = ?";
$stmt2 = $conn->prepare($query);
$stmt2->bind_param("i",$id);
$stmt2->execute();
$result =$stmt2->get_result();
while($row = $result->fetch_assoc()){?>
<a class="close-modal" id="close-modal">&times;</a>  
<div class="message-body p-3">
<p class="text-center text-secondary"><?php echo$row['message'];?></p><br>
<span><?php echo$row['date'] ?></span>


</div>

<?php
 }
}
  
}

}
?>