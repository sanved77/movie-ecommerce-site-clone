<?php
    session_start();
    include 'admin_header.php';
	// Initialize variables to null.
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
	if(isset($_POST['add'])){
        $doIt = true;
        
        /* First Name */
		if (empty($_POST["fname"])) {
			$fnameError = "First Name is required";
            $doIt = false;
        }
        /* movie id */
        if (empty($_POST["username"])) {
			$unameError = "Username is required";
            $doIt = false;
        } else {
			$name = test_input($_POST["username"]);
			// check name only contains letters and whitespace
			if (!preg_match("/[A-Za-z0-9]+/",$name)) {
				$unameError = "Only letters and numbers allowed";
                $doIt = false;
            }
		}

        /* Address */
        if (empty($_POST["address"])) {
			$addrError = "Address is required";
            $doIt = false;
        } else {
			$name = test_input($_POST["address"]);
		}
        
        if (!is_uploaded_file($_FILES['avatar']['tmp_name'])) {
            $avatarError = "Please upload an image file";
            $doIt = false;
        }else{
            $target_dir = "res/movies/";
            $target_file = $target_dir . $_POST['username'] . ".jpg";
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

            $check = getimagesize($_FILES["avatar"]["tmp_name"]);
            if($check !== false) {
                $avatarError = "File is an image - " . $check['mime'] . ".";
                $uploadOk = 1;
            } else {
                $avatarError = "File is not an image.";
                $uploadOk = 0;
            }
            
            if($uploadOk == 0){
                $doIt = false;
                $avatarError = "There is something wrong with the image";
            }
        }
        
        if($doIt){
            
            /*
            Uploading image.
            */
            
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                $avatarError = "Image Uploaded.";
            } else {
                $avatarError = "Sorry, there was an error uploading your file.";
            }
            
            /*
            Database connectivity and registration of the new user
            */
    
            $con = new MongoClient();
            $collection = $con->social->moviesdb;
            
            $data = array('name' => $_POST['fname'], 
                          'link' => $_POST['username'] . ".jpg", 
                          'desc' => $_POST['address'],
                          'rate' => $_POST['rating'],
                          'price' => $_POST['price']
                         );
            
            $ret = $collection->insert($data);
            
            echo "
            <div id='myModal' class='modal'>
            <div class='modal-content'>
            <span class='close'>
            <form method='post' name='loginform' action='" . $_SERVER['PHP_SELF'] ." '>
            <input type='submit' class='closebtn' name='close' value='Dismiss x'></span>
            <p class='h1small' >Movie Added to the Database</p>
            </div>

            </div>";      
        }
        
	}

    if(isset($_POST['close'])){
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
        <title>Add Movie</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <link rel="shortcut icon" type="image/x-icon" href="res/fav.ico">
    </head>
    
    <body class="login-body">
    
        <div class="divreg" id="div1" align="center">
        
            <form method="post" name="loginform" action="add_movie.php" enctype="multipart/form-data">
                
                <h1 class="h1small"><span style="font-weight:normal">Register to have fun at MovieDB</span></h1>
            
                <br>
                <table class="table-reg">
            
                    <tr>
                        <td>Movie Name</td>
                        <td>
                            <input type="text" name="fname">
                            <br>
                            <span><?php echo $fnameError;?></span>
                        </td>
                        
                    </tr>
                    
                    <tr>
                        <td>Choose a Movie ID</td>
                        <td>
                            <input type="text" name="username">
                            <br>
                            <span><?php echo $unameError;?></span>
                        </td>
                    </tr>
                   
                   <tr>
                        <td>Select Poster</td>
                        <td>
                            <input type="file" name="avatar" id="avatar" accept="image/*">
                            <br>
                            <span><?php echo $avatarError;?></span>
                        </td>
                    </tr>
                                
                    <tr>
                        <td>Description</td>
                        <td>
                            <TEXTAREA NAME="address" ROWS=2 ></TEXTAREA>
                            <br>
                            <span><?php echo $addrError;?></span>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Rating (out of 100)</td>
                        <td>
                            <input type="number" name="rating" value="85">
                            <br>
                        </td>
                        
                    </tr>
                    
                    <tr>
                        <td>Price in ₹</td>
                        <td>
                            <input type="number" name="price" value="499">
                            <br>
                        </td>
                        
                    </tr>
                               
                </table>
                <br><br>
                <input type="submit" name="add" value="Add Movie">
              
            </form>
        
        </div>

    </body>

</html>