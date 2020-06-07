<?php
    session_start();

    $today = date("F j, Y, g:i a");

    echo "<center><div style='border: 1px solid; padding: 10px;'><p>Payment of Rs." . $_SESSION['checkout'] . " Done Successfully !</p>
    <p>Dated - " . $today . "</p>
    <p>Receipt is Adressed to " . $_SESSION['name'] . "</p>
    <p>Residence - " . $_SESSION['address'] . "</p>
    ";

    if(isset($_POST['print'])){
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['address'] = $_POST['address'];
        echo $html;
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
  
    <body>     
        
    <form method="post" name="loginform" action='<?php echo $_SERVER['PHP_SELF'] ?>'>
        <input type="button" name="print" value="Print" onclick="window.print();">    
        
    </form>
        
        <a href="home.php">Go back to the homepage</a>
        
        </div>
    </center>
    </body>

</html>