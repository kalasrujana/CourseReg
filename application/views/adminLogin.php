<!DOCTYPE html>
<html>
   <head>
      <title>Admin Login Page</title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo base_url('style/css/custom.css'); ?>"/>
      <style>
         .form_error{font-size: 13px;font-family:Arial;color:yellow;font-style:italic}
         td{
         color: white;
         padding-right: 10px;
         }
      </style>
   </head>
   <body background="<?php echo base_url('images/bg.jpg'); ?>">
      <div class="navbar">
         <a href="<?php echo base_url(); ?>">Welcome</a>
         <a href="<?php echo base_url('welcome/aboutMe') ?>">About Me</a>
         <a href="<?php echo base_url('welcome/contactUs') ?>">Contact Us</a>
      </div>
      <center>
         <h1 style="margin-top:120px;color:white;margin-bottom: 20px">Administrator Login</h1>
         <form action="" method="POST">
            <table>
               <tbody>
                  <tr>
                     <td>User Name</td>
                     <td><input id="uName" class="btn btn-default" autofocus="autofocus" style="margin-bottom:10px" type="text" name="uName" value="<?php echo set_value('uName'); ?>" /></td>
                  </tr>
                  <tr>
                     <td>Password</td>
                     <td><input type="password" class="btn btn-default" style="margin-bottom:10px" name="pwd" value="<?php echo set_value('pwd'); ?>"></td>
                  </tr>
                  <tr>
                     <td colspan="2"><input style="margin-left: 150px;" class="btn btn-default" type="submit" name="login" value="Login"></td>
                  </tr>
               </tbody>
            </table>
         </form>
         <label name="errmsg"></label>
         <?php if(isset($_SESSION['success'])){ ?>
         <div class="form_error"><?php echo $_SESSION['success']; ?></div>
         <?php
            } ?> 
         <?php
            //session with name error is declared the condition $rowcount==0 in the adminLogin of adminCon
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