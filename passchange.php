<?php
	
    // Retrieving the data

    session_start();

    $username = $_SESSION['username'];

    $montharr = array('null','January','February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );

    $con3 = new MongoClient();
    $collection3 = $con3->social->userdb;

    $data = array('username' => $username);

    $ret = $collection3->find($data)->limit(1);

    foreach ( $ret as $dt)
    {
        $fname = $dt['fname'];
        $lname = $dt['lname'];
        $address = $dt['address'];
        $country = $dt['country'];
        $date = $dt['birthday']['date'];
        $month = $dt['birthday']['month'];
        $year = $dt['birthday']['year'];
        $pass = $dt['pass'];
    }

    

    $monthstr = $montharr[$month];
    $prevDate = "<option value='" . $date . "' selected='selected'>" . $date . "</option>";
    $prevMonth = "<option value='" . $month . "' selected='selected'>" . $monthstr . "</option>";
    $prevYear = "<option value='" . $year . "' selected='selected'>" . $year . "</option>";
    $prevCountry = "<option value='" . $country . "' selected='selected'>" . $country . "</option>";

    /*
    Edit prerequisites
    */
    // Initialize validation variables to empty strings.
	$passError ="";
    $pass2Error ="";
    $addrError ="";
    $avatarError = "";
    $doIt = false;
    $uploadOk = 1;
	// On submitting form below function will execute.

	if(isset($_POST['passchange'])){
        $doIt = true;
        
         /* Password */
		if (empty($_POST["pass"])) {
			$passError = "Password is required";
            $doIt = false;
		}
        if(strlen($_POST["pass"]) > 1 && strlen($_POST["pass"]) < 8){
            $passError = "Password should be more than 8 characters";
            $doIt = false;
        }
        
        /* Password 2, the retype one */
        if (empty($_POST["pass2"])) {
			$pass2Error = "Password is required";
            $doIt = false;
		}
        if(strlen($_POST["pass2"]) > 1 && strlen($_POST["pass2"]) < 8){
            $pass2Error = "Password should be more than 8 characters";
            $doIt = false;
        }
        if(strcmp($_POST["pass"],$_POST["pass2"]) !=0 ){
            $pass2Error = "Passwords don't match";
            $doIt = false;
        }
    
        if($doIt){
            
            /*
            Database connectivity and registration of the new user
            */
            
            $con = new MongoClient();
            $collection = $con->social->userdb;
            
            $whereclause = array('username'=>$username);
            $data = array('username' => $username, 
                          'pass' => $pass, 
                          'fname'=> $_POST['fname'],
                          'lname' => $_POST['lname'],
                          'address' => $_POST['address'],
                          'country' => $_POST['country'],
                          'birthday' => array('date'=> $_POST['date'],
                                              'month'=> $_POST['month'],
                                              'year' => $_POST['year']
                                             )
                         );
            
            $ret = $collection->update($whereclause, $data);
            
            $_SESSION['username'] = $username;
            
            header('Location: home.php');
        }
        
    }

    if(isset($_POST['back'])){
        header('Location: home.php');
    }

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	//php code ends here
?>
<!DOCTYPE html>
<meta charset="utf-8">
<html>

    <head>
        <title>Change Password : MovieDB</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link rel="shortcut icon" type="image/x-icon" href="res/fav.ico">
    </head>
    
    <body class="login-body">
    
        <div class="divreg" id="div1" align="center">
        
            <form method="post" name="loginform" action="editprofile.php" enctype="multipart/form-data">
                
                <h1 class="h1small"><span style="font-weight:normal">Update your Profile's Info</span></h1>
            
                <br>
                <table class="table-reg">
                    <tr>
                        <td>Username</td>
                        <td>
                            <input type="text" name="username" value="<?php echo $username;?>" disabled>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>Enter Password</td>
                        <td>
                            <input type="password" name="pass">
                            <br>
                            <span><?php echo $passError;?></span>
                        </td>
                    </tr>
                    <tr><p></p></tr>
                    <tr>
                        <td>Retype Password</td>
                        <td>
                            <input type="password" name="pass2">
                            <br>
                            <span><?php echo $pass2Error;?></span>
                        </td>
                    </tr>
                       
                </table>
                <br><br>
                
                <input type="submit" name="passchange" value="Update Password"><br><br><br>
                <input type="submit" name="back" value="Go Back">
              
            </form>
        
        </div>

    </body>

</html>