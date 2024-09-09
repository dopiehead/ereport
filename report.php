<?php session_start(); ?>





<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report</title>
</head>
<body>
<?php  include 'components/links.php'; ?>
    <link rel="stylesheet" href="css/blog.css">
</head>
<body>
   
<?php  include 'components/layout.php'; ?>

<div class="hero-section">

<div class="hero-text">


  <h3>
   E-report's <span>Updates</span>  
  </h3>
 <br><br>
</div>

</div>


<?php 
if(isset($_GET['search']) && !empty($_GET['search'])){
$search = $_GET['search']; ?>

<input type="hidden" id="search" value="<?php echo$search;?>">

<script>
$(document).ready(function(){
var search = $('#search').val();
if (search!=''){
$('#q').val(search).trigger('keyup');   
}
 });
 </script>  
<?php } ?>






<div class="container search-container">
     
      <input type="text" name="q" id="q" placeholder="Search for reports..." value="<?php if(isset($search) && !empty($search)){echo$search;}?>">
              
        <select name="newsType" id="newsType">
            
             <option value="video">Video</option>

             <option value="news">News</option>

         </select>

</div>

<br>
<div>


<div class="blog-post-container">
                
            <div class="people-container">
                <!-- display content from db--->
                <div class="db-user">
                    <h3 id="txt-trending-post">Trending Posts</h3>

              <div class="container time_posted">
                
                <select name="sort" id="sort" class="sort">
                  
                   <option value="recently_added">Recently added</option>
      
                   <option value="most_viewed">Most viewed</option>
      
                   <option value="most_comment">Most comment</option>
      
               </select>
             </div>
<div class="trending-home">                
                        
                    </div>
                </div>
                <!--- end of each user item container -->
<br><br><br>
</div>

<div class="container">
    
<div class="ads-right">
        
        <img src="assets/images/ads/ad1.png" alt="">
    
        <img src="assets/images/ads/ad2.png" alt="">
    
        <img src="assets/images/ads/ad3.png" alt="">
    
        <img src="assets/images/ads/ad4.png" alt="">
    
        </div>
        </div>      
    
    </div>


<?php  include 'components/footer.php'; ?>

<script>
$("#loading-image").hide();
$(".trending-home").load("engine/report-read-process.php");
$("#q").on('keyup',function() {
var x = $('#q').val();
if (x=='') {
$("#reset").hide();
}
else{
$("#reset").show();
}
getData(x);
});



$(document).on('change','.sort',function(){
var sort = $(".sort").val();
var x = $('#q').val();
getData(x,sort);

});




$(document).on('click','.btn-success',function(){
var page = $(this).attr('id');
var x = $('#q').val();
var sort = $(".sort").val();
getData(x,sort,page);

});


function getData(x,sort,page) {
$.ajax({
url:"engine/report-read-process.php",
type:"POST",
data:{'q':x,'sort':sort,'page':page},
success:function(data) {
$("#loading-image").hide();
$(".trending-home").html(data).show();
}

});

};




</script>


</body>
</html>