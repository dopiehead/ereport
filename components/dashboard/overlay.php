
<link rel="stylesheet" href="../css/dashboard/overlay.css">

<ul>
                
                 <li><i class="fa fa-home"></i>&nbsp;<label><a href="../index.php">Home</a></label></li>

                 <li><i class="fa fa-icons"></i>&nbsp;<label><a href="../dashboard/dashboard.php">dashboard</a></label></li>

                 <li><i class="fa fa-user-alt"></i>&nbsp; <label><a href="../dashboard/profile.php">Profile</a></label></li>

                 <li><i class="fa fa-plus"></i>&nbsp;<label><a href="../dashboard/post-report.php">Post Report</a></label></li>
                 
                 <li><i class="fa fa-cog"></i>&nbsp;<label>Settings <span class="settings"><i class="fa fa-caret-right"></i></span></label>
                 
                     <ul class="settings_menu">
                         
                         <li><i class="fa fa-key"></i> <label>Change Password</label></li>

                    </ul>
                
                </li>

                 <li><i class="fas fa-sign-out-alt"></i>&nbsp; <label>Log out</label> <span></span></li>

             </ul>


                 
    <script>

$(".settings_menu").hide();

$(".settings").on('click',function(){

$(".settings_menu").toggle();

});

</script>