<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Faculty List</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="<?php echo base_url('style/css/custom.css'); ?>"/>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css"/>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css"/>
      <style type="text/css">
         span { width:50%; display:inline-block; }
         span.align-right { text-align:right;padding-left: 1050px }
         span a { font-size:16px; }
      </style>
   </head>
   <?php if(isset($_SESSION['username']))
        {
       ?>
   <body background="<?php echo base_url('images/bg.jpg'); ?>">
     
      <div class="sidenav">
         <!-- <a href="<?php echo base_url(); ?>index.php/adminCon/changePassword">Change Password</a><br>-->
           <a href="<?php echo base_url('faculty/profile'); ?>">Home Page</a><br/>
         <a href="<?php echo base_url(); ?>index.php/InstructorCon/FacultySearchCon">Faculty List(Search)</a><br>
         <a href="<?php echo base_url(); ?>index.php/InstructorCon/CoursesSearchCon">Courses List(Search)</a><br>
         <a href="<?php echo base_url(); ?>index.php/InstructorCon/Instructor/fac_Profile_Display">Update Profile Details</a><br> 
         <a href="<?php echo base_url(); ?>index.php/InstructorCon/GradesSearchCon">Upload Grades</a><br>
         <a href="<?php echo base_url(); ?>index.php/FacultyCon/logout">Logout</a>
      </div>
      <div class="content">
      <span style="margin-left:1150px;color: yellow;margin-top: 20px">  Welcome, <?php echo $_SESSION['username']; ?></span> 
      <div class="container">
         <h1 style="color:white">Faculty List</h1>
         <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
               <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>User Name</th>
                  <th>Gender</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
               </tr>
            </thead>
            <tbody id="showdata">
            </tbody>
            <tfoot>
               
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
                 "lengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                 "pageLength":5,
                 "ajax":{
                     "url":"<?php echo site_url()?>/FacultySearchCon/fetch",
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