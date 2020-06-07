<?php
    session_start();

    include 'admin_header.php';

    $arr = array();
    
    $con = new MongoClient();
    $collection = $con->social->moviesdb;

    $cursor = $collection->find();

    echo "
    <form method='post' name='loginform' action='". $_SERVER['PHP_SELF']. "'><br><br>
    <div class='divlist' id='div'><h1 align='center' class='h1small'>Select a movie to edit</h1><br><br>
    ";

    /*<div class='divlist' id='div'>*/
    $ctr = 0;

    ob_start();

    foreach ( $cursor as $dt)
    {
        
        echo "
        
        <div class='listmain'>
			<div class='listleft'>
                <img class='listimage' height='200' width='140' src=res/movies/" . $dt['link'] . " alt='" . $dt['name'] . "'>
			</div>
			<div class='listright'>
                <p id='big' class='movelist'>" . $dt['name'] ."</p>
				<p class='movelist'>" . $dt['desc'] ."</p>
                <p class='movelist'>Rating - " . $dt['rate'] ."/100</p>
                
                <div>
                    <div style='flex:1; float:left'>
                        <p class='errormess'>Price - ₹ " . $dt['price'] ."</p>
                    </div>
                    <div style='flex:1; padding-right:15px; float:right'>
                        <input type='submit' name='edit[" . $ctr . "]' value='Edit'>
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

    if(isset($_POST['edit'])){
        $keyn = key($_POST['edit']);
        
        $moviename = $arr[$keyn];
        
        $_SESSION['edit_movie'] = $moviename;
        header('Location: edit_movie.php');
        ob_end_flush();
        
    }
    
?>

<!DOCTYPE html>
<meta charset="utf-8">
<html>

    <head>
        <title>Select Movie</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link rel="shortcut icon" type="image/x-icon" href="res/fav.ico">
    </head>
  
    <body class="login-body">     
            
        </form>
        <br><br>

    </body>

</html>