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
                    <span class="icon notification fa fa-bell"></span>
          
                </div>
           
            </header>

            <div class="container">
            <div class="table-wrapper overflow-auto">
            <?php
include("../engine/configure.php");
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
    $query = "
        SELECT 
            user_profile.id AS user_id, 
            user_profile.name AS user_name, 
            user_profile.email AS user_email, 
            user_profile.blacklist, 
            COUNT(report.id) AS report_count,
            report.id AS report_id,
            report.reporterName,
            report.eventTitle,
            report.addressOffender,
            report.eventDate,
            report.eventTime,
            report.eventDetails,
            report.reportPurpose,
            report.anonymous,
            report.reportTo,
            report.reportCategory,
            report.fileupload,
            report.images,
            report.comments,
            report.views AS views,
            report.share,
            report.pending AS report_pending,
            report.date AS report_date
        FROM user_profile
        LEFT JOIN report ON user_profile.id = report.user_id
        WHERE user_profile.id = ?
        GROUP BY user_profile.id, report.id
    ";
    $query .= " limit $initial_page,$num_per_page";

    // Prepare the statement
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        echo "Prepared statement failed: " . $conn->error;
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
        <h2>User Profile: <?php echo htmlspecialchars($user_data['user_name']); ?></h2>

        <p>Blacklisted: <?php echo $user_data['blacklist'] ? 'Yes' : 'No'; ?></p>


        <h3>Reports</h3>
        <table class="table-responsive table-striped table-hovered">
            <thead>
                <tr>
                    <th>Report ID</th>
                    <th>Report videos</th>
                    <th>Event Title</th>
                    <th>Reporter Name</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <th>Report Category</th>
                    <th>Report views</th>
                    <th>Status</th>
                    <th>Report Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Reset result pointer
            $result->data_seek(0);
            while ($row = $result->fetch_assoc()) {
                if ($row['report_id']) { // Check if there's a report (to handle users with no reports)
                    ?>
                    <tr>
                    <td><video width='150' height='130' controls><source src="<?php echo "../dashboard/". htmlspecialchars($row['fileupload']); ?>"></video></td>
                        <td><?php echo htmlspecialchars($row['report_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['eventTitle']); ?></td>
                        <td><?php echo htmlspecialchars($row['reporterName']); ?></td>
                        <td><?php echo htmlspecialchars($row['eventDate']); ?></td>
                        <td><?php echo htmlspecialchars($row['eventTime']); ?></td>
                        <td><?php echo htmlspecialchars($row['reportCategory']); ?></td>
                        <td><?php echo htmlspecialchars($row['views']); ?></td>
                        <td><?php if( $row['report_pending']== 0){echo "<strong class='text-primary'>Pending</strong";} else{ echo "<strong class='text-success'>Processed</strong";} ?></td>
                        <td><?php echo htmlspecialchars($row['report_date']); ?></td>
                        <td><a id='<?php echo$$row["user_id"] ?>' class='btn btn-primary'>Approve</a></td>
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
<?php
$conn=new Database();
$radius=3;
$pageres = "SELECT 
            user_profile.id AS user_id, 
            user_profile.name AS user_name, 
            user_profile.email AS user_email, 
            user_profile.blacklist, 
            COUNT(report.id) AS report_count,
            report.id AS report_id,
            report.reporterName,
            report.eventTitle,
            report.addressOffender,
            report.eventDate,
            report.eventTime,
            report.eventDetails,
            report.reportPurpose,
            report.anonymous,
            report.reportTo,
            report.reportCategory,
            report.fileupload,
            report.images,
            report.comments,
            report.views AS views,
            report.share,
            report.pending AS report_pending,
            report.date AS report_date
        FROM user_profile
        LEFT JOIN report ON user_profile.id = report.user_id
        WHERE user_profile.id = ?
        GROUP BY user_profile.id, report.id
    ";

$stmt2 = $conn->prepare($pageres);
$numpage = $stmt2->num_rows;
$total_num_page =ceil($numpage/$num_per_page);
?>
<div align='center'>
<?php
echo "<br>";
if ($page>1) {
$previous = $page-1;
echo'<span id="page_num"><a href="details.php?page='.$previous.'" style="" class="btn-success prev" id="'.$previous.'">&lt;</a></span>';
}
for ($i=1; $i<=$total_num_page; $i++) { 
if(($i >= 1 && $i <= $radius) || ($i > $page - $radius && $i < $page + $radius) || ($i <= $total_num_page && $i > $total_num_page - $radius)) {
if($i == $page) {echo'<span id="page_num"><a href="details.php?page='.$i.'" class="btn-success" id="'.$i.'">'.$i.'</a></span>';}
  }
elseif($i == $page - $radius || $i == $page + $radius) {
 echo "... ";
}
elseif ($page==$i) {
}
else{
echo'<span id="page_num"><a href="details.php?page='.$i.'" class="btn-success" id="'.$i.'">'.$i.'</a></span>';
}
} 
if ($page<$total_num_page) {
$next = $page+1;
echo'<span id="page_num"><a href="details.php?page='.$next.'" style="" class="btn-success next" id="'.$next.'">&gt;</a></span>';




}

?>
</table>
    

<br><br>

<div class='mt-5 p-2 d-flex justify-content-center align-items-center'>

<p>WEBSITE by <b class="text-success fw-bold">Essential Nigeria</b></p>


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

    <script>

        

         

    </script>
</body>
</html>