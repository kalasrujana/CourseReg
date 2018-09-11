<!DOCTYPE html>
<html>
   <head>
      <title>Add Course</title>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo base_url('style/css/custom.css'); ?>"/>
      <style>
         .form_error{font-size: 13px;font-family:Arial;color:yellow;font-style:italic}
         span { width:50%; display:inline-block; }
         span.align-right { text-align:right;padding-left: 1050px }
         span a { font-size:16px; }
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
      <span style="margin-left:1150px;color: yellow">  Welcome, <?php echo $_SESSION['username']; ?></span>  
      <center>
      <h1 style="margin-top:40px;color:white;margin-bottom: 20px">Add Course</h1>
      <form action="" method="POST">
      <table>
      <tr>
      <td>
      Course ID
      </td>
      <td><input class="btn btn-default" style="margin-bottom:10px" autofocus="autofocus" minlength="2"  id="cid" type="text" name="cid" required="true" title="Enter unique Course ID"  /></td>
      </tr>
      <tr>
      <td>Course Name</td>
      <td><input class="btn btn-default" style="margin-bottom:10px" id="couName" type="text" name="couName" minlength="2" pattern="^[a-zA-Z0-9\. ]*$" title="Enter Course Name without special characters" /></td>
      </tr>
      <tr>
          <td>Year</td>
         <!-- <td><input id="yr" type="text" name="yr" value="<?php echo set_value('yr'); ?>" required="true" maxlength="4"/></td>-->
          <td><select class="btn btn-default" style="margin-bottom:10px" id="yr" name="yr" title="please select the year" required>
      <option></option>
      
      <option value="2018">2018</option>
      <option value="2019">2019</option>
      
      </select></td>
      </tr>
      <tr>
      <td>
      Semester
      </td>
      <td><select class="btn btn-default" style="margin-bottom:10px" id="sem" name="sem" title="please select the semester" required>
      <option></option>
      <option value="Fall">Fall</option>
      <option value="Summer-2">Summer-2</option>
      <option value="Summer-1">Summer-1</option>
      <option value="Spring">Spring</option>
      </select></td>
      </tr>
      <tr><td>Credit Hours</td>
      <td><select class="btn btn-default" style="margin-bottom:10px" id="hrs" name="hrs" required title="select credit hours">
      <option></option>
      <option value="3">3</option>
      </td>
      </tr>
      <tr>
      <td>Department</td>
      <td><select class="btn btn-default" style="margin-bottom:10px" id="dept" name="dept" required title="select Department">
      <option></option>
      <option value="CIS">CIS</option>
      <option value="CS">CS</option></td>
      </tr>
      <tr>
      <td>Instructor</td>
      <td><select class="btn btn-default" style="margin-bottom:10px" id="insName" name="insName" required title="select Instructor">
      <option value="">Select Faculty ID</option>
      <?php
         foreach($groups as $faculty)
         {
             echo '<option value="'.$faculty['userid'].'">'.$faculty['username'].'</option>';
         }
         //ob_end_flush();
         ?></td>
      </tr>
      <tr><td colspan="2"><input class="btn btn-default" style="margin-left: 75px;" type="submit" name="addCourse" value="Add Course"></td></tr>
      </table>
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
       <script type="text/javascript">
           document.getElementById('cid').value = "<?php echo $_POST['cid'];?>";
           
           document.getElementById('couName').value = "<?php echo $_POST['couName'];?>";
           document.getElementById('yr').value = "<?php echo $_POST['yr'];?>";
  document.getElementById('sem').value = "<?php echo $_POST['sem'];?>";
  document.getElementById('hrs').value = "<?php echo $_POST['hrs'];?>";
  document.getElementById('dept').value = "<?php echo $_POST['dept'];?>";
  document.getElementById('insName').value = "<?php echo $_POST['insName'];?>";
  
</script>
   </body>
        <?php }
        else{
             redirect("Welcome/welcomeView");
        }
        ?>
</html>