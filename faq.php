<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <?php  include 'components/links.php'; ?>

    <link rel="stylesheet" href="css/faq.css">

</head>
<body>

<?php  include 'components/layout.php'; ?>

 <div class="hero-section">

   <div class="hero-text">

      <h3>Frequently Asked Questions</h3>

      <br><br>

   </div>

 </div>
<br>


<div class="container questions">

       <h6 class="btn-accordion">Who is John Doe, the richest man in America?  <span class="caret"><i class="fa fa-caret-down"></i></span></h6>

        <p class="accordion-dropdown active-accordion">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Itaque eaque reiciendis beatae, nisi iste sit aliquam quidem consectetur repellat.</p>

              <br>


       <h6 class="btn-accordion">Who is John Doe, the richest man in America?  <span class="caret"><i class="fa fa-caret-down"></i></span></h6>

<p class="accordion-dropdown active-accordion">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Itaque eaque reiciendis beatae, nisi iste sit aliquam quidem consectetur repellat.</p>

<br>


<h6 class="btn-accordion">Who is John Doe, the richest man in America?  <span class="caret"><i class="fa fa-caret-down"></i></span></h6>

<p class="accordion-dropdown active-accordion">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Itaque eaque reiciendis beatae, nisi iste sit aliquam quidem consectetur repellat.</p>

<br>


<h6 class="btn-accordion">Who is John Doe, the richest man in America?  <span class="caret"><i class="fa fa-caret-down"></i></span></h6>

<p class="accordion-dropdown active-accordion">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Itaque eaque reiciendis beatae, nisi iste sit aliquam quidem consectetur repellat.</p>

<br>


</div>


<br><br><br>


<?php  include 'components/footer.php'; ?>

<script>

$(document).ready(function() {

  $(".btn-accordion").each(function() {
    $(this).on('click', function() {
   
  $(this).next(".accordion-dropdown").toggleClass("active-accordion");
    });
  });

});


</script>
</body>
</html>