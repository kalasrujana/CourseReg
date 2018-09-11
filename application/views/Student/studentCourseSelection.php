<!DOCTYPE html>
<html>
   <head>
      <title>Student Course Selection</title>
      <meta charset="utf-8" />
      <style>
         .form_error{font-size: 13px;font-family:Arial;color:red;font-style:italic}
      </style>
   </head>
   <body>
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
      <?php
         $userName=$_SESSION['username'];
         echo "Hello".$userName;
         ?>
      <form action="" method="POST">
         <center>
            <h1>Select the Course</h1>
            <div>
               List Of Courses
               <select id="sem" name="sem" title="please select the semester" required>
               <option value="">Select Course</option>
               <?php
                  foreach($groups as $faculty)
                  {
                      echo '<option value="'.$faculty['course_ID'].'">'.$faculty['course_ID'].'</option>';
                  }
                  //ob_end_flush();
                  ?>
            </div>
            <h4>select the role and login into the system</h4>
            <input type="submit" name="login" value="Submit"></input>
         </center>
      </form>
   </body>
</html>