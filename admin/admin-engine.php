<?php 
include("../engine/configure.php");
$conn = new Database();
$query = "SELECT * FROM user_profile";
$stmt = $conn->prepare($query);
$stmt->execute();
$result =$stmt->get_result();
echo"<table class='table-striped table-hovered '>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                       
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>";
while($row = $result->fetch_assoc()) { ?>

    <tr>
    <td><?php echo $row['id'] ?></td>
    <td><?php echo $row['name'] ?></td>
    <td><?php echo $row['email'] ?></td>
    <td><?php echo $row['contact'] ?></td>
    <td><?php echo $row['location'] ?></td>
   




    <td><a href="details.php?id=<?php echo $row['id'] ?>">Details</a></td>

</tr>

<?php }

echo"</tbody>
 <table>";

?>