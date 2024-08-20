<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blackist details</title>
    <?php  include 'components/links.php'; ?>
    <link rel="stylesheet" href="css/blacklist-details.css">
</head>
<body>
<?php  include 'components/layout.php'; ?>   
<br><br>
<p>
<div class="back-button">
<a onclick="history.go(-1)"><i class="fa fa-chevron-left"></i></a>
</div>



<div class="container" style="margin-top:90px;">
  
    <div class="row">
        <div class="col-md-8">

         <img src="https://placehold.co/600x400.png" alt="user-photo">

        </div>
        <div  class="col-md-4">
         
     
           <div class='wanted_info'>

                <p><i class="fa fa-user-alt"></i> Name</p><br>

                <p><i class="fa fa-map-marker"></i> location:</p><br>

                <p><i class="fa fa-envelope"></i> Email:</p><br>
  
         </div><br>

                 <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui eveniet quis sunt, delectus labore dolorem veritatis perferendis voluptate reprehenderit quam molestias facere veniam vitae beatae dolorum nam, minima maiores. Voluptas!</p>

        </div>


        
    </div>

</div>

<br>

<div class="container">


<div class="more_pictures">
<ul>

  <li><img src="https://placehold.co/600x400.png" alt="image-x"></li> 

  <li><img src="https://placehold.co/600x400.png" alt="image-x"></li> 

  <li><img src="https://placehold.co/600x400.png" alt="image-x"></li> 

  <li><img src="https://placehold.co/600x400.png" alt="image-x"></li> 

  <li><img src="https://placehold.co/600x400.png" alt="image-x"></li> 

  <li><img src="https://placehold.co/600x400.png" alt="image-x"></li> 

</ul>




<br><br>

<span class="share"><i class="fa fa-share-alt"></i> Share</span>

<br>
<div class="more-info">

<h6>Person details</h6><br>

             <table>
    
                <tbody>
                    
                 <tr>
                    <td>Name</td>
                    <td>Catherine Isidiaka</td>
                </tr>

                <tr>
                    <td>Sex</td>
                    <td>Female</td>
                </tr>

                <tr>
                    <td>Age</td>
                    <td>23 years old</td>
                </tr>


                <tr>
                    <td>Height</td>
                    <td>158cm : 5.6ft</td>
                </tr>

                <tr>
                    <td>Updated</td>
                    <td>20/10/2023</td>
                </tr>

                <tr>
                    <td>Location(last seen)</td>
                    <td>Ilupeju iyana opaja ikeja nigeria</td>
                </tr>

                <tr>
                    <td>Location(lived)</td>
                    <td>Catherine Isidiaka</td>
                </tr>

                <tr>
                    <td>Landmark</td>
                    <td>Catherine Isidiaka</td>
                </tr>


                <tr>
                    <td>Hair color</td>
                    <td>Catherine Isidiaka</td>
                </tr>

                
                <tr>
                    <td>Skin color</td>
                    <td>Catherine Isidiaka</td>
                </tr>

                 </tbody>

            </table>
<br><br>
</div>
<br>

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam nemo voluptatibus repudiandae esse debitis vero, quisquam accusantium. Excepturi fugiat nobis, modi autem dolore, eius minus repellat fuga error voluptatibus odit?</p>


<br>

<h3 style="ont-weight:bold;">Blacklisted<span class="see_more">See more</span></h3><br>

<div class="menu_wanted_container">

    <div class="menu_wanted">
        <img src="https://placehold.co/600x400.png" alt="">
    </div>

    <div class="menu_wanted">
         <img src="https://placehold.co/600x400.png" alt="">
    </div>

    <div class="menu_wanted">
        <img src="https://placehold.co/600x400.png" alt="">
    </div>

    <div class="menu_wanted">
         <img src="https://placehold.co/600x400.png" alt="">
    </div>

    <div class="menu_wanted">
         <img src="https://placehold.co/600x400.png" alt="">
    </div>

    <div class="menu_wanted">
        <img src="https://placehold.co/600x400.png" alt="">
    </div>

    <div class="menu_wanted">
         <img src="https://placehold.co/600x400.png" alt="">
    </div>



        </div>


      </div>

     </div>

</div>

<?php include 'components/footer.php'?>


<script>
$('.menu_wanted_container').flickity({
    // options
    cellAlign: 'left',
    contain: true,
    prevNextButtons: false,
pageDots: false
  });

</script>




</body>
</html>
