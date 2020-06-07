<?php
    session_start();

    echo "<div class='divreg' id='div1' align='center'><h1>Payment of Rs." . $_SESSION['checkout'] . "</h1><br><br>";

    if(isset($_POST['paynow'])){
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['address'] = $_POST['address'];
        
        $con = new MongoClient();
        $collection = $con->social->cart;
        $orders = $con->social->orders;
        
        $sql = "select * from cartdb where username='". $_SESSION['username'] ."'";
        $result=mysqli_query($con,$sql);
        
        date_default_timezone_set('UTC');
        $today = date("F j, Y, g:i a");
        foreach($result as $dt){
            $ordt = array(
                "name"=>$dt['name'],
                "price"=>$dt['price'],
                "user"=>$dt['user'],
                "date"=>$today
            );
            $sql = "insert into orders values * from cartdb where username='". $_SESSION['username'] ."'";
            $result=mysqli_query($con,$sql);
        }
        
        $remdata = array("user" => $_SESSION['username']);
        $collection->remove($remdata);
        
        header('Location: bill.php');
    }

    if(isset($_POST['cancel'])){
        header('Location: home.php');
    }

    if(isset($_POST['cancelempty'])){
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['address'] = $_POST['address'];
        $_SESSION['cart'] = 0;
        
        $sql = "delete * from cartdb where username='".$_SESSION['username']."'";
        $result=mysqli_query($con,$sql);
        
        header('Location: home.php');
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
            <table class="table-reg">
            
                    <tr>
                        <td>Card Number</td>
                        <td>
                            <input type="text" name="cardnum">
                        </td>
                        
                    </tr>
                    <tr>
                        <td>Owner of the Card</td>
                        <td>
                            <input type="text" name="name">
                        </td>
                    </tr>
                    <tr>
                        <td>CVV</td>
                        <td>
                            <input type="number" name="username">
                        </td>
                    </tr>
                
                    <tr>
                        <td>Enter PIN</td>
                        <td>
                            <input type="password" name="pass">
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Address</td>
                        <td>
                            <textarea name="address" rows=2 ></textarea>
                        </td>
                    </tr>
                               
                </table>
            
            <table><tr>
                <td><input type="submit" name="cancel" value="Cancel"></td>
                <td><input type="submit" name="cancelempty" value="Cancel and Empty Cart"></td>
                </tr>
                <tr>
                <td><td><input type="submit" name="paynow" value="Pay Now"></td></td>
                </tr>
            </form></div>
        <br><br>

    </body>

</html>