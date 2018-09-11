<!DOCTYPE html>
<html>
   <head>
      <title>Add New Assignment</title>
      <meta charset="utf-8" />
      <style>
         .form_error{font-size: 13px;font-family:Arial;color:red;font-style:italic}
      </style>
   </head>
   <body>
      <h1>Add New Assignment</h1>
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
         <table>
            <tbody>
               <tr>
                  <td>Assignment Name</td>
                  <td><input id="assName" type="text" name="assName" value="" /></td>
               </tr>
               <tr>
                  <td>Number of Points</td>
                  <td><input id="pts" type="text" name="pts" value="" /></td>
               </tr>
               <tr>
                  <td>Course ID</td>
                  <td>
                     <select id="couID" name="couID" required>
                     <option value="">All</option>
                     <?php
                        foreach($groups as $course)
                        {
                            echo '<option value="'.$course['course_ID'].'">'.$course['course_ID'].'</option>';
                        }
                        //ob_end_flush();
                        ?>
                  </td>
               </tr>
               <tr>
                  <td colspan="2"><input type="submit" name="addass" value="Add Assignment"></td>
               </tr>
            </tbody>
         </table>
      </form>
   </body>
</html>