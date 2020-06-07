<?php
    session_start();

    include 'admin_header.php';

    echo "<div class='divreg' id='div1' align='center'>";
    echo "<h1 class='h1small'>Welcome Admin " . $_SESSION['admin_usr'] . " !</h1><br><br><br>
    <p class='login-sign' style='font-size:25px'>Movie Management</p>";

    if(isset($_POST['add'])){
        header('Location: add_movie.php');
    }

    if(isset($_POST['home'])){
        header('Location: admin.php');
    }

    if(isset($_POST['edit'])){
        header('Location: edit_mlist.php');
    }

    if(isset($_POST['remove'])){
        header('Location: remove_movie.php');
    }
?>

<!DOCTYPE html>
<meta charset="utf-8">
<html>

    <head>
        <title>Movie Management</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link rel="shortcut icon" type="image/x-icon" href="res/fav.ico">
    </head>
  
    <body class="login-body">     
        
    <form method="post" name="loginform" action='<?php echo $_SERVER['PHP_SELF'] ?>'>
        <input type="submit" name="add" value="Add Movie">    
        <br><br>
        <input type="submit" name="edit" value="Edit Movie">    
        <br><br>
        <input type="submit" name="remove" value="Remove Movie">    
        <br><br><br>
        <input type="submit" name="home" value="Go Back">    
        
    </form>
      
    </body>

</html>