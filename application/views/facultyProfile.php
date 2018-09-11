<!DOCTYPE html>
<html>
   <head>
      <title>Faculty Profile</title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo base_url('style/css/custom.css'); ?>"/>
      <style>
         span { width:50%; display:inline-block; }
         span.align-right { text-align:right;padding-left: 1050px }
         span a { font-size:16px; }
         .form_error{font-size: 13px;font-family:Arial;color:black;font-style:italic}
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
          <?php
          $userName=$_SESSION['username'];
          ?>
          <span style="margin-left:1150px;color: yellow;margin-top: 70px">  Welcome, <?php if(!empty($userName)){echo $userName;} else {
    echo base_url('welcome/aboutMe');
} ?><span>
      </div>
      <center>
         <?php if(isset($_SESSION['success'])){ ?>
         <div class="form_error"><?php echo $_SESSION['success']; ?></div>
         <?php
            } ?>
         <h1 style="color:white">Welcome Faculty!!!</h1>
         <!--<a href="<?php echo base_url(); ?>index.php/InstructorCon/Instructor/add_Assignment">Add New Assignment</a><br>
            <a href="<?php echo base_url(); ?>index.php/InstructorCon/AssignmentSearchCon">Assignment List(Search/Delete)</a><br>-->
      </center>
   </body>
    <?php }
        else{
             redirect("Welcome/welcomeView");
        }
        ?>
</html>