<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<div class="text-center">

<h5><b>Subscribe to our newsletter</b></h5>
<br>
<div class="newsletter container">

      <div class="newsletter-envelope section from-left">

            <i class="fa fa-envelope"></i>

      </div>     


      <div class="newsletter-form section from-right">      
                 
            <input type="text" name="" placeholder="Enter your Email" class="form-control"><br>

            <button type="submit" class="btn btn-danger form-control">Subscribe</button>
      
      </div>

     

</div>

</div>




<br><br>

<div class="footer">
       <div class="container">
    <div class="row">

         <div class="col-md-2">
                     <br><br>
             <div>
                 <a href="#"><i class="fa-brands fa-facebook"></i></a>
                 <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                 <a href="#"><i class="fa-brands fa-twitter"></i></a>
                 <br>
                 <br>
             </div>

             <div>
                
             </div>

         </div>


         <div class="col-md-2">
             
         <a href="faq.php">faq</a>
            <a href="categories.php">categories</a>
            <a href="blacklist.php">blacklisted</a>
             <a href="blog.php">blog</a>
             <a href="#">Golive</a>
            <a href="signup.php">Sign in</a>

         </div>

         <div class="col-md-2">
            
              <h6>Support</h6>              
              <a href="#">Contact us</a>
              <a href="#">Feedback</a>
            
         </div>


         <div class="col-md-3">
            
            <h6>Legal</h6>

            <a href="#">Terms and condition</a>
            <a href="#">Privacy policy</a>
            
         </div>


         <div class="col-md-3">

                 <div class="essential_cookies">
                  
                     <p>Our site uses essential cookies to work</p>
                      
                     <div>
                          <a href="#">Decline all</a>

                          <a href="#">Accept all</a>
                     </div>

                 </div>

         </div>


    </div>


    </div>

    <br>
      
    <div class="created"><p>©2024 Ereport. Website by <b style="color:white;">Essential</p></div>

    <br>

  </div>

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

<script>
    $(document).ready(function() {
        // Function to check if element is in viewport
        function isElementInViewport(el) {
            var rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }

        // Function to add the 'visible' class when in view
        function checkIfInView() {
            $('.section').each(function() {
                if (isElementInViewport(this)) {
                    $(this).addClass('visible');
                }
            });
        }

        // On scroll or resize, check if elements are in view
        $(window).on('scroll resize', function() {
            checkIfInView();
        });

        // Initial check in case elements are already in view
        checkIfInView();
    });
</script>