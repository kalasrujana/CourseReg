<!DOCTYPE html>
<html>
   <head>
      <title>Login Page</title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo base_url('style/css/custom.css'); ?>"/>
      <style>
         .form_error{font-size: 13px;font-family:Arial;color:yellow;font-style:italic;padding-right: 95px}
         td{color:white;
         padding-right: 10px}
      </style>
   </head>
   <body background="<?php echo base_url('images/bg.jpg'); ?>">
      <div class="navbar">
         <a href="<?php echo base_url(); ?>">Welcome</a>
         <a href="<?php echo base_url('welcome/aboutMe') ?>">About Me</a>
         <a href="<?php echo base_url('welcome/contactUs') ?>">Contact Us</a>
      </div>
      <center>
         <h1 style="margin-top:120px;color:white;margin-bottom: 50px">Student Login</h1>
         <form action="" method="POST" name="nyForm" id="myForm">
           
            
            <table>
               <tbody>
                  <tr>
                     <td>User Name</td>
                     <td><input style="margin-bottom:10px" class="btn btn-default" id="uName" type="text" name="uName" value="<?php echo set_value('uName'); ?>" autofocus="autofocus" /></td>
                  </tr>
                  <tr>
                     <td>Password</td>
                     <td><input style="margin-bottom:10px" class="btn btn-default" type="password" name="pwd" value=""></td>
                  </tr>
                  <tr>
                     <td colspan="2"><input class="btn btn-default" style="margin-left: 150px;" type="submit" name="login" value="Login"></td>
                  </tr>
               </tbody>
            </table>
            
         </form>
         <?php if(isset($_SESSION['success'])){ ?>
         <div class="form_error"><?php echo $_SESSION['success']; ?></div>
         <?php
            } ?>
         <?php
            //session with name error is declared the condition $rowcount==0 in the login of welcome controller
            if(isset($_SESSION['error'])){ ?>
         <div class="form_error"><?php echo $_SESSION['error']; ?></div>
         <?php
            } ?>
         <div class="form_error">
            <?php echo validation_errors(); ?>
         </div>
      </center>
   </body>
</html>