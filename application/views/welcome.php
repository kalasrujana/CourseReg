<html>
   <head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo base_url('style/css/custom.css'); ?>">
      <style type="text/css">
            body {
                overflow:hidden;
            }
    </style>
      <script type="text/javascript">
      history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
      </script>
   </head>
   <body background="<?php echo base_url('images/bg.jpg'); ?>">
      <?php if(isset($_SESSION['success'])){ ?>
      <div class="form_error"><?php echo $_SESSION['success']; ?></div>
      <?php
         } ?>
      <?php
         //session with name error is declared the condition $rowcount==0 in the login of welcome controller
         if(isset($_SESSION['error'])){ ?>
      <div class="form_error"><?php echo $_SESSION['error']; ?></div>
      <?php
         } ?>
      <form action="" method="POST">
         <div class="navbar">
            <a href="<?php echo base_url(); ?>">Welcome</a>
            <a href="<?php echo base_url('welcome/aboutMe') ?>">About Me</a>
            <a href="<?php echo base_url('welcome/contactUs') ?>">Contact Us</a>
         </div>
         <center>
            <div class="main">
            <h1 style="color:white">Welcome to the Course Registration System</h1>
            <div>
               <img src="<?php echo base_url('images/CRS.png') ?>" alt="Smiley face">
            </div>
            <br>
            <p style="color:white"><b>Select your role and Login into the system</b></p>
            <div  class="roleS">
               <span></span><span></span><span></span>
               <select style="margin-right:30px" class="btn" required="required" id="role" name="role">
                  <option>Select Role</option>
                  <option value="3">Student</option>
                  <option value="2">Faculty</option>
                  <option value="1">Administrator</option>
               </select>
               <input class="btn" style="margin-left: -10px;" type="submit" name="login" value="Submit"></input>
            </div>
            <br>
            <table>
               <tr>
                  <td>
                     <!--redirect to user registration form when click on link-->
                     <span style="color:white">  Don't have an account?</span><a href="<?php echo site_url('Welcome/stuRegister'); ?>">Register Here</a>
                  </td>
               </tr>
            </table>
         </center>
      </form>
   </body>
</html>