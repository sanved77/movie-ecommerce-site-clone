<?php
    session_start();
    $total = 0;
    $name = "";
    $isThere = false;
    $arr = array();
    include 'header.php';
    ob_start();
    echo "<form method='post' name='loginform' action='" . $_SERVER['PHP_SELF']. "'>";
    
        $con = mysqli_connect("localhost","root","","stuff2");

        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $sql = "select * from cartdb where username='". $_SESSION['username'] ."'";
        $result=mysqli_query($con,$sql);


        
        
        echo "<br><br><div class='divlist' id='div'><br>";

        $ctr = 0;
        while ($dt=mysqli_fetch_array($result))
        {
            $sql3 = "select * from moviesdb where movie='". $_SESSION['movie'] ."'";
            $result3=mysqli_query($con,$sql3);
            foreach ( $result3 as $dt2)
            {
                $name = $dt2['name'];
            }
            
            echo "
        
            <div class='listmain'>
                <div class='listleft'>
                    <img class='listimage' height='200' width='140' src=res/movies/" . $dt['name'] . " alt='" . $dt['name'] . "'>
                </div>
                <div class='listright'>
                    <p id='big' class='movelist'>" . $dt2['name'] ."</p>
                    <p class='errormess'>Price - ". $dt2['price']. "</p>
                    <input type='submit' name='remove[" . $ctr . "]' value='Remove'>

                </div>
            </div>
        
            ";
            
            $arr[] = $dt['name'];
            $ctr = $ctr + 1;
            $total = $total + $dt2['price'];
            $isThere = true;
        }
        
        if($isThere){
            echo "<center></table><br>
            <input type='submit' style='font-size:25px' name='clear' value='Clear Cart'>
            <br><br><br>
            <h1 class='h1small'>Total - ₹". $total ."</h1>
            <input type='submit' style='font-size:35px' name='checkout' value='Checkout'>     
            <br><br><br><br></center></div>";
        }else{
            echo"
                <br><br>
                <center><h1 class='h1small'>Cart Empty</h1></center>
            ";
        }

    if(isset($_POST['checkout'])){
        $_SESSION['checkout'] = $total;
        header('Location: checkout.php');
    }

    if(isset($_POST['clear'])){
        $sql4 = "delete * from cartdb where username='". $_SESSION['username'] ."'";
        $result4=mysqli_query($con,$sql4);
        header('Refresh:0');
    }

    if(isset($_POST['remove'])){
        
        $keyn = key($_POST['remove']);
        
        $moviename = $arr[$keyn];
        
        $sql5 = "delete * from cartdb where username='". $_SESSION['username'] ."' and name='".$moviename."'";
        $result5=mysqli_query($con,$sql5);
        
        header('Refresh:0');
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
        
        <br><br>
        
        
            
        </form>
        <br><br>

    </body>

</html>