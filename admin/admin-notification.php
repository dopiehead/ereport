<?php 
include("../engine/configure.php");
$conn = new Database();
$query ="SELECT * FROM admin_alert";
$stmt = $conn->prepare($query);
if($stmt==false){ echo "Prepare statement failed"; } else{
$stmt->execute();
$result =$stmt->get_result();
$count =$result->num_rows;
if($count>0){
echo$count;
}
}

?>