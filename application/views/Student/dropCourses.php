<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Drop Courses</title>
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
      <?php
         $userName=$_SESSION['username'];
         // echo "Hello".$userName;
         $query="SELECT * from user where username=" . " '$userName' ";
          $this->db->select('*');
          $this->db->from('user');
          $this->db->where(array('username'=>$userName));
          $query= $this->db->get();
          //use this $user in the value fields to display the values
          $user=$query->row();
          $facID=$user->userid;
          
         ?>
      <div class="container">
          <h1 style="color:white">Drop Courses</h1>
      <input type="hidden" value="<?php echo $facID; ?>" id="facID" name="facID"/>
      <table id="example" class="display" cellspacing="0" width="100%">
      <thead>
      <tr>
      <th>Course ID</th>
      <th>year</th>
      <th>Sem</th>
      <th>Action</th>
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
             var facID=$('#facID').val();
             $('#example').DataTable({
                 "processing": true,
                 "serverSide": true,
                 "lengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                 "pageLength":5, 
                 "ajax":{
                     "url":"<?php echo site_url()?>/StudentCon/GradeCon/fetch_drop",
                     data:{facID:facID},
                     "type": "POST"
                 },
                 "columnDefs":[{
                     "targets":[-1],
                     "orderable":false,
                 }]
             });
            
            
            //delete course from the datatable
           $(document).on('click','.delete',function(){
             var course_id=$(this).attr("id"); //getting the id from the id in del button ofsubdata[] in studentSearcchModel
             if(confirm("Are you sure you want to drop from the course?"))
             {
                 table=$('#example').DataTable();
                 //if click on ok in the confirm box
                 $.ajax({
                      url:"<?php echo site_url()?>/StudentCon/GradeCon/deleteStudent",
                      method:"POST",
                      data:{course_id:course_id},
                      success:function(data){
                          alert(data);
                          $('#example').DataTable().ajax.reload();
                      }
                 });
             }else{
                 //no action when clicked on cancel in the confirm box
                 return false;
             }
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