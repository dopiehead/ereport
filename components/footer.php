<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<div class="text-center">

<h5><b>Subscribe to our newsletter</b></h5>

<br>
<form method="POST" id="subcriptionForm">

<div class="newsletter container ">

      <div class="newsletter-envelope section from-left mr-3">

            <i class="fa fa-envelope"></i>

      </div>     

  

      <div class="newsletter-form section from-right">  


             <a class="btn btn-cart form-control bg-transparent text-white border border-white border-2 mb-3 p-2 " onclick="btn_cat()">Select Categories</a>
                 
            <input type="text" name="email" placeholder="Enter your Email" class="form-control">
            
            <button class="btn btn-subscribe btn-danger mt-3 form-control">Subscribe</button>

      
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
             <a href="golive.php">Golive</a>
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
                          <a class="decline">Decline all</a>

                          <a class="accept">Accept all</a>
                     </div>

                 </div>

         </div>


    </div>


    </div>

    <br>
      
    <div class="created"><p>©2024 Ereport. Website by <b style="color:white;">Essential</p></div>

    <br>

  </div>

  

  <div class="popup" id="popup">
  <h6 class="text-dark text-center fw-bold text-uppercase text-lg"><b>Choose comments category</b></h6>
    <a id="close" onclick="btn_cat()">&times;</a>
    <div class="d-flex justify-content-start align-items-center px-1 gap-5">
    <a id="next" class='bg-success p-1 mr-1' onclick="prev_cat()"><i class="fa fa-chevron-left"></i></a>
    <a id="previous"  class='bg-success p-1' onclick="next_cat()"><i class="fa fa-chevron-right"></i></a>
    </div>
    
    
    <h6>Choose category</h6>

        <div class="container newsletter-choose">
                           
                               

             <div class="first_slide">
         
                  <span><input name="subscription_category[]" type="checkbox" value="bank"><strong>bank</strong></span>
                  <span><input name="subscription_category[]" type="checkbox" value="service provider"><strong>service provider</strong></span>
                  <span> <input name="subscription_category[]" type="checkbox" vaue="electricity"><strong>electricity</strong></span>
                  <span><input name="subscription_category[]" type="checkbox" value="electricity"><strong>Inventions</strong></span>
             </div>

             <div class="first_slide">
                  <span><input name="subscription_category[]" type="checkbox" value="wanted person"><strong>wanted person</strong></span>
                  <span><input name="subscription_category[]" type="checkbox" value="court matters"><strong>court matters</strong></span>
                  <span> <input name="subscription_category[]" type="checkbox" value="relationship"><strong>relationship</strong></span>

                  <span><input  name="subscription_category[]" type="checkbox" value="stolen vehicles"><strong>stolen vehicles</strong></span>
             </div>
          
             <div class="first_slide">
                  <span><input name="subscription_category[]" type="checkbox" value="spiritual"><strong>spiritual</strong></span>
                  <span><input name="subscription_category[]" type="checkbox" value="landlord"><strong>landlord</strong></span>
                  <span> <input name="subscription_category[]" type="checkbox" value="individual"><strong>individual</strong></span>
                  <span><input name="subscription_category[]" type="checkbox" value="leadership"><strong>leadership</strong></span>
            </div>


            <div class="second_slide">
                  <span><input name="subscription_category[]" type="checkbox" value="police"><strong>Police</strong></span>
                  <span><input name="subscription_category[]" type="checkbox" value="teacher"><strong>Teacher</strong></span>
                  <span> <input name="subscription_category[]" type="checkbox" value="school"><strong>School</strong></span>
                  <span><input name="subscription_category[]" type="checkbox" value="hospital"><strong>Hospital</strong></span>
            </div>

            <div class="second_slide">
                 <span><input name="subscription_category[]" type="checkbox" value="immigration"><strong>Immigration</strong></span>
                 <span><input name="subscription_category[]" type="checkbox" value="custom"><strong>Custom</strong></span>
                 <span><input name="subscription_category[]" type="checkbox" value="civil Service"><strong>Civil Service</strong></span>
                 <span><input name="subscription_category[]" type="checkbox" value="army"><strong>Army</strong></span>
            </div>

            <div class="second_slide">
                 <span><input name="subscription_category[]" type="checkbox" value="insurance"><strong>Insurance</strong></span>
                  <span><input name="subscription_category[]" type="checkbox" value="pharmaceuticals"><strong>Pharmaceuticals</strong></span>
                  <span><input name="subscription_category[]" type="checkbox" value="hotels"><strong>Hotels</strong></span>
                  <span><input name="subscription_category[]" type="checkbox" value="As tip off gist"><strong>As tip off gist</strong></span>
                  <span><input name="subscription_category[]" type="text" placeholder="Others"></span>
            </div>

        </div>
     

        <button type="button" class="form-control btn btn-danger mt-4" onclick="btn_cat()">Submit</button>
        <?php   include("components/loader.php");  ?>

        </form>
  </div>


  <script type="text/javascript">
 function btn_cat() {
var popup = document.getElementById('popup');
popup.classList.toggle('active');
  }

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

<script>

$(".accept").on('click', function(){
$(".essential_cookies").css("visibility","hidden");
});

$(".decline").on('click', function(){
$(".essential_cookies").css("visibility","hidden");
});
</script>


 <script>
        $(document).ready(function() {
            function checkWidth() {
                if ($(window).width() < 497) {
                    $(".first_slide").hide();
                } else {
                    $(".first_slide").show();
                }
            }

            // Check width on page load
            checkWidth();

            // Check width on window resize
            $(window).resize(checkWidth);
        });
   
function prev_cat(){
    $(".first_slide").show();
    $(".second_slide").hide(); 
}

function next_cat(){
    $(".second_slide").show(); 
    $(".first_slide").hide();  
}

</script>



<script>

$(".btn-subscribe").click(function(e){
e.preventDefault();
let subcription = $("#subcriptionForm").serialize();
$("#loading-image").show();
$.ajax({
      method:"POST",
      url:"engine/subscription-process.php",
      data:subcription,
      success:function(response){
        $("#loading-image").hide();
        if(response==1){
            swal({
                  title: "Success!",
                  text: "Your subscription has been successful!",
                  icon: "success",
                  buttons: false,
                  timer: 2000
                 });
                 $("#subcriptionForm")[0].reset();
                 $("input:checkbox").val("");
        }

        else{
            swal({

                title: "Error!",
                text: "Subscription Error",
                icon: "error",
                buttons: false,
                timer: 2000
                 });
            
        }
      }
});

});




</script>