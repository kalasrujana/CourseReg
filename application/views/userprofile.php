<!DOCTYPE html>
<html>
   <head>
      <title>User Profile Page</title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo base_url('style/css/custom.css'); ?>"/>
      <style>
         body {
         margin: 0;
         font-family: Arial, Helvetica, sans-serif;
         }
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
           <a href="<?php echo base_url('user/profile'); ?>">Home Page</a><br/>
         <a href="<?php echo base_url(); ?>index.php/adminCon/changePassword">Change Password</a><br>
         <a href="<?php echo base_url(); ?>index.php/StudentCon/Student/stu_Profile_Display">Update Profile Details</a><br>
         <a href="<?php echo base_url(); ?>index.php/StudentCon/coursesListCon">Courses List</a><br>
         <a href="<?php echo base_url(); ?>index.php/StudentCon/Student">Enroll Courses</a><br>
         <a href="<?php echo base_url(); ?>index.php/StudentCon/gradeCon/dropCoursesView">Drop Courses</a><br>
         <a href="<?php echo base_url(); ?>index.php/StudentCon/gradeCon">Grade Book/View Registered Courses</a><br>
         <a href="<?php echo base_url(); ?>index.php/StudentCon/TranscriptCon/fetch">View Transcript</a><br>
         <a href="<?php echo base_url(); ?>index.php/welcome/logout">Logout</a>
      </div>
      <div class="content">
         <span style="margin-left:1150px;color: yellow;margin-top: 70px">  Welcome, <?php echo $_SESSION['username']; ?><span>
      </div>
      <center>
         <?php if(isset($_SESSION['success'])){ ?>
         <div class="form_error"><?php echo $_SESSION['success']; ?></div>
         <?php
            } ?>
         <h1 style="color:white">Welcome Student!!!</h1>
      </center>
   </body>
   <?php }
        else{
             redirect("Welcome/welcomeView");
        }
        ?>
</html>