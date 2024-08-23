<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat|sofia|Trirong|Poppins">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard/post-reply.css">
    
    <style>
        body{
        font-family:poppins;
        }
    </style>
</head>
<body>
    <div class="dashboard">

         <div class="menu-body">

             <div class="logo-container">
                
  
                 <h6>Ereport</h6>

             </div>
       
             <?php include '../components/dashboard/overlay.php'; ?>

         </div> 

     
       
              <!------------------------- section || ---------------->
     

         <div class="board">

             <div class="menu-container">

                 <div class="menu-board">

                     <div class="menu">
         
                          <i class="fa fa-bars"></i>

                          <input type="search" placeholder="Search">

                     </div>


                     <div class="menu">
         
                          <i class="fa fa-bell"></i>

                          <i class="fa fa-comments"></i>

                     </div>
     
                 </div>
                 


             <h6>Post report</h6>
               


             </div>

                  
        <div class="manage">

             <div>
         
               

             </div>

             <div class="add-delete">
                 <a class="add_report"><i class="fa fa-plus"></i> Add New Report</a> 
                 <a  class="remove_report"> <i class="fa fa-minus"></i>Delete</a>
             </div>

         </div>

       
         
         <div class="table-container">

<!-------------------------  menu     -------------------------------->
     


<div class="row">

<div class="col-md-6">

<label for="offender">Name Of Offender</label>
 
<input type="text" class="form-control" placeholder="Name">

</div>

<div class="col-md-6">

<label for="addressOffender">Address of Offender</label>

<input type="text" class="form-control" placeholder="Address">

</div>

</div>

<div class="row">

<div class="col-md-6">

<label for="Date of Event">Date of Event</label>
 
<input type="text" class="form-control" placeholder="Date">

</div>

<div class="col-md-6">

<label for="Time of Event">Time of Event</label>

<input type="text" class="form-control" placeholder="Time">

</div>

</div>

<label for="Details of Event">Details of Event</label>

<input type="text" class="form-control" placeholder="Text Here">


<label for="Purpose of reporting">Purpose of reporting</label>

<input type="text" class="form-control" placeholder="Text Here">

<br>

<h6>Who would you like us to report to (Please thick)</h6>

<input type="checkbox"> Manager <br>
<input type="checkbox"> Owner <br>
<input type="checkbox"> The government <br>
<input type="checkbox"> Police <br>

<br>

<h6>Will you like to be anonymous (Please thick)</h6>

<input type="checkbox"> Yes <br>
<input type="checkbox"> No<br>
<br>


<h6>Which category are you reporting for (Please thick)</h6>

<input type="checkbox"> Inefficiency <br>
<input type="checkbox"> Negligence <br>
<input type="checkbox"> Rape <br>
<input type="checkbox"> Insult<br>
<input type="checkbox"> Assault <br>
<input type="checkbox"> Bad Approach<br>
<input type="checkbox"> Murder<br>
<input type="checkbox"> Abuse<br>
<input type="checkbox"> Others<br>

<br><br>
<span class='arrow-left'><a href=""> <i class="fa fa-arrow-left"></i> Previous</a></span>
<span class='arrow-right'><a href="">Next <i class="fa fa-arrow-right"></i></a></span>

<br><br>

<!------------------------Step 3---------------------------------------->
<br><br>
<div>

<h6>Voice record Upload</h6>

<div class="file-container">
<label class="file-upload" for="file-upload">Upload voice record
<input type="file">
</label>

</div>

</div>

           <br>

<div>


<h6>Voice evidence Upload</h6>
<div class="file-container">
<label class="file-upload" for="file-upload">Upload Evidence record
<input type="file">
</label>
</div>

</div>

<br><span class='arrow-right'><a href="">Done</a></span>
<br>

</div>



</div>

</div>

<br>













<!-------------------------  end of menu     -------------------------------->
   
         </div>







         </div>   
         
     
     </div>


     <script>

$(".fa-bars").on('click', function() {
    $(this).toggleClass('active');
    
    if ($(this).hasClass('active')) {
        $(".fa-bars").css('backgroundColor', 'lightgreen');
        $(".board").css('width', '100%');
        $(".menu-body").css('width', '7%');
        $("label").css('display', 'none');
    } else {
        $(".fa-bars").css('backgroundColor', ''); // Reset background color
        $(".board").css('width', '80%'); // Reset width to default or initial state
        $(".menu-body").css('width', '30%'); // Reset width to default or initial state
        $("label").css('display', 'inline-block');
    }
});

     </script>




</body>
</html>