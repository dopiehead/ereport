<div id='missing-layout'>

<?php 

require "configure.php";
$conn = new Database();
$blacklisted = "select * from user_profile where blacklist = 1";


if(isset($_POST['sort'])){
  $sort = $_POST['sort'];
  
  if($sort =='newest'){
    $blacklisted .="ORDER BY id ASC;";
    }
  
  if($sort =='oldest'){
    $blacklisted .="ORDER BY id DESC;";
    }
  
  }

 $stmt = $conn->prepare($blacklisted);

if (!$stmt) {
  echo "Failed to prepare statement".$stmt->error();
}

else {


  if ($stmt->num_rows>0) {
$stmt->execute();
if($stmt->execute===false){
  echo "Failed to execute statement".$stmt->error();
}
else{
  $result = $stmt->get_result();  
  while ($row = $result->fetch_assoc()) { ?>

  <figure>
<a href="blacklist-details.php?id=<?php echo urlencode($row['id'])?>"><img src='<?php echo$row['img_upload'] ?>' width="180" height="150"></a><br>
<figcaption>
<a href="blacklist-details.php?id=<?php echo urlencode($row['id'])?>"><b><?php echo$row['name'] ?></b></a>
</figcaption>
</figure>   

<?php
  }
}
  }
}

?>



</div>

