<?php session_start(); ?>
<?php 
if(isset($_GET['id']) && !empty($_GET['id'])){
   $id = $_GET['id'];
include_once('engine/configure.php'); 
$conn = new Database();
$blacklist = "select * from user_profile where id = ? and blacklist = 1";
$stmt = $conn->prepare($blacklist);
      if($stmt === false){
         echo "Failed to prepare statement";
             }

      else{
           $stmt->bind_param("i",$id);
           $stmt->execute();

             if($stmt->execute()===false){
                  echo"Failed to execute statement";
              }

              else{
                $result = $stmt->get_result(); 

                while ($row = $result->fetch_assoc()) {

                    $name = $row['name'];
                    $image = "dashboard/".$row['img_upload'];
                    $email = $row['email'];
                    $location = $row['location'];

                }

              }

          }

}



?>





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

         <img src="<?php echo $image ?>" alt="user-photo">

        </div>
        <div  class="col-md-4">
         
     
           <div class='wanted_info'>

                <p><i class="fa fa-user-alt"></i> Name: <?php echo$name; ?></p><br>

                <p><i class="fa fa-map-marker"></i> Location: <?php echo $location ?></p><br>

                <p><i class="fa fa-envelope"></i> Email: <?php echo $email ?></p><br>
  
         </div><br>
                <b class="text-center mt-2 fw-bold">Reason for Blacklist</b><br>
                 <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui eveniet quis sunt, delectus labore dolorem veritatis perferendis voluptate reprehenderit quam molestias facere veniam vitae beatae dolorum nam, minima maiores. Voluptas!</p>

        </div>


        
    </div>

</div>

<br>

<div class="container">


<div class="more_pictures">
<ul class="d-none">

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

<h3 style="font-weight:bold;">Blacklisted<span class="see_more"><a href="blacklist.php">See more</a></span></h3><br>

<div class="menu_wanted_container">

<?php 

$blacklist_all = "select * from user_profile where blacklist = 1";
$stmt = $conn->prepare($blacklist_all);
      if($stmt === false){
         echo "Failed to prepare statement";
             }

      else{
          
           $stmt->execute();

             if($stmt->execute()===false){
                  echo"Failed to execute statement";
              }

              else{
                $result = $stmt->get_result(); 

                while ($data = $result->fetch_assoc()) {

                    $name = $data['name'];
                    $image = "dashboard/".$data['img_upload'];
                    $email = $data['email'];
                    $location = $data['location'];
?>

    <div class="menu_wanted">
        <a href="blacklist-details.php?id=<?php echo$row['id']?>"><img src="<?php echo$image ?>" alt=""></a>
    </div>

    <?php               }

}

}





?>
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
