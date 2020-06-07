<?php
session_start();
$username = $_SESSION['username'];
include 'header.php';

if(isset($_POST['movies'])){
    header('Location: movies.php');
}


if(isset($_POST['tv'])){
    header('Location: tv.php');
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
        
        <h1 class="h1big" align="center"><span style="font-weight:normal">MovieDB</span></h1>
    
        <div class="divmain" id="div">
        
            <form method="post" name="loginform" action='<?php echo $_SERVER['PHP_SELF'] ?>' onsubmit="validateForm(); return false;">
            <table class="hometab">     
                <tr>
                    <td><img height="150" width="150" src="res/movies.jpg" alt="Movies"></td>
                    <td><img height="150" width="150" src="res/tv.png" alt="TV Shows"></td>
                </tr>
                <tr>
                    
                    <td><input type="submit" name="movies" value="Movies"></td>
                    <td><input type="submit" name="tv" value="TV Shows"></td>
                </tr>
            </table>
            </form>
        
        </div>

    </body>

</html>