<div id='missing-layout'>

<?php 

require "configure.php";
$conn = new Database();



$num_per_page = 10;
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$initial_page = ($page - 1) * $num_per_page;

// Total number of records for pagination
$total_sql = "SELECT COUNT(*) AS total FROM user_profile WHERE  blacklist = 1";
$total_stmt = $conn->prepare($total_sql);
$total_stmt->execute();
$total_result = $total_stmt->get_result();
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_num_page = ceil($total_records / $num_per_page);


// Base query
$blacklisted = "SELECT * FROM user_profile WHERE blacklist = 1";



if (isset($_POST['q']) && !empty($_POST['q'])) {

    $search = explode(" ",$_POST['q']) ;

   foreach ($search as $text) {

    $blacklisted .= " AND (`name` LIKE '%".$text."%' OR `location` LIKE '%".$text."%' OR `country` LIKE '%".$text."%' OR `facebook` LIKE '%".$text."%' OR `twitter` LIKE '%".$text."%'  OR `instagram` LIKE '%".$text."%'  OR `linkedin` LIKE '%".$text."%')";

    } 
}



// Modify the query based on the sort option
if (isset($_POST['sort'])) {
    $sort = $_POST['sort'];

    if ($sort == 'newest') {
        $blacklisted .= " ORDER BY id ASC";
    } elseif ($sort == 'oldest') {
        $blacklisted .= " ORDER BY id DESC";
    }
}


$blacklisted .= " LIMIT ?, ?" ;

$stmt = $conn->prepare($blacklisted);

$stmt->bind_param("ii", $initial_page, $num_per_page);


if (!$stmt) {
    // Handle the error with a descriptive message
    echo "Failed to prepare statement: " . $conn->error;
    exit; // Stop execution if preparation fails
}

if ($stmt->execute() === false) {
    // Handle the error with a descriptive message
    echo "Failed to execute statement: " . $stmt->error;
    exit; // Stop execution if execution fails
}

$result = $stmt->get_result();  

// Check if there are results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>

        <figure>
            <a href="blacklist-details.php?id=<?php echo urlencode($row['id']) ?>"><img src='<?php echo"dashboard/".htmlspecialchars($row['img_upload'], ENT_QUOTES, 'UTF-8') ?>' width="180" height="150"></a><br>
            <figcaption class="text-center text-secondary">
                <a class="text-secondary" href="blacklist-details.php?id=<?php echo urlencode($row['id']) ?>"><b><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?></b></a>
            </figcaption>
        </figure>

        <?php
    }
} else {
    echo "No record(s) found.";
}

// Close the statement
$stmt->close();

?>






</div>

<div class="pagination-container">



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