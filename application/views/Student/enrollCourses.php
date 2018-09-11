<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Courses List</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css"/>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css"/>
      
   </head>
   <?php if(isset($_SESSION['username']))
        {
       ?>
   <body>
      <?php if(isset($_SESSION['success'])){ ?>
      <div class="form_error"><?php echo $_SESSION['success']; ?></div>
      <?php
         } ?>
      Hello,<?php echo $_SESSION['username']; ?>
      <br><br>
      <div class="container">
         <h1>Courses List</h1>
         <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
               <tr>
                  <th>Course ID</th>
                  <th>Course Name</th>
                  <th>Semester</th>
                  <th>Credit Hours</th>
                  <th>Department</th>
                  <th>Faculty ID</th>
                  <th>Faculty Name</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody id="showdata">
            </tbody>
            <tfoot>
               <tr>
                  <th>Course ID</th>
                  <th>Course Name</th>
                  <th>Semester</th>
                  <th>Credit Hours</th>
                  <th>Department</th>
                  <th>Faculty ID</th>
                  <th>Faculty Name</th>
                  <th>Action</th>
               </tr>
            </tfoot>
         </table>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>
      <script>
         //search and data load functionality into datatable
         $(document).ready(function(){
             $('#example').DataTable({
                 "processing": true,
                 "serverSide": true,
                 "ajax":{
                     "url":"<?php echo site_url()?>/StudentCon/EnrollCon/fetch",
                     "type": "POST"
                 },
                 "columnDefs":[{
                     "targets":[-1],
                     "orderable":false,
                 }]
             });
             
           
         
         });
      </script>
   </body>
    <?php }
        else{
             redirect("Welcome/welcomeView");
        }
        ?>
</html>