<?php
session_start();
include('configure.php');
require '../vendor/autoload.php'; // Ensure Composer's autoload is included




// Initialize FFMpeg


// Error reporting for debugging
error_reporting(E_ALL);

$conn = new Database();
date_default_timezone_set('Africa/Lagos');

// Retrieve user ID from session

$num_per_page = 20;
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$initial_page = ($page - 1) * $num_per_page;

// Total number of records for pagination
$total_sql = "SELECT COUNT(*) AS total FROM report";
$total_stmt = $conn->prepare($total_sql);
$total_stmt->execute();
$total_result = $total_stmt->get_result();
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_num_page = ceil($total_records / $num_per_page);
$sql = "SELECT * FROM report where pending ='0'";
if (isset($_POST['q']) && !empty($_POST['q'])) {
$search = explode(" ",$_POST['q']) ;
foreach ($search as $text) {
$sql .= " AND(`eventDetails` LIKE '%".$text."%' OR `reportPurpose` LIKE '%".$text."%' OR `reportTo` LIKE '%".$text."%' OR `reportCategory` LIKE '%".$text."%' OR `addressOffender` LIKE '%".$text."%'  OR `reporterName` LIKE '%".$text."%')";

    } 
}

if(isset($_POST['sort'])){
    $sort = $_POST['sort'];
    if($sort=='recently_added'){
        $sql.=" ORDER BY date DESC";
    }

    if($sort=='most_viewed'){
        $sql.=" ORDER BY views DESC";
    }

    if($sort=='most_comment'){
        $sql.=" ORDER BY comments DESC";
    }
}



$sql .= " LIMIT ?, ?" ;
$stmt = $conn->prepare($sql);

$stmt->bind_param("ii",$initial_page, $num_per_page);
if (!$stmt->execute()) {
    echo "Error executing query: ";
} else { ?>
    <div class="container trending-section">  
        <?php
        $result = $stmt->get_result();
        
        if($result->num_rows<1){echo "No result found";}
        
        // Get the result set
        while ($row = $result->fetch_assoc()) {
            $videoPath = $row['fileupload'];
           
            // Generate thumbnail path based on file extension
            $thumbnailPath = 'dashboard/thumbnails/' . basename($videoPath) . '.jpg';
            
            // Ensure the thumbnail is generated
       
        ?>
              <div class="post">

                 <div class="post-image">
                        <a class="btn-play" id="<?php echo$row['id'] ?>">
                            <img src="<?php echo htmlspecialchars($thumbnailPath); ?>" alt="Thumbnail" width="100">
                  </div>
                <div class="post-title">
                    <?php echo htmlspecialchars($row['eventTitle']); ?>
                </div>
                <div class="calendar"><i class="fa fa-calendar"></i><?php echo htmlspecialchars($row['eventDate']); ?><i class="fa fa-user"></i> BY  <small style="color:red"><?php echo $row['reporterName'];?></small></div>
                <div class="post-link"><a href="report-details.php?id=<?php echo $row['id'] ?>">Read More <i class="fas fa-arrow-right"></i></a></div>
                
             </div>
           
        <?php
        }
        ?>
      
<?php
}

$stmt->close();
$total_stmt->close();
$conn->close(); // Make sure to close the connection



function truncateToWordsUsingSubstr($string, $wordLimit = 1) {
    // Split the string into an array of words
    $words = explode(' ', $string);

    // Limit the array to the first $wordLimit words
    if (count($words) > $wordLimit) {
        $words = array_slice($words, 0, $wordLimit);
    }

    // Join the words back into a string
    $truncatedString = implode(' ', $words);

    // Use substr() to ensure the string is not too long (optional)
    $maxLength = 200; // Set a maximum length for example
    if (strlen($truncatedString) > $maxLength) {
        $truncatedString = substr($truncatedString, 0, $maxLength) . '...';
    }

    return $truncatedString;
}
?>
</div>




      <div class="pagination-container container text-center d-flex justify-content-space-center align-items-center mt-4">
  
      <div mr-30>

    

            </div>
     <div class="pagination">
<!-- Pagination controls -->
<?php


    $radius = 3; // Number of pages to display around the current page
echo "<br>";
if ($page > 1) {
    $previous = $page - 1;
    echo '<span id="page_num"><a class="btn-success prev" id="' . $previous . '">&lt;</a></span>';
}
for ($i = 1; $i <= $total_num_page; $i++) {
    if (($i >= 1 && $i <= $radius) || ($i > $page - $radius && $i < $page + $radius) || ($i <= $total_num_page && $i > $total_num_page - $radius)) {
        if ($i == $page) {
            echo '<span id="page_num"><a class="btn-success active-button" id="' . $i . '">' . $i . '</a></span>';
        } else {
            echo '<span id="page_num"><a class="btn-success" id="' . $i . '">' . $i . '</a></span>';
        }
    } elseif ($i == $page - $radius || $i == $page + $radius) {
        echo "... ";
    }
}
if ($page < $total_num_page) {
    $next = $page + 1;
    echo '<span id="page_num"><a class="btn-success next" id="' . $next . '">&gt;</a></span>';
}
?>

</div>


 </div>

<br><br><br><br>
<br><br><br><br>
<br><br>