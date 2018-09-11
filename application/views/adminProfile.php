<!DOCTYPE html>
<html>
   <head>
      <title>Admin Profile Page</title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo base_url('style/css/custom.css'); ?>"/>
      <style>
         .form_error{font-size: 13px;font-family:Arial;color:yellow;font-style:italic}
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
          <a href="<?php echo base_url('Admins/profile'); ?>">Home Page</a><br/>
      <a href="<?php echo base_url(); ?>index.php/adminCon/addCourse">Add Course</a><br>
      <a href="<?php echo base_url(); ?>index.php/welcome/userRegister">Add Users<br/>(Student/Faculty/Admin)</a><br>
      <a href="<?php echo base_url(); ?>index.php/StudentSearchCon">Students List<br/>(Search/Update/Delete)</a><br>
      <a href="<?php echo base_url(); ?>index.php/FacultySearchCon">Faculty List<br/>(Search/Update/Delete)</a><br>
      <a href="<?php echo base_url(); ?>index.php/AdminsSearchCon">Administrators List<br/>(Search/Update/Delete)</a><br>
      <a href="<?php echo base_url(); ?>index.php/CoursesSearchCon">Courses List<br/>(Search/Update/Delete)</a><br>  
      <a href="<?php echo base_url(); ?>index.php/adminCon/logout">Logout</a>
      </nav>
      </div>
      <div class="content">
      <span style="margin-left:1150px;color: yellow;margin-top: 70px">  Welcome, <?php echo $_SESSION['username']; ?></span>  
      <center>
      <?php if(isset($_SESSION['success'])){ ?>
      <div><?php echo $_SESSION['success']; ?></div>
      <?php
         } ?>
      <h1 style="color:white">Welcome Administrator!!!</h1>
      </center>
   </body>
   <?php }
        else{
             redirect("Welcome/welcomeView");
        }
        ?>
</html>