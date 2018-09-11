<!DOCTYPE html>
<html>
   <head>
      <title>User Registration</title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo base_url('style/css/custom.css'); ?>"/>
      <style>
         .form_error{font-size: 13px;font-family:Arial;color:yellow;font-style:italic}
         td{
         color: white;
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
         <h1 style="margin-top:60px;color:white;margin-bottom: 20px">User Registration</h1>
         <h6>All fields indicated with * are required</h6>
         
         <form action="" method="POST">
            <table>
               <tbody>
                  <tr>
                      <td><span style="color:red">*</span>User Name</td>
                      <td><input class="btn btn-default" style="margin-bottom:10px" autofocus="autofocus" id="uName" type="text" name="uName" required="true" pattern="^[a-zA-Z0-9\. ]*$" title="Enter unique username without special characters" value="<?php echo set_value('uName'); ?>" /></td>
                  </tr>
                  <tr>
                     <td><span style="color:red">*</span>First Name</td>
                     <td><input class="btn btn-default" style="margin-bottom:10px" id="fName" type="text" name="fName" required="true" value="<?php echo set_value('fName'); ?>" /></td>
                  </tr>
                  <tr>
                     <td><span style="color:red">*</span>Last Name</td>
                     <td><input class="btn btn-default" style="margin-bottom:10px" id="lName" type="text" name="lName" required="true" value="<?php echo set_value('lName'); ?>" /></td>
                  </tr>
                  <tr>
                     <td><span style="color:red">*</span>Email</td>
                     <td><input class="btn btn-default" style="margin-bottom:10px" id="mail" type="text" name="mail" value="<?php echo set_value('mail'); ?>" /></td>
                  </tr>
                  <tr>
                     <td><span style="color:red">*</span>Role</td>
                     <td>
                        <select  class="btn btn-default" style="margin-bottom:10px" id="role" name="role" required="true" title="please select role">
                           <option></option>
                           <option value="3">Student</option>
                           <option value="2">Faculty</option>
                           <option value="1">Administrator</option>
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td><span style="color:red">*</span>Gender</td>
                     <td>
                        <select class="btn btn-default" style="margin-bottom:10px" id="gender" name="gender" required="true" title="Please select gender">
                           <option></option>
                           <option value="Male">Male</option>
                           <option value="Female">Female</option>
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td>Phone</td>
                     <td><input class="btn btn-default" style="margin-bottom:10px" id="phone" type="tel" name="phone" maxlength="10" title="Enter 10 digit number" pattern="^(?!(\d)\1{9})(?!0123456789|1234567890|0987654321|9876543210)\d{10}$" value="<?php echo set_value('phone'); ?>"  /></td>
                  </tr>
                  <tr>
                     <td>Address</td>
                     <td><input class="btn btn-default" style="margin-bottom:10px" id="address" type="text" name="address" value="<?php echo set_value('address'); ?>" /></td>
                  </tr>
                  <tr>
                     <td><span style="color:red">*</span>Password</td>
                     <td><input class="btn btn-default" style="margin-bottom:10px" type="password" name="pwd" value="<?php echo set_value('pwd'); ?>"></td>
                  </tr>
                  <tr>
                     <td><span style="color:red">*</span>Confirm Password</td>
                     <td><input class="btn btn-default" style="margin-bottom:10px" type="password" name="conpwd" value="<?php echo set_value('conpwd'); ?>"></td>
                  </tr>
                  <tr>
                     <td colspan="2"><input style="margin-left: 110px;" class="btn btn-default" type="submit" name="register" value="Register"></td>
                  </tr>
               </tbody>
            </table>
         </form>
         <?php if(isset($_SESSION['success'])){ ?>
         <div class="form_error"><?php echo $_SESSION['success']; ?></div>
         <?php
            } ?>
         <div class="form_error">
            <?php echo validation_errors(); ?>
         </div>
      </center>
   </body>
   
</html>