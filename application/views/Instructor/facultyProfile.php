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
         <span style="margin-left:1150px;color: yellow">  Welcome, <?php echo $_SESSION['username']; ?></span> 
      </div>
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
                     <td><input id="uName" class="btn btn-default" style="margin-bottom:10px" type="text" name="uName" value="<?php echo $user->username; ?>" disabled="true" /></td>
                  </tr>
                  <tr>
                     <td>First Name</td>
                     <td><input id="fName" class="btn btn-default" style="margin-bottom:10px" type="text" name="fName" value="<?php echo $user->firstname; ?>" /></td>
                  </tr>
                  <tr>
                     <td>Last Name</td>
                     <td><input id="lName" class="btn btn-default" style="margin-bottom:10px" type="text" name="lName" value="<?php echo $user->lastname; ?>" /></td>
                  </tr>
                  <tr>
                     <td>Email</td>
                     <td><input id="mail" class="btn btn-default" style="margin-bottom:10px" type="text" name="mail" value="<?php echo $user->email; ?>" /></td>
                  </tr>
                  <tr>
                     <td>Phone</td>
                     <td><input id="phone" class="btn btn-default" style="margin-bottom:10px" maxlength="10" type="text" name="phone" value="<?php echo $user->phone; ?>" pattern="^(?!(\d)\1{9})(?!0123456789|1234567890|0987654321|9876543210)\d{10}$" title="enter 10 digit phone number" /></td>
                  </tr>
                  <tr>
                     <td>Address</td>
                     <td><input id="address" class="btn btn-default" style="margin-bottom:10px" type="text" name="address" value="<?php echo $user->address; ?>" /></td>
                  </tr>
                  <tr>
                     <td colspan="2"><input class="btn btn-default" style="margin-left:120px" type="submit" name="updateProfile" value="Update Profile"></td>
                  </tr>
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