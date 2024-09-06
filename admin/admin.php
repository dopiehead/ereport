<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container">
        <!-- Side Navigation -->
        <nav class="side-nav" id="side-nav">
            <button class="nav-toggle" id="nav-toggle">&#9776;</button>
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Users</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </nav>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Header with Notification and Message Icons -->
            <header>
                <div class="header-icons">
                    <span class="icon notification">&#128276;</span>
                    <span class="icon message">&#128172;</span>
                </div>
                <h1>Data Table</h1>
            </header>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>More Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>john.doe@example.com</td>
                            <td>(123) 456-7890</td>
                            <td>123 Elm Street</td>
                            <td>Details</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>jane.smith@example.com</td>
                            <td>(987) 654-3210</td>
                            <td>456 Oak Avenue</td>
                            <td>Details</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

    <script>
        // JavaScript to toggle side navigation on mobile
        document.getElementById('nav-toggle').addEventListener('click', function() {
            document.getElementById('side-nav').classList.toggle('active');
        });
    </script>
</body>
</html>