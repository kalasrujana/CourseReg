<!DOCTYPE html>
<html>
   <head>
      <title>Profile Details</title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo base_url('style/css/custom.css'); ?>"/>
      <style>
         span { width:50%; display:inline-block; }
         span.align-right { text-align:right;padding-left: 1050px }
         span a { font-size:16px; }
         .form_error{font-size: 13px;font-family:Arial;color:yellow;font-style:italic}
         td{
         color: white;
         padding-right: 10px;
         }
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
      <center>
          <h1 style="color:white">Update Profile Details</h1>
      <?php
         $userName=$_SESSION['username'];
         //echo "Hello".$userName;
         //to get row of loggedin user 
          $query="SELECT * from user where username=" . " '$userName' ";
          $this->db->select('*');
          $this->db->from('user');
          $this->db->where(array('username'=>$userName));
          $query= $this->db->get();
          //use this $user in the value fields to display the values
          $user=$query->row();
          $rowcount=$query->num_rows();
         // echo $rowcount;
          if($rowcount==1){
         ?>
      <form action="" method="POST">
      <table>
      <tbody>
      <tr>
      <td>User Name</td>
      <td><input class="btn btn-default" style="margin-bottom:10px" id="uName" type="text" name="uName" value="<?php echo $user->username; ?>" disabled="true" /></td>
      </tr>
      <tr>
      <td>First Name</td>
      <td><input class="btn btn-default" style="margin-bottom:10px" id="fName" type="text" name="fName" value="<?php echo $user->firstname; ?>" /></td>
      </tr>
      <tr>
      <td>Last Name</td>
      <td><input class="btn btn-default" style="margin-bottom:10px" id="lName" type="text" name="lName" value="<?php echo $user->lastname; ?>" /></td>
      </tr>
      <tr>
      <td>Email</td>
      <td><input class="btn btn-default" style="margin-bottom:10px" id="mail" type="text" name="mail" value="<?php echo $user->email; ?>" /></td>
      </tr>
      <tr>
      <td>Phone</td>
      <td><input class="btn btn-default" style="margin-bottom:10px" id="phone" type="text" maxlength="10" name="phone" value="<?php echo $user->phone; ?>" pattern="^(?!(\d)\1{9})(?!0123456789|1234567890|0987654321|9876543210)\d{10}$" title="enter 10 digit phone number" /></td>
      </tr>
      <tr>
      <td>Address</td>
      <td><input class="btn btn-default" style="margin-bottom:10px" id="address" type="text" name="address" value="<?php echo $user->address; ?>" /></td>
      </tr>
      <tr><td colspan="2"><input style="margin-left:120px" class="btn btn-default" style="margin-bottom:10px" type="submit" name="updateProfile" value="Update Profile"></td></tr>
      </tbody>
      </table>
      </form>
      <?php } ?>
      <?php if(isset($_SESSION['success'])){ ?>
      <div class="form_error"><?php echo $_SESSION['success']; ?></div>
      <?php
         } ?>
      <div class="form_error">
      <?php echo validation_errors(); ?>
      </div>
      </center>
   </body>
   <?php }
        else{
             redirect("Welcome/welcomeView");
        }
        ?>
</html>