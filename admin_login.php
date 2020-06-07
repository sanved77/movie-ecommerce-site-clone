<?php
	// Initialize variables to null.
	$nameError ="";
	$passError ="";
    $doIt = false;
	// On submitting form below function will execute.
	if(isset($_POST['login'])){
        $doIt = true;
		if (empty($_POST["user"])) {
			$nameError = "Name is required";
            $doIt = false;
        } else {
			$name = test_input($_POST["user"]);
			// check name only contains letters and whitespace
			if (!preg_match("/[A-Za-z0-9]+/",$name)) {
				$nameError = "Only letters and white space allowed";
                $doIt = false;
            }
		}
		if (empty($_POST["pass"])) {
			$passError = "Password is required";
            $doIt = false;
		}
        
        if($doIt){
            
            $didNotLogin = true;
            /* todo - Replace database */ 
            
            $con = new MongoClient();
            $collection = $con->social->admin;
            
            $arr = array('username' => $_POST['user'], 'pass' => $_POST['pass']);
            
            $cursor = $collection->find($arr)->limit(1);

            foreach ( $cursor as $doc)
            {
                session_start();
                $_SESSION['admin_usr'] = $_POST['user'];
            
                $didNotLogin = false;
                header('Location: admin.php');
            }
            
            if($didNotLogin){
             
                $passError = "Wrong username/password";
            
            }
            
        }
        
	}
    if(isset($_POST['reg'])){
        header('Location: register.php');
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
        <title>MovieDB</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link rel="shortcut icon" type="image/x-icon" href="res/fav.ico">
    </head>
    
    <body class="login-body">
        
        <h1 class="h1big" align="center"><span style="font-weight:normal">Admin:MovieDB</span></h1>
    
        <div class="divhome" id="div">
        
            <form method="post" name="loginform" action='<?php echo $_SERVER['PHP_SELF'] ?>' onsubmit="validateForm(); return false;">
                
                <h1 class="h1small"><span style="font-weight:normal">Welcome Admin, <br>Please login to continue</span></h1><br>
            
                
                <!-- Form starts -->
            
                <input type="text" name="user" placeholder="Enter Username">
                <p class="errormess" id="passp"><?php echo $nameError;?></p>
                
                <input type="password" name="pass" placeholder="Enter Password">
                <p class="errormess" id="passp"><?php echo $passError;?></p>
                
                <input type="submit" name="login" value="Login">
                <br>

                <!-- Form ends -->
              
                
            </form>
        
        </div>

    </body>

</html>
