<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat|sofia|Trirong|Poppins">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard/dashboard.css">
    
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
                 


             <h6>Dashboard</h6>
               


             </div>

                  
        <div class="manage">

             <div>
         
                <h6>Manage Reports</h6>

             </div>

             <div class="add-delete">
                 <a class="add_report"><i class="fa fa-plus"></i> Add New Report</a> 
                 <a  class="remove_report"> <i class="fa fa-minus"></i>Delete</a>
             </div>

         </div>

       
         
         <div class="table-container">

         <table class="table-striped table-hovered table-responsive" style="width:100%;"> 


             <thead>

                <tr>

                     <th style="padding:20px;font-size:14px;"><input type="checkbox"></th>
                     <th style="padding:20px;font-size:14px;">Subject</th>
                     <th style="padding:20px;font-size:14px;">Video / Photo</th>
                     <th style="padding:20px;font-size:14px;">Details</th>
                     <th style="padding:20px;font-size:14px;">Report Location</th>
                     <th style="padding:20px;font-size:14px;">Date</th>
                     <th style="padding:20px;font-size:14px;">Actions</th>

                 </tr>

             </thead>

            <tbody>

                 <tr>

                      <td style="padding:20px;font-size:14px;"><input type="checkbox"></td>
                      <td style="padding:20px;font-size:14px;">Sandalous Event</td>
                      <td style="padding:20px;font-size:14px;"><img src="../assets/images/yacht.jpg" alt="" width="100"></td>
                      <td style="padding:20px;font-size:14px;">Some details about the incident</td>
                      <td style="padding:20px;font-size:14px;">No 3 Iyalla street, Alausa Ikeja.</td>
                      <td style="padding:20px;font-size:14px;">Aug 12 2024 11:13 am</td>
                      <td style="padding:20px;font-size:14px;"><i class="fa fa-edit"></i> &nbsp;</td>

                 </tr>    

                 <tr>

                 <td style="padding:20px;font-size:14px;"><input type="checkbox"></td>
                      <td style="padding:20px;font-size:14px;">Sandalous Event</td>
                      <td style="padding:20px;font-size:14px;"><img src="../assets/images/yacht.jpg" alt="" width="100"></td>
                      <td style="padding:20px;font-size:14px;">Some details about the incident</td>
                      <td style="padding:20px;font-size:14px;">No 3 Iyalla street, Alausa Ikeja.</td>
                      <td style="padding:20px;font-size:14px;">Aug 12 2024 11:13 am</td>
                      <td style="padding:20px;font-size:14px;"><i class="fa fa-edit"></i> &nbsp; </td>
                 </tr>  


                 <tr>

                 <td style="padding:20px;font-size:14px;"><input type="checkbox"></td>
                      <td style="padding:20px;font-size:14px;">Sandalous Event</td>
                      <td style="padding:20px;font-size:14px;"><img src="../assets/images/yacht.jpg" alt="" width="100"></td>
                      <td style="padding:20px;font-size:14px;">Some details about the incident</td>
                      <td style="padding:20px;font-size:14px;">No 3 Iyalla street, Alausa Ikeja.</td>
                      <td style="padding:20px;font-size:14px;">Aug 12 2024 11:13 am</td>
                      <td style="padding:20px;font-size:14px;"><i class="fa fa-edit"></i> &nbsp;</td>
                 </tr>  

                 <tr>

                 <td style="padding:20px;font-size:14px;"><input type="checkbox"></td>
                      <td style="padding:20px;font-size:14px;">Sandalous Event</td>
                      <td style="padding:20px;font-size:14px;"><img src="../assets/images/yacht.jpg" alt="" width="100"></td>
                      <td style="padding:20px;font-size:14px;">Some details about the incident</td>
                      <td style="padding:20px;font-size:14px;">No 3 Iyalla street, Alausa Ikeja.</td>
                      <td style="padding:20px;font-size:14px;">Aug 12 2024 11:13 am</td>
                      <td style="padding:20px;font-size:14px;"><i class="fa fa-edit"></i> &nbsp;</td>
                  
                    </tr>  


                  <tr>

                  <td style="padding:20px;font-size:14px;"><input type="checkbox"></td>
                      <td style="padding:20px;font-size:14px;">Sandalous Event</td>
                      <td style="padding:20px;font-size:14px;"><img src="../assets/images/yacht.jpg" alt="" width="100"></td>
                      <td style="padding:20px;font-size:14px;">Some details about the incident</td>
                      <td style="padding:20px;font-size:14px;">No 3 Iyalla street, Alausa Ikeja.</td>
                      <td style="padding:20px;font-size:14px;">Aug 12 2024 11:13 am</td>
                      <td style="padding:20px;font-size:14px;"><i class="fa fa-edit"></i> &nbsp;</td>
                  
                 </tr>  

            </tbody>

         </table>

         </div>

         <div class="pagination-container">
            
            
         

              <div>

              <p>Showing 5 out of 15</p>


              </div>
         
         
         
             <div class="pagination text-center">

               <a href="#" class="prev">Previous</a>
                 <a href="#" class="active">1</a>
                 <a href="#">2</a>
                 <a href="#">3</a>
                 <a href="#">4</a>
                 <a href="#">5</a>
                 <a href="#">Next</a>
 
             </div>
          
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