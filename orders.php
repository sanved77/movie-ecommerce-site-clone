<?php
    session_start();
    $total = 0;
    $name = "";
    $isThere = false;
    $arr = array();
    include 'header.php';
    ob_start();
    echo "<form method='post' name='loginform' action='" . $_SERVER['PHP_SELF']. "'>";
    
        $con = new MongoClient();
        $collection = $con->social->orders;
        $collection2 = $con->social->moviesdb;
        
        
        $temp = array("user" => $_SESSION['username']);
        
        $cursor = $collection->find($temp);
        echo "<br><br><div class='divlist' id='div'><br>";

        $ctr = 0;
        foreach ( $cursor as $dt)
        {
            $temp2 = array("link" => $dt['name']);
            $cursor2 = $collection2->find($temp2)->limit(1);
            foreach ( $cursor2 as $dt2)
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
                    <p id='big' class='movelist'>" . $dt2['desc'] ."</p>
                    <p class='errormess'>Price - ". $dt['price']. "</p>
                    <p class='login-sign'>Bought On - ". $dt['date']. "</p>
                    <input type='submit' name='download[" . $ctr . "]' value='Download'>

                </div>
            </div>
        
            ";
            
            $arr[] = $dt['name'];
            $ctr = $ctr + 1;
            $total = $total + $dt['price'];
            $isThere = true;
        }
        
        if($isThere){
            echo "<center></table><br>
            <input type='submit' style='font-size:25px' name='back' value='Go Home'>
            <br><br><br>";
        }else{
            echo"
                <br><br>
                <center><h1 class='h1small'>No Orders Till Now</h1></center>
            ";
        }

    if(isset($_POST['back'])){
        header('Location: home.php');
    }

    if(isset($_POST['download'])){
        
        $keyn = key($_POST['download']);
        
        $moviename = substr($arr[$keyn], 0, -4);
        
        $filename = "/downloads/" . $moviename . ".mp4";

        $file_name = basename($filename);

        header("Content-Type: video/mp4");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Length: " . filesize($yourfile));

        readfile($yourfile);
        exit;
        
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