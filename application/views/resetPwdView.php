<html>
    <head>
        
    </head>
    <body>
        <h2>Reset Password</h2>
        <div>
            <form action="<?php echo site_url("Welcome/resetPwd"); ?>" method="POST">
                <div>
                <label>Email</label>
                <input type="email" value="<?php echo set_value('email') ?>" name="email"/>
                </div>
                <div>
                    <input type="submit" name="submit" value="Reset my Password"/>
                </div>
            </form>
            <?php
            echo validation_errors('<p class="error">');
            if(isset($error)){
                echo '<p class="error">'.$error.'</p>';
            }
            ?>
        </div>
</body>
</html>