<nav class="side-nav" id="side-nav">
            <button class="nav-toggle text-dark bg-secondary mx-4" id="nav-toggle">&#9776; toggle</button>
            <br><br>
            <img class='admin-logo' src="../logo.png">
           
            <h2 class="text-danger bg-dark">Admin Panel</h2>
            <ul>
                <li><a href="admin.php">Dashboard</a></li>
            
                <li>
                    
                <a id="btn-settings">Settings</a>

                <ul class="setting-container d-none">
                <li><a class="text-secondary change_password" >Change Email</a></li>
                   <li><a class="text-secondary change_password" >Change Password</a></li>
                </ul>
            
            </li>
                <li><a href="../engine/logout.php">Logout</a></li>
            </ul>
        </nav>

        <script>

           $('.change_password').click(function(){
             $('#password_modal').show();
           });



        </script>