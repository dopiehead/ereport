<?php 
    // error_reporting(E_ALL ^ E_NOTICE);
    $id = $_POST['id'];
 
    $message = $id." has started a live video";
    include('configure.php');
    $conn = new Database();
    $query = "insert into admin_alert(user_id,message,date) values(?, ?, ?)";
    $stmt = $conn->prepare($query);
    if($stmt===false){
        echo "error in prepare statement";
    }
    else{
        $stmt->bind_param("iss", $id, $message, $date);
        $stmt->execute();
        if($stmt->execute()===false){
            echo "Error in inserting data";
        }
        else{
            echo "1";
        }
  
    }
?>