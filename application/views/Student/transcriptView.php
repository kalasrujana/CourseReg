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
         <div class="container">
             <div>
                 <?php 
                 
                 $userName=$_SESSION['username'];
         // echo "Hello".$userName;
         $query="SELECT * from user where username=" . " '$userName' ";
          $this->db->select('*');
          $this->db->from('user');
          $this->db->where(array('username'=>$userName));
          $query1= $this->db->get();
          //use this $user in the value fields to display the values
          $user=$query1->row();
          $uid=$user->userid;
          //echo $uid;
                  
                    $sql="select round((sum(s.total*t.credits)/sum(s.total)),2) as gpa from studentgradelist s, gradecredits t 
                    where s.grade = t.Grade
                    and s.userid=?";
        $query=$this->db->query($sql,$uid);
        $result=$query->row();
       // echo $result->gpa;
        
        
                 
                 ?>
             </div>
             
             <label style="color:skyblue">Your GPA is <?php echo $result->gpa; ?>/4 </label>
             
   <div style="width:500px;margin:50px;">
    <h4>Unofficial Transcript</h4>
    <table class="table table-bordered" style="color: white">
        <tr style="color:yellow">
            <td><strong>S.No</strong></td>
            <td><strong>Year</strong></td><td><strong>Sem</strong></td><td><strong>Course ID</strong></td>
            <td><strong>Course Name</strong></td>
            <td><strong>Grade</strong></td></tr> 
       <?php $count=1; ?>
     <?php foreach($Courses as $cou){?>
     <tr>
         <td><?php echo $count; ?></td>
         <td><?=$cou->year;?></td><td><?=$cou->sem;?></td><td><?=$cou->courseid;?></td><td><?=$cou->course_Name;?></td>
         <td><?=$cou->Grade;?></td>
     </tr>   
     <?php $count=$count+1; ?>
        <?php }?>  
    </table>
   </div> 
  </div> 
        
      </center>
   </body>
   <?php }
        else{
             redirect("Welcome/welcomeView");
        }
        ?>
</html>