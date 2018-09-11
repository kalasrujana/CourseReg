<!DOCTYPE html>
<html>
<head>
    <title>Student Term Selection</title>
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
<form action="<?php echo site_url("StudentCon/Student2/couSel"); ?>" method="POST">
<center>
    <h1>Select the semester</h1>
    <div>
     
         Semester
               <select id="sem" name="sem" title="please select the semester" required>
                    <option value="">Select Semester</option>
                    <option value="Fall">Fall</option>
                <option value="Summer-2">Summer-2</option>
                <option value="Summer-1">Summer-1</option>
                <option value="Spring">Spring</option>
              </select>
    </div>      
    
    <h4>select the role and login into the system</h4>
    <input type="submit" name="login" value="Submit"></input>
</center>
</form>
</body>
</html>

