<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin-notifications.css">
    <link href="https://fonts.cdnfonts.com/css/poppins" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

   <title>Admin notification</title>
</head>
<body>
   


<div class="container">
<h5 class="text-center text-uppercase text-dark fw-bold mx-3 mt-5">Notifications</h5>
<div class="row mt-3">
<div class="col-md-3">
<?php include "components.php" ?>
</div>
<div class="col-md-9">  
<?php 

include("../engine/configure.php");
$conn = new Database();
$query ="SELECT 
admin_alert.id AS alert_id,
admin_alert.user_id AS alert_user,
admin_alert.message AS alert_message,
admin_alert.date AS alert_date,
admin_alert.pending AS pending,
user_profile.id AS user_id,
user_profile.name AS user_name,
user_profile.email AS user_email,
user_profile.img_upload AS img_upload 
FROM 
admin_alert
LEFT JOIN 
user_profile ON admin_alert.user_id = user_profile.id";
$stmt = $conn->prepare($query);
if($stmt==false){ echo "Prepare statement failed"; } else{
$stmt->execute();
$result =$stmt->get_result();
$count =$result->num_rows;
if($count>0){
while($row = $result->fetch_assoc()) {?>

<div class="alert-container border border-0 p-2 w-100">
    <div class="content d-flex justify-content-space-around align-items-center">
      <span><img class='border border-0 rounded-sm mr-3' width='80' height="80" src ="<?php echo"../dashboard/".$row['img_upload']?>"></span>  <span class="text-primary" id="time"><?php echo time_ago($row['alert_date']); ?></span>
    </div>  
    <div class="content d-flex justify-content-space-around align-items-center">
    
  
    <?php if($row['pending']==0){ ?>    
    <a class="btn-read btn-message" id="<?php echo$row['alert_id'];?>"><p class="text-center text-primary text-underline-underline fw-bold"><?php  echo $row['user_name']." ".$row['alert_message'];?></p></a>
    <?php } else{?> 
    <p class="text-center text-secondary fw-normal"><?php  echo$row['user_name']."".$row['alert_message'];?></p>
      <?php }?>
    
      
    <button class="btn btn-danger" id="<?php echo$row['alert_id'];?>"><i class="fa fa-trash text-white bg-danger"></i></button>
</div>
 </div><br>
<?php
}

}
}

?>
<?php

function time_ago($date) {
   $now = new DateTime();
   $ago = new DateTime($date);
   $interval = $now->diff($ago);

   if ($interval->y > 0) {
       return ($interval->y == 1) ? "A year ago" : $interval->y . " years ago";
   } elseif ($interval->m > 0) {
       return ($interval->m == 1) ? "A month ago" : $interval->m . " months ago";
   } elseif ($interval->d > 0) {
       return ($interval->d == 1) ? "Yesterday" : $interval->d . " days ago";
   } elseif ($interval->h > 0) {
       return ($interval->h == 1) ? "An hour ago" : $interval->h . " hours ago";
   } elseif ($interval->i > 0) {
       return ($interval->i == 1) ? "A minute ago" : $interval->i . " minutes ago";
   } else {
       return ($interval->s <= 5) ? "Just now" : $interval->s . " seconds ago";
   }
}



?>

</div>



</div>




<div class="popup" id="popup">
 


</div>

</body>
</html>








<script>
$(".btn-danger").on('click', function(e) {   
    if(confirm("Are you sure you want to delete this?"))
    { e.preventDefault(); 
    let id = $(this).attr('id'); // Get the id from the clicked button
    let rowElement =$(this).parent().parent();
    $.ajax({
        method: "POST",
        url: "delete-alert.php",
        data: {'id': id},
        success: function(data) {
            if (data.trim() === '1') {
                // Show success alert
                swal({
                    text: 'Alert delete successful',
                    icon: 'success',
                    title: 'Success!',
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

}

});

</script>


<script>
        $(document).ready(function() {
            // Toggle side navigation on mobile
            $(document).on('click','#nav-toggle', function() {
                $('#side-nav').toggleClass('active');
            });
});
    </script>



<script>
$(".btn-message").on('click', function(e) {   

   e.preventDefault();
    let id = $(this).attr('id'); // Get the id from the clicked button
    $.ajax({
        method: "POST",
        url: "admin-read.php",
        data: {'id': id},
        success: function(data) {
            $("#popup").html(data);
            $("#popup").show();
           
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


$(document).on('click','#close-modal',function(){
    $("#popup").hide();
});

</script>








<script>

$(document).on('click','.btn-settings',function(e){
e.preventDefault();
$(".setting-container").toggleClass('active-setting');

});

  </script>