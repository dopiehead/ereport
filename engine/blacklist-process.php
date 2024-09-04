<div id='missing-layout'>

<?php 

require "configure.php";
$conn = new Database();

// Base query
$blacklisted = "SELECT * FROM user_profile WHERE blacklist = 1";

// Modify the query based on the sort option
if (isset($_POST['sort'])) {
    $sort = $_POST['sort'];

    if ($sort == 'newest') {
        $blacklisted .= " ORDER BY id ASC";
    } elseif ($sort == 'oldest') {
        $blacklisted .= " ORDER BY id DESC";
    }
}

$stmt = $conn->prepare($blacklisted);

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
            <a href="blacklist-details.php?id=<?php echo urlencode($row['id']) ?>"><img src='<?php echo htmlspecialchars($row['img_upload'], ENT_QUOTES, 'UTF-8') ?>' width="180" height="150"></a><br>
            <figcaption>
                <a href="blacklist-details.php?id=<?php echo urlencode($row['id']) ?>"><b><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?></b></a>
            </figcaption>
        </figure>

        <?php
    }
} else {
    echo "No records found.";
}

// Close the statement
$stmt->close();

?>

</div>
