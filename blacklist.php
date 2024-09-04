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

<div id="overlay" style="display: none;">
  <div class="loader"></div>
</div>



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
    <input name="q" id="q" style="border:1px solid transparent;box-shadow:0px 0px 5px rgba(0,0,0,0.1);font-size:18px;" type="search" class="w-85" placeholder="Name or Location" >

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

$("#overlay").hide();
$("#blacklisted").load("dashboard/blacklist-process.php");
$("#q").on('keyup',function() {
  $("#overlay").show();
var x = $('#q').val();
if (x=='') {$("#reset").hide();}
else{
$("#reset").show();
}
getData(x);
});

$("#sort").on('change',function(){
  $("#overlay").show();
var sort = $("#sort").val();
var x = $('#q').val();
getData(x,sort);

});

$(document).on('click','.btn-success',function(){
  $("#overlay").show();
var page = $(this).attr('id');
var x = $('#q').val();
var sort = $("#sort").val();
getData(x,sort,page);

});



function getData(x,sort,page) {
$.ajax({
url:"dashboard/blacklist-process.php",
type:"POST",
data:{'q':x,'sort':sort,'page':page},
success:function(data) {
$("#overlay").hide();
$("#blacklisted").html(data).show();

}


});


};
</script>