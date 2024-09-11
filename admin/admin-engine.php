<?php 
include("../engine/configure.php");
$conn = new Database();
$query = "SELECT * FROM user_profile";
$stmt = $conn->prepare($query);
$stmt->execute();
$result =$stmt->get_result();
?>
<span class="icon notification fa fa-bell text-success"></span>

<h2 class='d-flex justify-content-center align-items-center '>Welcome Admin</h2>





<?php echo"<table class='table-striped table-hovered table-responsive'>
                    <thead>
                        <tr>
                              
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                           <th>Blacklist</th>
                            <th>Details</th>
                               <th>Edit User</th>
                            <th>Delete User</th>
                        </tr>
                    </thead>
                    <tbody>";
while($row = $result->fetch_assoc()) { ?>

    <tr>
    <td><?php echo $row['id'] ?></td>
    <td><img width="150" height="160" src="<?php echo"../dashboard/". $row['img_upload'] ?>"></td>
    <td><?php echo $row['name'] ?></td>
    <td><?php echo $row['email'] ?></td>
    <td><?php echo $row['contact'] ?></td>
    <td><?php echo $row['location'] ?></td>
    <td><?php if($row['blacklist']==0){echo"Not Blacklisted";} else{echo"Blacklisted";} ?></td>

    <td>
      <div class="d-flex justify-content-center flex-column flex-wrap-wrap p-3 bg-white text-secondary"> 
      <a href="complain-edit.php?id=<?php echo $row['id'] ?>">Complain</a>
      <a href="protest-edit.php?id=<?php echo $row['id'] ?>">Protest</a>
    <a href="details.php?id=<?php echo $row['id'] ?>">Report</a>
    </div> 
</td>
<td><a href="edit-user.php?id=<?php echo $row['id'] ?>"><i class='fa fa-edit'></i></a></td>
    <td><a href="delete-user.php?id=<?php echo $row['id'] ?>"><i class='fa fa-trash'></i></a></td>

</tr>

<?php }

echo"</tbody>
 <table>";

?>