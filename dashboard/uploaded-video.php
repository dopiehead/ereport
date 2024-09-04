<?php  
include('configure.php');
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
                
 <video controls>
  <source src="<?php echo $row['fileupload'] ?>" type="video/mp4">
  <source src="<?php echo $row['fileupload'] ?>" type="video/ogg">
  <source src="<?php echo $row['fileupload'] ?>" type="video/mov">
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