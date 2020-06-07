<?php
    session_start();

    include 'header.php';
    
    $price = 0;
    $odFoundString = "";

    function printList(){
        global $price;
        $con = mysqli_connect("localhost","root","","stuff2");

        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $sql = "select * from moviesdb where link='". $_SESSION['movie'] ."'";
        $result=mysqli_query($con,$sql);
        $sql2 = "select * from commentdb where movie='". $_SESSION['movie'] ."'";
        $result2=mysqli_query($con,$sql2);
        
        while ($dt=mysqli_fetch_array($result)){
            
            $_SESSION['price'] = $dt['price'];
            echo "
            <div class='divlist' id='div'>
                <div class='listmain'>
                    <div id='big' class='listleft'>
                        <img class='listimage' height='500' width='337' src=res/movies/" . $dt['link'] . " alt='" . $dt['name'] . "'>
                    </div>
                    <div class='listright'>
                        <p id='big' class='movelist'>" . $dt['name'] ."</p>
                        <p class='movelist'>" . $dt['desc'] ."</p>
                        <p class='movelist'>IMDb Rating - " . $dt['rate'] ."/100</p>
                        <p class='errormess' style='font-size:25px'>Price - ₹ " . $dt['price'] ."</p>
                        <p class='errormess' style='font-size:18px'>" . $GLOBALS['odFoundString'] ."</p>
                        <input type='submit' style='font-size:25px' name='addtocart' value='Buy'>
                        <br><br>
                        <div>
                            <div style='flex:1; float:left'>
                                <textarea name='commenttxt' rows=1 cols='35' ></textarea>
                            </div>
                            <div style='flex:1; padding-right:15px; float:right'>
                                <input style='font-size:20px' type='submit' name='comment' value='Comment'>
                            </div>
                        </div>
                        <!-- heres come -->
            ";
            
        }
        
        echo "<br><br>";
        
        while ($dt=mysqli_fetch_array($result2))
        {
            echo "
                <table>
                    <tr><td><p class='movelist'><i>" . $dt['username'] .":</i></p></td>
                    <td><p class='movelist'>" . $dt['comment'] ."</p></td><tr>
                 </table>   
            ";
        }
        
        echo "</div></div></div>";
        
        /*$con = new MongoClient();
        $collection = $con->social->comments;
        
        $temp = array("movie"=>$_SESSION['movie']);
        
        $cursor = $collection->find($temp);
        foreach ( $cursor as $dt)
        {
            echo "
                <table>
                    <tr><td><i>". $dt['user'] ." says :</i></td>
                    <td>". $dt['comment'] ."</td><tr>
                 </table>   
            ";
        }*/

    }

    if(isset($_POST['addtocart'])){
        
        $orFound = false;
        $crFound = false;
        
        // Checking if the thing already exists in the orders
        
        $sql3 = "select * from orders where link='". $_SESSION['movie'] ."' and user='".$_SESSION['username']."'";
        $result3=mysqli_query($con,$sql3);
        
        while ($dt=mysqli_fetch_array($result3))
        {
            orFound = true;
        }
        
        if($orFound){
            
            $odFoundString = "Product already bought. Go to Orders page to download it.";
            
        }else{
            
            global $price;
        
            $sql4 = "select * from cartdb where link='". $_SESSION['movie'] ."' and user='".$_SESSION['username']."'";
            $result4=mysqli_query($con,$sql4);

            while ($dt=mysqli_fetch_array($result4))
            {
                orFound = true;
            }
            
            if($crFound){
                $odFoundString = "Product already in the cart. Go to the cart page to buy it.";
            }else{

                $sql4 = "insert into cartdb values ('". $_SESSION['movie'] ."', '". $_SESSION['username'] ."', '". $price ."')";
                
                mysqli_query($con,$sql4);

                echo "
                <!-- The Modal -->
                <div id='myModal' class='modal'>

                <!-- Modal content -->
                <div class='modal-content'>
                <span class='close'>
                <form method='post' name='loginform' action='" . $_SERVER['PHP_SELF'] ." '>
                <input type='submit' class='closebtn' name='close' value='OK x'></span>
                <p class='h1small' >Product added to the cart. </p>
                </div>

                </div>";      
            }
            
        }

    }

    if(isset($_POST['close'])){
        header('Location: movies.php');
    }

    if(isset($_POST['comment'])){
        
        $sql4 = "insert into commentdb values ('". $_SESSION['movie'] ."', '". $_SESSION['username'] ."', '". $_POST['comment'] ."')";
                
        mysqli_query($con,$sql4);
        
        header("Refresh:0");
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
            <?php printList(); ?>
        </form>
        <br><br>

    </body>

</html>