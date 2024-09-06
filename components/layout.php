
 <div class="header">

     <ul>
         <li class="logo"><a href="index.php"><img src="logo.png"></a></li>
         <li style="visibility:hidden"><a href="#">home</a></li>
         <li class="faq"><a href="faq.php">faq</a></li>
         <li class="categories"><a href="categories.php">categories</a></li>
         <li class="blacklisted"><a href="blacklist.php">blacklisted</a></li>
         <li class="blog"><a href="report.php">report</a></li>
         <li class="protest"><a href="protest.php">Protest</a></li>
         <li class="complain"><a href="complain.php">Complain</a></li>
         <li class="golive"><a href="golive.php">Golive</a></li>

         <?php if(isset($_SESSION['id']) && !empty($_SESSION['id'])){ ?>
         
            <li class="login signup"><a href="dashboard/dashboard.php">Profile</a></li>

         <?php } else { ?>

         <li class="login signup"><a href="sign-in.php">Sign in</a></li>
         
         <?php } ?>


         <div class="menu-icon">
               <div class="bar bar1"></div>
               <div class="bar bar2"></div>
               <div class="bar bar3"></div>

         </div>
      
      </ul>


 </div>




 <div id="myform" class="overlay overlayParent">

     <div class="overlay-content">
    
        <a href="index.php"><span class="home">Home</span></a>
            <a href="faq.php"><span class="faq">faq</span></a>
            <a href="categories.php"><span class="categories">categories</span></a>
            <a href="blacklist.php"><span class="blacklisted">blacklisted</span></a>
             <a href="report.php"><span class="blog">report</span></a>
             <a href="protest.php"><span class="protest">protest</span></a>
             <a href="complain.php"><span class="complain">complain</span></a>
             <a href="golive.php"><span class="golive">Golive</span></a>

             <?php if(isset($_SESSION['id']) && !empty($_SESSION['id'])){ ?>
            <a href="sign-in.php"><span class="login">Sign in</span></a>
            <?php } else { ?>
                <a href="sign-in.php"><span class="login">Sign in</span></a>
             <?php } ?>
       
     </div>
</div>


<script>

         $(".menu-icon").click(function(){

              $(this).toggleClass("close");

         $("#myform").toggleClass("overlayParent");

         });

</script>



</body>
</html>