<html>
   <head>
      <title>Enroll Courses</title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo base_url('style/css/custom.css'); ?>"/>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <style>
         .form_error{font-size: 13px;font-family:Arial;color:yellow;font-style:italic}
         span { width:50%; display:inline-block; }
         span.align-right { text-align:right;padding-left: 1050px }
         span a { font-size:16px; }
         .box
         {
         width:100%;
         max-width: 650px;
         margin:0 auto;
         }
      </style>
   </head>
   <?php if(isset($_SESSION['username']))
        {
       ?>
   <body background="<?php echo base_url('images/bg.jpg'); ?>">
      
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
      <span style="margin-left:1150px;color: yellow;margin-top: 20px">  Welcome, <?php echo $_SESSION['username']; ?></span>
      <center>
      <?php
         $userName=$_SESSION['username'];
         // echo "Hello".$userName;
         $query="SELECT * from user where username=" . " '$userName' ";
          $this->db->select('*');
          $this->db->from('user');
          $this->db->where(array('username'=>$userName));
          $query= $this->db->get();
          //use this $user in the value fields to display the values
          $user=$query->row();
          
         ?>
      <form action="<?php echo site_url("StudentCon/Student/enrollCourse"); ?>" method="POST">
      <div class="container box">
      <h3 style="color:white">Select the Year,Semester and Course</h3>
      <br />
     
       <div class="form-group">
      <select name="yr" id="yr" class="form-control input-lg" required title="Select Year">
      <option value="">Select Year</option>
      
      <option value="2018">2018</option>
      <option value="2019">2019</option>
      </select>
      </div>
      <br />
      <div class="form-group">
      <select name="semester" id="semester" class="form-control input-lg" required title="Select Semester">
      <option value="">Select Semester</option>
      <option value="Fall">Fall</option>
      <option value="Summer-2">Summer-2</option>
      <option value="Summer-1">Summer-1</option>
      <option value="Spring">Spring</option>
      </select>
      </div>
      <br />
      <div class="form-group">
      <select name="cou" id="cour" class="form-control input-lg" required title="Select Course">
      <option value="">Select course</option>
      </select>
      </div>
      <input type="hidden" id="uID" name="uID" value="<?php echo $user->userid ?>"/>
      <br />
      <div><input type="submit" class="btn btn-default" name="enroll" value="Enroll Course"></input></div>
      </div>
      </form>
      <label name="errmsg"></label><?php if(isset($_SESSION['success'])){ ?>
      <div class="form_error"><?php echo $_SESSION['success']; ?></div>
      <?php
         } ?> 
      <?php
         //session with name error is declared the condition $rowcount==0 in the adminLogin of adminCon
         if(isset($_SESSION['error'])){ ?>
      <div class="form_error"><?php echo $_SESSION['error']; ?></div>
      <?php
         } ?>
      <!--to display req field validation errors-->
      <div class="form_error">
      <?php echo validation_errors(); ?>
      </div>
      </center>
  
<script>
   $(document).ready(function(){
    $('#semester').change(function(){
     var semester = $('#semester').val();
     var yr=$('#yr').val();
     var uID=$('#uID').val();
     
     //alert(yr);
     //alert(semester);
     if(semester !== '' & yr!=='')
     {
         
         $.ajax({
                    url:"<?php echo site_url()?>/StudentCon/Student/fetch_sem1",
                    method:"POST",
                    data:{yr:yr,semester:semester,uID:uID},
                    success:function(data){
                       //alert(data);
          $('#cour').html('<option value="">Select Course</option>'); 
                       var dataObj = jQuery.parseJSON(data);
                      // alert(dataObj);
                       if(dataObj){
                           $(dataObj).each(function(){
                               var option = $('<option />');
                               option.attr('value', this.course_ID).text(this.course_Name);           
                               $('#cour').append(option);
                           });
                       }else{
                           alert('No courses available to register!!');
                           $('#cour').html('<option value="">courses not available</option>');
                       }
                    }
               });
     }
     else
     {
      alert("hi");
     
     }
    });
    
   });
</script>
 </body>
    <?php }
        else{
             redirect("Welcome/welcomeView");
        }
        ?>

</html>