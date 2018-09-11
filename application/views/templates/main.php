<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

        <style type="text/css">
        #header{     width:100%;
                    height:100px;
                    background: #ff0;
        }
        
         #footer{     width:100%;
                    height:100px;
                    background: #ff0;
        }
        
         #sidebar{     width:20%;
                    height:600px;
                    background: #f00;
                    float: left;
        }
        #content{
            width:80%;
                    height:600px;
                    float: left;
        }
        .clear{
            clear: both;
        }
        
        </style>
</head>
<body>

<?php
if($header){
    echo $header;
}
if($sidebar){
    echo $sidebar;
}
?>
    <div id="content"><?php
if($page){
    echo $page;
}
?></div>
    <div class="clear"></div>
    <?php
if($footer){
    echo $footer;
}
?>

</body>
</html>