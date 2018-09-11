<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Grade Book</title>
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
          <h1 style="color:white">Grade Book</h1>
          <label style="color:white"> Select Year</label>
         <!-- <td><input id="yr" type="text" name="yr" value="<?php echo set_value('yr'); ?>" required="true" maxlength="4"/></td>-->
          <select class="btn btn-default" style="margin-bottom:10px" id="yr" name="yr" title="please select the year" required="">
      <option></option>
      <option value="2017">2017</option>
      <option value="2018">2018</option>
      <option value="2019">2019</option>
      
      </select>
      <input type="hidden" value="<?php echo $facID; ?>" id="facID" name="facID"/>
      <table id="example" class="display" cellspacing="0" width="100%">
      <thead>
      <tr>
      <th>Course ID</th>
      <th>Year</th>
      <th>Sem</th>
      <th>Grade</th>
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
            
              $('#yr').change(function(){
             var facID=$('#facID').val();
             var yr=$('#yr').val();
            // alert(facID);
             //alert(yr);
             $('#example').DataTable({
                 "processing": true,
                 "serverSide": true,
                 "lengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
                 "pageLength":5,
                 "bDestroy": true,
                 "ajax":{
                     "url":"<?php echo site_url()?>/StudentCon/GradeCon/fetch",
                     data:{facID:facID,yr:yr},
                     "type": "POST"
                 },
                 "columnDefs":[{
                     "targets":[-1],
                     "orderable":false,
                 }]
             });
             
         
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