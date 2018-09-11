<!DOCTYPE html>
<html>
   <head>
      <title>Password Change Page</title>
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
         .form_error{font-size: 13px;font-family:Arial;color:yellow;font-style:italic}
      </style>
   </head>
   <?php if(isset($_SESSION['username']))
        {
       ?>
   <body background="<?php echo base_url('images/bg.jpg'); ?>">
      
      <div class="header">
      <h2>Header</h2>
      </div>
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
      <a href="<?php echo base_url(); ?>index.php/welcome/logout">Logout</a>
      
      </nav>
      </div>
      <div class="content">
      <span style="margin-left:1150px;color: yellow">  Welcome, <?php echo $_SESSION['username']; ?></span>   
      <form action="" method="POST">
      <center>  
      <div>
      <h2 style="color:white">Change Password</h2>
      </div>
      <table>
      <tbody>
      <tr>
      <td style="padding-right:30px;color: white">Current Password</td>
      <td><input style="margin-bottom:15px" autofocus="autofocus" class="btn btn-default" id="curPwd" type="password" name="curPwd" value="" /></td>
      </tr>
      <tr>
      <td style="color:white;">New Password</td>
      <td><input style="margin-bottom:15px" class="btn btn-default" type="password" name="nPwd" value=""></td>
      </tr>
      <tr>
      <td style="color:white">Confirm Password</td>
      <td><input style="margin-bottom:15px" class="btn btn-default" type="password" name="conPwd" value="" ></td>
      </tr>
      <tr><td colspan="2"><input style="margin-left:100px" class="btn btn-default" type="submit" name="uPwd" value="Update Password"></td></tr>
      </tbody>
      </table>
      <div class="form_error">
      <?php echo validation_errors(); ?>
      </div>
      <?php if(isset($_SESSION['success'])){ ?>
      <div class="form_error"><?php echo $_SESSION['success']; ?></div>
      <?php
         } ?>
      <?php
         //session with name error is declared the condition $rowcount==0 in the facultylogin of FacultyCon
         if(isset($_SESSION['error'])){ ?>
      <div class="form_error"><?php echo $_SESSION['error']; ?></div>
      <?php
         } ?>
      </center>
      </form>
      </div>
   </body>
   <?php }
        else{
             redirect("Welcome/welcomeView");
        }
        ?>
</html>