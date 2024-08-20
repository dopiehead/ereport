<html lang="en">
<head>
<?php include 'components/links.php'; ?>
</head>
<body>
 <div class="header">

     <ul>
         <li class="logo"><a href="index.php">LOGO</a></li>
         <li style="visibility:hidden"><a href="#">home</a></li>
         <li class="faq"><a href="faq.php">faq</a></li>
         <li class="categories"><a href="categories.php">categories</a></li>
         <li class="blacklisted"><a href="blacklist.php">blacklisted</a></li>
         <li class="blog"><a href="blog.php">blog</a></li>
         <li class="golive"><a href="golive.php">Golive</a></li>
         <li class="login signup"><a href="sign-in.php">Sign in</a></li>
         
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
             <a href="blog.php"><span class="blog">blog</span></a>
             <a href="golive.php"><span class="golive">Golive</span></a>
            <a href="sign-in.php"><span class="login">Sign in</span></a>


       
     </div>
</div>


<script>

         $(".menu-icon").click(function(){

              $(this).toggleClass("close");

         $("#myform").toggleClass("overlayParent");

         });

</script>

<script>
        $(document).ready(function () {
            let lastScrollTop = 0;
            $(window).scroll(function () {
                let currentScrollTop = $(this).scrollTop();
                if (currentScrollTop > lastScrollTop) {
                    // Scrolling down
                    $('.header').css('visibility', 'hidden'); // Adjust based on header height
                } else {
                    // Scrolling up
                    $('.header').css('visibility', 'visible'); //
                }
                lastScrollTop = currentScrollTop;
            });
        });
    </script>

</body>
</html>