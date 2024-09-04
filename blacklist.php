<html lang="en">
<head>
    <meta charset="UTF-8">
   <title>Blacklist</title>
    <?php  include 'components/links.php'; ?>
    <link rel="stylesheet" href="css/blacklist.css">
</head>
<body>
   
<?php  include 'components/layout.php'; ?>

<div class="hero-section">

<div class="hero-text">


  <h3>
   Blacklisted.
  </h3>
  <p>Reasons for blacklist: Due to bad report and reviews.</p>
       <br><br>
</div>

</div>

<br><br>


<div class="container">

    <div class='' style="background:rgba(192,192,192,0.5);padding:8px;">

    <label for="filter_by"><b style="font-size:14px;">Filter by</b></label>&nbsp;&nbsp;&nbsp;
    <input name="q" id="q" style="border:1px solid transparent;box-shadow:0px 0px 5px rgba(0,0,0,0.1);font-size:18px;" type="search" class="w-85 bg-dark text-white" placeholder="Name or Location" >

  </div>


</div>


<br>


<div class="container">
   <h6>
       <span>
         <b>Sort by</b>
       </span>
         <b>
     <select  style="float:right;border:1px solid transparent;box-shadow:0px 0px 4px rgba(0,0,0,0.1);" name="sort" id="sort">
       <option value="newest">Newest</option>
       <option value="oldest">Oldest</option>
     </select>
       </b>
   </h6>
</div>

<div class="container" id="blacklisted">



</div>
</div>
</div>

<br><br><br>

<?php  include 'components/footer.php';  ?>
</body>
</html>



<script type="text/javascript">

$("#loading-image").hide();
$("#blacklisted").load("engine/blacklist-process.php");
$("#q").on('keyup',function() {
var x = $('#q').val();
if (x=='') {$("#reset").hide();}
else{
$("#reset").show();
}
getData(x);
});

$(document).on('click','.btn-success',function(){
var page = $(this).attr('id');
var x = $('#q').val();
getData(x,page);

});



function getData(x,page) {
$.ajax({
url:"read-report.php",
type:"POST",
data:{'q':x,'page':page},
success:function(data) {
$("#loading-image").hide();
$(".table-container").html(data).show();

}


});


};
</script>