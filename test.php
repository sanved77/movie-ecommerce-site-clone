<?php

$var = 7;

echo $var;

function anus(){
    global $var;
    $var = "gg";
    echo $var; 
    
    echo "<input type='submit' name='submit' value='submit'>";
}

if(isset($_POST['submit'])){
    echo $var;  
}

?>

<!DOCTYPE html>
<meta charset="utf-8">
<html>

    <head>
        <title>MovieDB Home</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link rel="shortcut icon" type="image/x-icon" href="res/fav.ico">
    </head>
  
    <body class="login-body">     
        
        <br><br>
        
        <form method="post" name="loginform" action='<?php echo $_SERVER['PHP_SELF'] ?>'>
        
            <?php anus(); ?>
        </form>
        <br><br>

    </body>

</html>