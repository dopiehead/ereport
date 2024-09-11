<?php 
include("../engine/configure.php");
$conn = new Database();
if(isset($_GET['id'])){
$user_id = $_GET['id'];
$sql = "SELECT * FROM user_profile WHERE id = ?";
$stmt = $conn->prepare($sql);
if($stmt===false){
echo"Prepare statement failed".$stmt->error;
}
else{
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        $id = $row['id'];
        $name = $row['name'];
        $contact = $row['contact'];
        $location = $row['location'];
        $blacklist = $row['blacklist'];
    }
}

}


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "links.php"; ?>
    <title>Document</title>
</head>
<body>



<div class="container d-flex justify-content-center align-items-center flex-row flex-wrap-wrap">


<div style="display:block;">

<a style="cursor:pointer" class="text-primary text-underline-underline " onclick="history.go(-1)"><i class="fa fa-chevron-left text-lg text-primary"></i> Go to the previous page</a>

<br>
<form method="POST" action="">
<input type="hidden" name="id" value="<?php echo htmlspecialchars($id)?>"><br>
<label class="mt-2 mb-2" for="name">Name:</label>
<input type="text" class="mt-2 border border-0" name="name" placeholder="name" value="<?php echo htmlspecialchars($name)?>"><br>
<label class="mt-2 mb-2 " for="name">Contact:</label>
<input type="text" class="mt-2  border border-0" name="contact"  placeholder="contact"  value="<?php echo htmlspecialchars($contact)?>"><br>
<label class="mt-2 mb-2" for="name">Location:</label>
<input type="text"  class="mt-2  border border-0"  name="location"  placeholder="location"  value="<?php echo htmlspecialchars($location) ?>"><br>
<br>

<?php if($blacklist==0){ ?>

<label for="blacklist">Blacklisted:</label>

<select class="mt-2 mb-3 mr-2 border border-0 " name="blacklist" id="">

<option value="0" selected>Not Blacklisted</option>

<option value="1">Blacklisted</option>

</select>

<?php } else { ?>

<select class="mt-2 mb-3 mr-2 border border-0 " name="blacklist" id="">

<option value="1" selected>Blacklisted</option>

<option value="0">Not Blacklisted</option>

</select>

<?php } ?>

<button class="btn btn-success text-center" name="submit">Submit</button>


</form>
</div>


</div>


</body>
</html>






<?php
if(isset($_POST['submit'])){
$id = $_POST['id'];
$name = $_POST['name'];
$contact = $_POST['contact'];	
$location =	 $_POST['location'];	
$blacklist = $_POST['blacklist'];
$conn = new Database();
$query ="
UPDATE user_profile SET name = ?,contact = ?,location = ?,blacklist = ? WHERE id= ?";
$stmt = $conn->prepare($query);
if($stmt === false){
    echo "Prepared statement failed". $stmt->error;
}
else{

$stmt->bind_param('ssssi',$name, $contact, $location, $blacklist, $id);
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