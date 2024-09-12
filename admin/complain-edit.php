<!DOCTYPE html>
<html lang="en">
<head>
<?php include("links.php"); ?>
</head>
<body>
    <div class="container">
        <!-- Side Navigation -->
       <?php include "components.php"; ?>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Header with Notification and Message Icons -->
            <header>
                <div class="header-icons">
                  
          
                </div>
           
            </header>
</div>

</div>

<?php
include("../engine/configure.php");
$conn = new Database();
$notify = "SELECT * FROM admin_alert";
$adminMessage = $conn->prepare($notify);
if($adminMessage==false){
    echo"Prepared statement failed";}
else{
    $adminMessage->execute();
    $result = $adminMessage->get_result();
    
    $countMessage =  $result->num_rows;
    if($countMessage>0) {
        echo$countMessage;
       
        
    }  
}
?>





            <div class="container main-content">
            <div class="table-wrapper">
            <?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $num_per_page = 4;

    if (isset($_POST['page'])) {
        $page = $_POST['page'];
       }
       else{
       $page = 1;  
       }
       $initial_page = ($page-1)*$num_per_page; 

    // Create a database connection
    $conn = new Database();
    
    // Query to join user_profile and report tables
    $query="SELECT 
    user_profile.id AS user_id, 
    user_profile.name AS user_name, 
    user_profile.email AS user_email, 
    user_profile.blacklist AS blacklist,
    complain.complain_id AS complain_id,
    complain.user_id AS complain_user_id,
    complain.complain AS complain,
      complain.fileupload AS file_upload,
    complain.complain_sender_name AS complain_user_name,
    complain.likes AS likes,
    complain.unlikes AS unlikes,
    complain.date AS date
FROM 
    user_profile
LEFT JOIN 
    complain ON user_profile.id = complain.user_id
WHERE 
    complain.user_id = ? ";
    $query .= " limit $initial_page,$num_per_page";

    
    // Prepare the statement
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        echo "Prepared statement failed: " . $stmt->error;
        exit;
    }
    
    // Bind parameters and execute the statement
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if we have results
    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc(); // Fetch user data from the first row
        ?>
                <span class="notification fa fa-bell text-success"></span>
                <span class="alert text-white bg-danger"><?php echo$countMessage?></span>

        <h2 class='d-flex justify-content-center align-items-center '>User Profile: <?php echo htmlspecialchars($user_data['user_name']); ?></h2>

        <p class='d-flex justify-content-center align-items-center'>Blacklisted: <?php echo $user_data['blacklist'] ? 'Yes' : 'No'; ?></p>


        <h3 class='d-flex justify-content-center align-items-center'`>Complains</h3>
        <table class="table-responsive">
            <thead>
                <tr>
                    <th>Complain ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Complain Picture</th>
                    <th>Complain</th>
                    <th>Complain date</th>
                    <th>Complain sender Name</th>
                    <th>Likes</th>
                    <th>Unlikes</th>
                   
                      <th>Delete<th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Reset result pointer
            $result->data_seek(0);
            while ($row = $result->fetch_assoc()) {
                if ($row['complain_id']) { // Check if there's a report (to handle users with no reports)
                    ?>
                    <tr>
                    <td><?php echo htmlspecialchars($row['complain_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                 <td><?php echo htmlspecialchars($row['user_email']); ?></td>
            
                 <td>
    <?php if (!empty($row['fileupload'])): ?>
        <img width='30' height='100' src="../<?php echo htmlspecialchars($row['fileupload']); ?>" alt="User Image">
    <?php else: ?>
        <i class='fa fa-user-alt' style="font-size: 130px;"></i>
    <?php endif; ?>       
            
</td>     
                        <td class='text-md'><?php echo htmlspecialchars(substr($row['complain'],0,50)); ?></td>
                        <td><?php echo htmlspecialchars($row['date']); ?></td>
                        <td><?php echo htmlspecialchars($row['complain_user_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['likes']); ?></td>
                        <td><?php echo htmlspecialchars($row['unlikes']); ?></td>
               
                        <td><a href='edit-complain.php?id=<?php echo htmlspecialchars($row['complain_id']); ?>'><i class='fa fa-trash'></i></a></td>
                    
                    
                   
                    </tr>
                    <?php
                }
            }
            ?>
         
        <?php
    } else {
        echo "<p>No user found with the provided ID.</p>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "<p>ID parameter is missing.</p>";
}


?>

</tbody></table>

<?php
$conn = new Database();
$radius=3;
$pageres ="SELECT 
user_profile.id AS user_id, 
user_profile.name AS user_name, 
user_profile.email AS user_email, 
user_profile.blacklist AS blacklist,
complain.complain_id AS complain_id,
complain.user_id AS complain_user_id,
complain.complain AS complain,
  complain.fileupload AS file_upload,
complain.complain_sender_name AS complain_user_name,
complain.likes AS likes,
complain.unlikes AS unlikes,
complain.date AS date
FROM 
user_profile
LEFT JOIN 
complain ON user_profile.id = complain.user_id
WHERE 
complain.user_id = ? ";
$stmt2 = $conn->prepare($pageres);
$numpage = $stmt2->num_rows;
$total_num_page =ceil($numpage/$num_per_page);
?>
<div class='d-flex justify-content-center align-items-center'>
<?php
echo "<br>";
if ($page>1) {
$previous = $page-1;
echo'<span id="page_num"><a href="complain-edit.php?page='.$previous.'" style="" class="btn-success prev" id="'.$previous.'">&lt;</a></span>';
}
for ($i=1; $i<=$total_num_page; $i++) { 
if(($i >= 1 && $i <= $radius) || ($i > $page - $radius && $i < $page + $radius) || ($i <= $total_num_page && $i > $total_num_page - $radius)) {
if($i == $page) {echo'<span id="page_num"><a href="complain-edit.php?page='.$i.'" class="btn-success" id="'.$i.'">'.$i.'</a></span>';}
  }
elseif($i == $page - $radius || $i == $page + $radius) {
 echo "... ";
}
elseif ($page==$i) {
}
else{
echo'<span id="page_num"><a href="complain-edit.php?page='.$i.'" class="btn-success" id="'.$i.'">'.$i.'</a></span>';
}
} 
if ($page<$total_num_page) {
$next = $page+1;
echo'<span id="page_num"><a class="text-dark" href="complain-edit.php?page='.$next.'" style="" class="btn-success next" id="'.$next.'">&gt;</a></span>';




}

?>


</div>   

<br><br>

<div class='mt-5 p-2 d-flex justify-content-center align-items-center'>

<p>WEBSITE by <b class="text-success fw-bold">Essential Nigeria</b></p>


</div>


            </div>
        </div>
    </div>
    
    </div>
    </div>
    <script>
        // JavaScript to toggle side navigation on mobile
        document.getElementById('nav-toggle').addEventListener('click', function() {
            document.getElementById('side-nav').classList.toggle('active');
        });
    </script>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Approval Button Click Handler
    $(".btn-approve").on('click', function() {
        let id = $(this).attr('id'); // Get the id from the clicked button

        $.ajax({
            method: "POST",
            url: "update-report.php",
            data: { 'id': id },
            success: function(data) {
                if (data.trim() === '1') {
                    // Show success alert
                    Swal.fire({
                        text: 'Report approved successfully',
                        icon: 'success',
                        title: 'Success!'
                    });

                    // Reload specific parts of the page
                    setTimeout(function() {
    window.location.reload();
}, 3000);
                } else {
                    // Show warning alert if response is not '1'
                    Swal.fire({
                        title: 'Notice',
                        icon: 'warning',
                        text: 'Response: ' + data
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX errors
                Swal.fire({
                    title: 'Error',
                    icon: 'error',
                    text: 'An error occurred: ' + error
                });
            }
        });
    });

    // Denial Button Click Handler
    $(".btn-deny").on('click', function() {
        let id = $(this).attr('id'); // Get the id from the clicked button

        $.ajax({
            method: "POST",
            url: "remove-report.php",
            data: { 'id': id },
            success: function(data) {
                if (data.trim() === '1') {
                    // Show success alert
                    Swal.fire({
                        text: 'Approval removed successfully',
                        icon: 'success',
                        title: 'Success!'
                    });

                    // Reload specific parts of the page
                    setTimeout(function() {
    window.location.reload();
}, 3000);
                } else {
                    // Show warning alert if response is not '1'
                    Swal.fire({
                        title: 'Notice',
                        icon: 'warning',
                        text: 'Response: ' + data
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX errors
                Swal.fire({
                    title: 'Error',
                    icon: 'error',
                    text: 'An error occurred: ' + error
                });
            }
        });
    });
});
</script>


<script>
$(".btn-delete").on('click', function() {
    let id = $(this).attr('id'); // Get the id from the clicked button
    let rowElement =$(this).parent().parent();
    $.ajax({
        method: "POST",
        url: "delete-report.php",
        data: {'id': id},
        success: function(data) {
            if (data.trim() === '1') {
                // Show success alert
                swal({
                    text: 'Report delete successful',
                    icon: 'success',
                    title: 'Success!'
                });
                rowElement.fadeOut('slow').remove();
            } else {
                // Show warning alert if response is not '1'
                swal({
                    title: 'Notice',
                    icon: 'warning',
                    text: 'Response: ' + data
                });
            }
        },
        error: function(xhr, status, error) {
            // Handle AJAX errors
            swal({
                title: 'Error',
                icon: 'error',
                text: 'An error occurred: ' + error
            });
        }
    });
});

</script>

<script>
$(".btn-delete").click(function(){
    if(confirm("Are you sure you want to delete this?"))
    {
         e.preventDefault(); 
    }
});

</script>





</body>
</html>