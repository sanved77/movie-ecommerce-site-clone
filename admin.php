<?php
    session_start();

    include 'admin_header.php';

    echo "<div class='divreg' id='div1' align='center'>";
    echo "<h1 class='h1small'>Welcome Admin " . $_SESSION['admin_usr'] . " !</h1><br><br><br>
    <p class='login-sign' style='font-size:25px'>Control Panel Dashboard</p>";

    if(isset($_POST['logout'])){
        session_destroy();
        header('Location: admin_login.php');
    }

    if(isset($_POST['movie'])){
        header('Location: admin_movie.php');
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
        <input type="submit" name="movie" value="Movie Management">    
        <br><br>
        <input type="submit" name="tv" value="TV Shows Management">       
        <br><br><br><br>
        <input type="submit" name="logout" value="Log Out">    
        <br><br>
    </form>
      
    </body>

</html>