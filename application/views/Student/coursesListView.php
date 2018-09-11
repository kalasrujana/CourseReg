<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Courses List</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="<?php echo base_url('style/css/custom.css'); ?>"/>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css"/>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css"/>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
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
      
      <div class="sidenav" id="mydiv">
      <nav>
     <a href="<?php echo base_url('user/profile'); ?>">Home Page</a><br/>
      <a href="<?php echo base_url(); ?>index.php/adminCon/changePassword">Change Password</a><br>
      <a href="<?php echo base_url(); ?>index.php/StudentCon/Student/stu_Profile_Display">Update Profile Details</a><br>
       <a href="<?php echo base_url(); ?>index.php/StudentCon/coursesListCon">Courses List</a><br>
      <a href="<?php echo base_url(); ?>index.php/StudentCon/Student">Enroll Courses</a><br>
      <a href="<?php echo base_url(); ?>index.php/StudentCon/gradeCon/dropCoursesView">Drop Courses</a><br>
      <a href="<?php echo base_url(); ?>index.php/StudentCon/gradeCon">Grade Book/View Registered Courses</a><br>
      <a href="<?php echo base_url(); ?>index.php/StudentCon/TranscriptCon/fetch">View Transcript</a><br>
      <a href="<?php echo base_url(); ?>index.php/adminCon/logout">Logout</a>
      </nav>
      </div>
      </div>
      
      <div class="content">
      <span style="margin-left:1150px;color: yellow;margin-top: 20px">  Welcome, <?php echo $_SESSION['username']; ?></span> 
      
      <div class="container">
          <h1 style="color:white">Edit Courses List</h1>
          
      <table id="example" class="display" cellspacing="0" width="100%">
      <thead>
      <tr>
      <th>Course ID</th>
      <th>Course Name</th>
      <th>Year</th>
      <th>Semester</th>
      <th>Credit Hours</th>
      <th>Department</th>
      <th>Faculty ID</th>
      <th>Faculty Name</th>
     
      </tr>
      </thead>
      <tbody id="showdata">
      </tbody>
      <tfoot>
      
      </tfoot>
      </table>
         
      </div>
      
      
      <!-- must for delete functionality,i have already written below in usermodal so i commented this
         <div><input type="hidden" name="user_id" id="user_id"/></div>
           
         <!--update dialog box-->
      <div id="userModal" class="modal fade">
      <div class="modal-dialog">
      <form method="POST" id="user_form">
      <input type="hidden" name="txtId" value="0"/>
      <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Update Faculty Details</h4>
      </div>
      <div class="modal-body">
      
     
      <label>Course Name</label>
      <input type="text" name="cou_name" id="cou_name" class="form-control" pattern="^[a-zA-Z0-9\. ]*$" title="Enter Course Name without special characters"/><br>
      <label>Credit Hours</label>
      <input type="number" min="1" max="3" name="crehrs" id="crehrs" class="form-control"/><br>
       
      <label>Department</label>
      <input type="text" name="dept" id="dept" class="form-control" maxlength="3" minlength="2" title="Type CS or CIS"/><br>
       <input type="hidden" name="fac_ID" id="fac_ID" class="form-control"/>
     
      <input type="hidden" name="cou_ID" id="cou_ID" class="form-control"/>
       <input type="hidden" name="sem" id="sem" class="form-control"/>
      </div>
      <div class="modal-footer">
      
      <input type="hidden" name="user_id" id="user_id"/>
      <input type="submit" name="action" id="action" value="Add" />
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </div>
      </form>
      </div>
      </div>
         <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
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
                     "url":"<?php echo site_url()?>/StudentCon/coursesListCon/fetch",
                   
                     "type": "POST",
                     
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