<?php
    session_start();

    echo "<div class='divreg' id='div1' align='center'>";
    echo "<h1 class='h1small'>Welcome " . $_SESSION['username'] . " !</h1>
    <p class='login-sign' style='font-size:25px'>Select below options - </p>";

    if(isset($_POST['signout'])){
        session_destroy();
        header('Location: login.php');
    }

    if(isset($_POST['home'])){
        header('Location: home.php');
    }

    if(isset($_POST['edit'])){
        header('Location: editprofile.php');
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
        
    <form method="post" name="loginform" action='<?php echo $_SERVER['PHP_SELF'] ?>'>
        <input type="submit" name="edit" value="Edit Profile">    
        <br><br>
        <input type="submit" name="signout" value="Log Out">    
        <br><br>
        <input type="submit" name="home" value="Go back to Home Page">    
        
    </form>
      
    </body>

</html>