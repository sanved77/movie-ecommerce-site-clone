<?php
	
    // Retrieving the data

    session_start();

    $name = "";

    $moviename = $_SESSION['edit_movie'];

    $con3 = new MongoClient();
    $collection3 = $con3->social->moviesdb;

    $data = array('link' => $moviename);

    $ret = $collection3->find($data)->limit(1);

    foreach ( $ret as $dt)
    {
        $name = $dt['name'];
        $link = $dt['link'];
        $desc = $dt['desc'];
        $rate = $dt['rate'];
        $price = $dt['price'];
    }

    /*
    Edit prerequisites
    */
    // Initialize validation variables to empty strings.
	$fnameError ="";
    $nameError ="";
    $unameError ="";
    $lnameError ="";
	$passError ="";
    $pass2Error ="";
    $addrError ="";
    $avatarError = "";
    $doIt = false;
    $uploadOk = 1;
	// On submitting form below function will execute.
	if(isset($_POST['edit'])){
        $doIt = true;
        
        /* First Name */
		if (empty($_POST["fname"])) {
			$fnameError = "First Name is required";
            $doIt = false;
        }

        /* Address */
        if (empty($_POST["address"])) {
			$addrError = "Address is required";
            $doIt = false;
        } else {
			$name = test_input($_POST["address"]);
		}
        

        if($doIt){
    
            /*
            Database connectivity and registration of the new user
            */
    
            $con = new MongoClient();
            $collection = $con->social->moviesdb;
            
            $temp2 = array('link'=> $link);
            
            $data = array('name' => $_POST['fname'], 
                          'link' => $link, 
                          'desc' => $_POST['address'],
                          'rate' => $_POST['rating'],
                          'price' => $_POST['price']
                         );
            
            $ret = $collection->update($temp2, $data);
            
            echo "
            <div id='myModal' class='modal'>
            <div class='modal-content'>
            <span class='close'>
            <form method='post' name='loginform' action='" . $_SERVER['PHP_SELF'] ." '>
            <input type='submit' class='closebtn' name='close' value='Dismiss x'></span>
            <p class='h1small' >Movie Edited</p>
            </div>

            </div>";      
        }
        
    }

    if(isset($_POST['close'])){
        header('Location: admin_movie.php');
    }

    if(isset($_POST['back'])){
        header('Location: admin_movie.php');
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
        <title>Edit Movie : Admin</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link rel="shortcut icon" type="image/x-icon" href="res/fav.ico">
    </head>
    
    <body class="login-body">
    
        <div class="divreg" id="div1" align="center">
        
            <form method="post" name="loginform" action="edit_movie.php" enctype="multipart/form-data">
                
                <h1 class="h1small"><span style="font-weight:normal">Edit Movie Info</span></h1>
            
                <br>
                <table class="table-reg">
            
                    <tr>
                        <td>Movie Name</td>
                        <td>
                            <input type="text" name="fname" value="<?php echo $name;?>">
                            <br>
                            <span><?php echo $fnameError;?></span>
                        </td>
                        
                    </tr>
                    
                    <tr>
                        <td>Choose a Movie ID</td>
                        <td>
                            <input type="text" name="username" value="<?php echo $link;?>" disabled>
                            <br>
                            <span><?php echo $unameError;?></span>
                        </td>
                    </tr>
                                
                    <tr>
                        <td>Description</td>
                        <td>
                            <TEXTAREA NAME="address" ROWS=2 ><?php echo $desc;?></TEXTAREA>
                            <br>
                            <span><?php echo $addrError;?></span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Rating (out of 100)</td>
                        <td>
                            <input type="number" name="rating" value="<?php echo $rate;?>">
                            <br>
                        </td>
                        
                    </tr>
                    
                    <tr>
                        <td>Price in ₹</td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price;?>">
                            <br>
                        </td>
                        
                    </tr>
                               
                </table>
                <br><br>
                <input type="submit" name="edit" value="Save Changes"><br><br>
                <!--<input type="submit" name="passchange" value="Change Password"><br><br><br>-->
                <input type="submit" name="back" value="Go Back">
              
            </form>
        
        </div>

    </body>

</html>