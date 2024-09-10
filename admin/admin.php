<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "links.php"; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
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
                    <span class="icon notification fa fa-bell" title="Notifications"></span>
    
                </div>
            
            </header>
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
            $(".table-wrapper").html("<div>Hello</div>");
        });
    </script>
</body>
</html>
