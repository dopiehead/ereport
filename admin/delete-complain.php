<?php
if(isset($_POST['id'])){
$id = $_POST['id'];
include("../engine/configure.php");
$conn = new Database();
$query ="
DELETE  from complain WHERE id = ?";
$stmt = $conn->prepare($query);
if($stmt === false){
    echo "Prepared statement failed". $stmt->error;
}
else{

$stmt->bind_param('i',$id);
$stmt->execute();
if($stmt->execute()==false){
echo" Prepared executived failed";
}

else{
header("Location:admin.php");
}

}

}

?>