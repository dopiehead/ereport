<?php  
include('engine/configure.php');
$conn = new Database();
$id = $_POST['id'];
$sql = "SELECT * FROM report WHERE id = ?";
$stmt=$conn->prepare($sql);
if (!$conn->prepare($sql)) {
    echo "Database Error";
}
else{
    $stmt->bind_param("i",$id);
    if ($stmt->execute()) {
        $result = $stmt->get_result(); // Get the result set
        while ($row = $result->fetch_assoc()) { ?>
                
 <video id="videoPlayer" controls>
  <source id="videoSource" src="<?php echo "dashboard/./".$row['fileupload'] ?>" type="video/mp4">
  <source id="videoSource" src="<?php echo "dashboard/./".$row['fileupload'] ?>" type="video/ogg">
  <source id="videoSource" src="<?php echo "dashboard/./".$row['fileupload'] ?>" type="video/mov">
 </video>
 

 <?php
    }
}

else{
    $stmt->error;
}
$stmt->close();

}


?>