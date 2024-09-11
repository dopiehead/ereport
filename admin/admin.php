<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "links.php"; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<div class="main-content">
            <!-- Header with Notification and Message Icons -->
            <header>
                <div class="header-icons">
                  
          
                </div>
           
            </header>
</div>

</div>

</div>
    


    <div class="container main-content">

  
        <!-- Side Navigation -->
        <?php include "components.php"; ?>
        
        <!-- Main Content -->

        


            <div class="table-wrapper">
            
                    
     


                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Toggle side navigation on mobile
            $('#nav-toggle').on('click', function() {
                $('#side-nav').toggleClass('active');
            });

            // Load content
            $(".table-wrapper").load("admin-engine.php");

            // Replace content with a test message (optional, can be removed if not needed)
         
        });
    </script>

     

<div id="password_modal" class="password_modal bg-secondary">

<a class='modal_close'><i class="fa fa-close"></i></a>

<div class="modal_header">

    <h5 class="text-white">Change Password</h5>
 
</div>

<div class="modal-content">


<input type="password" name="opassword" class="border border-0 mt-2" placeholder="Old password">

<input type="password" name ="npassword" class="border border-0 mt-2" placeholder="New password">

<input type="password" name ="cpassword" class="border border-0 mt-2" placeholder="Confirm password">

<button class="btn btn-success btn-password">Submit</button>

<?php include 'dashboard/../components/loader.php'; ?>

</div>


</div>


</body>
</html>
