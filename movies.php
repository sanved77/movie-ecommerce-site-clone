<?php
    session_start();

    include 'header.php';

    $arr = array();
    

    $con = mysqli_connect("localhost","root","","stuff2");

    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $sql = "select * from moviesdb";
    $result=mysqli_query($con,$sql);

    echo "
    <form method='post' name='loginform' action='". $_SERVER['PHP_SELF']. "'><br><br>
    <div class='divlist' id='div'><h1 align='center' class='h1small'>Buy Movies at a great price !</h1><br><br>
    ";

    /*<div class='divlist' id='div'>*/
    $ctr = 0;

    ob_start();

    while ($row=mysqli_fetch_array($result)){
 
        echo "
        
        <div class='listmain'>
			<div class='listleft'>
                <img class='listimage' height='200' width='140' src=res/movies/" . $row['link'] . " alt='" . $dt['name'] . "'>
			</div>
			<div class='listright'>
                <p id='big' class='movelist'>" . $row['name'] ."</p>
				<p class='movelist'>" . $row['desc'] ."</p>
                <p class='movelist'>IMDb Rating - " . $row['rate'] ."/100</p>
                
                <div>
                    <div style='flex:1; float:left'>
                        <p class='errormess'>Price - ₹ " . $row['price'] ."</p>
                    </div>
                    <div style='flex:1; padding-right:15px; float:right'>
                        <input type='submit' name='buy[" . $ctr . "]' value='Buy'>
                    </div>
                </div>
                
			</div>
		</div>
        
        ";
        
        /*echo "<div class='divlist' id='div'>
        <table><tr><td>
        <img height='150' width='100' src=res/movies/" . $dt['link'] . " alt='TV Shows'>
        </td></tr><tr><td>Name - " . $dt['name'] . "</td>
        </tr>
        <tr><td>Description - " . $dt['desc'] . "</td></tr>
        <tr><td>Rating - " . $dt['rate'] . "</td></tr>
        <td><input type='submit' name='buy[" . $ctr . "]' value='Buy'></td>
        <br><br><br>
        </div>"; */
        $arr[] = $dt['link'];
        $ctr = $ctr + 1;
    }

    if(isset($_POST['buy'])){
        $keyn = key($_POST['buy']);
        
        $moviename = $arr[$keyn];
        
        $_SESSION['movie'] = $moviename;
        header('Location: buy.php');
        ob_end_flush();
        
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
            
        </form>
        <br><br>

    </body>

</html>