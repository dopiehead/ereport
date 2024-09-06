<?php
session_start();
include('configure.php');
require 'vendor/autoload.php'; // Ensure Composer's autoload is included

use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use FFMpeg\Media\Video;

// Initialize FFMpeg
$ffmpeg = FFMpeg::create([
    'ffmpeg.binaries'  => 'C:\Users\USER\AppData\Local\Microsoft\WinGet\Packages\Gyan.FFmpeg.Essentials_Microsoft.Winget.Source_8wekyb3d8bbwe\ffmpeg-7.0.2-essentials_build\bin\ffmpeg.exe',
    'ffprobe.binaries' => 'C:\Users\USER\AppData\Local\Microsoft\WinGet\Packages\Gyan.FFmpeg.Essentials_Microsoft.Winget.Source_8wekyb3d8bbwe\ffmpeg-7.0.2-essentials_build\bin\ffprobe.exe',
]);

// Error reporting for debugging
error_reporting(E_ALL);

$conn = new Database();
date_default_timezone_set('Africa/Lagos');

// Retrieve user ID from session
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;

$num_per_page = 4;
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$initial_page = ($page - 1) * $num_per_page;

// Total number of records for pagination
$total_sql = "SELECT COUNT(*) AS total FROM report WHERE user_id = ?";
$total_stmt = $conn->prepare($total_sql);
$total_stmt->bind_param("i", $user_id);
$total_stmt->execute();
$total_result = $total_stmt->get_result();
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_num_page = ceil($total_records / $num_per_page);


$sql = "SELECT * FROM report WHERE user_id = ? ";


if (isset($_POST['q']) && !empty($_POST['q'])) {

    $search = explode(" ",$_POST['q']) ;

   foreach ($search as $text) {

      $sql .= " AND (`eventDetails` LIKE '%".$text."%' OR `reportPurpose` LIKE '%".$text."%' OR `reportTo` LIKE '%".$text."%' OR `reportCategory` LIKE '%".$text."%' OR `addressOffender` LIKE '%".$text."%')";

    } 
}


$sql .= "LIMIT ?, ?" ;

$stmt = $conn->prepare($sql);




if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("iii", $user_id, $initial_page, $num_per_page);

if (!$stmt->execute()) {
    echo "Error executing query: " . $stmt->error;
} else { ?>
    <table class="table-striped table-hover table-responsive" style="width:100%;">
        <thead>
            <tr>
                <th style="padding:20px;font-size:14px;"><input type="checkbox"></th>
                <th style="padding:20px;font-size:14px;">Video / Photo</th>
                <th style="padding:20px;font-size:14px;">Details</th>
                <th style="padding:20px;font-size:14px;">Report Location</th>
                <th style="padding:20px;font-size:14px;">Report Purpose</th>
                <th style="padding:20px;font-size:14px;">Report to</th>
                <th style="padding:20px;font-size:14px;">Report category</th>
                <th style="padding:20px;font-size:14px;">Date</th>
                <th style="padding:20px;font-size:14px;">Time</th>
                <th style="padding:20px;font-size:14px;">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $result = $stmt->get_result(); // Get the result set
        while ($row = $result->fetch_assoc()) {
            $videoPath = $row['fileupload'];
            // Generate thumbnail path based on file extension
            $thumbnailPath = 'thumbnails/' . basename($videoPath) . '.jpg';
            if (pathinfo($videoPath, PATHINFO_EXTENSION) === 'mov') {
                $thumbnailPath = 'thumbnails/' . basename($videoPath) . '.jpg';
            }

            // Ensure the thumbnail is generated
            if (!file_exists($thumbnailPath)) {
                generateThumbnail($videoPath, $thumbnailPath);
            }
        ?>
            <tr>
                <td style="padding:20px;font-size:14px;"><input type="checkbox"></td>
                <td style="padding:20px;font-size:14px;">
                    <a class="btn-play" id="<?php echo$row['id'] ?>"><img src="<?php echo htmlspecialchars($thumbnailPath); ?>" alt="Thumbnail" width="100"></a>
                </td>
                <td style="padding:20px;font-size:14px;"><?php echo htmlspecialchars(truncateToWordsUsingSubstr($row['eventDetails'])); ?></td>
                <td style="padding:20px;font-size:14px;"><?php echo htmlspecialchars($row['addressOffender']); ?></td>
                <td style="padding:20px;font-size:14px;"><?php echo htmlspecialchars($row['reportPurpose']); ?></td>
                <td style="padding:20px;font-size:14px;"><?php echo htmlspecialchars($row['reportTo']); ?></td>
                <td style="padding:20px;font-size:14px;"><?php echo htmlspecialchars($row['reportCategory']); ?></td>
                <td style="padding:20px;font-size:14px;"><?php echo htmlspecialchars($row['eventDate']); ?></td>
                <td style="padding:20px;font-size:14px;"><?php echo htmlspecialchars($row['eventTime']); ?></td>
                <td style="padding:20px;font-size:14px;"><strong class="text-success">Pending</strong> &nbsp;</td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
<?php
}

$stmt->close();
$total_stmt->close();
$conn->close(); // Make sure to close the connection

function generateThumbnail($videoPath, $thumbnailPath, $time = '00:00:01') {
    global $ffmpeg;

    // Check if the video file exists
    if (!file_exists($videoPath)) {
        echo "Video file does not exist: $videoPath<br>";
        return;
    }

    // Ensure the thumbnails directory exists and is writable
    $thumbnailDir = dirname($thumbnailPath);
    if (!is_dir($thumbnailDir)) {
        mkdir($thumbnailDir, 0755, true); // Create the directory if it does not exist
    }

    try {
        $video = $ffmpeg->open($videoPath);
        $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(1))->save($thumbnailPath);
        
    } catch (\Exception $e) {
        echo "Failed to generate thumbnail for $videoPath. Error: " . $e->getMessage() . "<br>";
    }
}

function truncateToWordsUsingSubstr($string, $wordLimit = 30) {
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
      <div class="pagination-container">
            
            
         

            <div>

            <p>Showing <?php echo(($page-1)* $num_per_page + 1) ?> out of <?php echo$total_records ?></p>


            </div>
     <div class="pagination text-center">
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

 <div class="popup" id="popup">

     <a class="close" id="close">&times;</a>

     <div class="video-player">

 
     </div>

 </div>

<script>
$(document).on('click','.btn-play',function(){
let id = $(this).attr('id');
$.ajax({
url:"uploaded-video.php",
method:"POST",
data:{'id':id},
success:function(data){
$(".popup").show();
$(".video-player").html(data);
}
});
});
$(document).on('click','.close',function(){
    $(".popup").hide();
});

</script>

