<?php
    include 'function.php';
    require 'database.php'; 
    $errors = array();
	$com = "";

     $username_err  = $mobile_err = $lname_err = $fname_err = $password_err = $email_err = "";
    if (isset($_POST['register_btn'])){
         // keep track post values
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $mobile = $_POST['mobile'];
		

                //checks if empty 
                  if(empty(trim($_POST["username"]))){
                        $username_err = 'Please enter username.';

                    } else{
                        $username = trim($_POST["username"]);
                    }
                  if(empty(trim($_POST["password"]))){
                        $password_err = 'Please enter password.';
                    } else{
                        $password = trim($_POST["password"]);
                    }
                  if(empty(trim($_POST["email"]))){
                        $email_err = 'Please enter email.';
                    } else{
                        $email = trim($_POST["email"]);
                    }
                  if(empty(trim($_POST["fName"]))){
                        $fname_err = 'Please enter first name.';
                    } else{
                        $fName = trim($_POST["fName"]);
                    }
                  if(empty(trim($_POST["lName"]))){
                        $lname_err = 'Please enter lName.';
                    } else{
                        $lName = trim($_POST["lName"]);
                    }  
                  if(empty(trim($_POST["mobile"]))){
                        $mobile_err = 'Please enter mobile.';
                    } else{
                        $mobile = trim($_POST["mobile"]);
                    }                                                                                                   
                    //if same username or email
		$sql3 = "SELECT * FROM user_info";
		if($result3 = mysqli_query($connection, $sql3)){
			if(mysqli_num_rows($result3) > 0){
				while($row3 = mysqli_fetch_array($result3)){
					if($username===$row3['username']){
						$com = 1;
						break;
					}
					else{
						$com = 0;
					}
					if($email===$row3['email']){
						$com = 2;
						break;
					}
					else{
						$com = 0;
					}
				}
			}
		}		
        $hash = md5($password); 
        if (empty($username_err || $mobile_err || $lname_err || $fname_err || $password_err || $email_err)) {
			if($com === 1){
                echo '<center><br>';
				echo '<p style="background-color:red; color:white; width:150px;">Username Already Exist!</p>';
                echo '</center>';
			}else if($com === 2){
                echo '<center><br><br>';
				echo '<p style="background-color:red; color:white; width:150px;">Email Already Exist!</p>';
                echo '</center>';
                // insert data
			}else{
            $sql = "INSERT INTO user_info (username, password, email, fName, lName, phoneNumber, cinema, sched, ticket, privilege) values('{$username}', '{$password}', '{$email}', '{$fName}', '{$lName}', '{$mobile}', '0', '0', '0', 'normal')";
            $result = mysqli_query($connection, $sql);
            mysqli_close($connection);
            header("Location: home.php");
        }
	}
	}
?>
<html>
    <head>
        <link rel="shortcut icon" href="asd_images/viewbox.png">
        <title>View Box</title>
        <meta charset="utf-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/uikit.min.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
        <script src="js/uikit.min.js"></script>
    </head>
    <body style="background-image: url(asd_images/background2.jpeg);">      
        <div class="uk-position-center uk-card uk-card-secondary uk-card-large uk-card-body">
            <div class="uk-flex uk-flex-center">

            </div>
            <div class="uk-flex uk-flex-center">         
                <h3 class="uk-heading-divider" style="padding: 0 30px 10px 30px">Register</h3>
            </div>
            <form class="uk-form-horizontal" action="create_from_home.php" method="post">
                <div class="uk-column-1-2">
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label class="control-label" style="margin-top : 0px">Username</label>
                        <div class="controls">
                            <input class="form-control" name="username" type="text" placeholder="username" value="<?php echo !empty($username_err)?$username:'';?>">
                            <span class="help-block"><?php echo $username_err; ?></span>
                        </div>
                    </div>
                    <div class="form-group  <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input class="form-control" name="email" type="email" placeholder="email address" value="<?php echo !empty($email_err)?$email:'';?>">
                             <span class="help-block"><?php echo $email_err; ?></span>
                        </div>
                    </div>
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label class="control-label">Password</label>
                        <div class="controls">
                            <input class="form-control" name="password" type="password" placeholder="password" value="<?php echo !empty($password_err)?$password:'';?>">
                            <span class="help-block"><?php echo $password_err; ?></span>
                        </div>
                    </div>
                    <div class="form-group <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
                        <label class="control-label">First Name</label>
                        <div class="controls">
                            <input class="form-control" name="fName" type="text" placeholder="first name" value="<?php echo !empty($fname_err)?$fName:'';?>">
                            <span class="help-block"><?php echo $fname_err; ?></span>
                        </div>
                    </div>
                    <div class="form-group <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?>">
                        <label class="control-label">Last Name</label>
                        <div class="controls">
                            <input class="form-control" name="lName" type="text" placeholder="last name" value="<?php echo !empty($lname_err)?$lName:'';?>">
                            <span class="help-block"><?php echo $lname_err; ?></span>
                        </div>
                    </div>
                    <div class="form-group <?php echo (!empty($mobile_err)) ? 'has-error' : ''; ?>">
                        <label class="control-label">Mobile Number</label>
                        <div class="controls">
                            <input class="form-control" name="mobile" pattern="^[0-9]{6}|[0-9]{8}|[0-9]{11}$" / type="tel" placeholder="Mobile Number" value="<?php echo !empty($mobile_err)?$mobile:'';?>">
                            <span class="help-block"><?php echo $mobile_err; ?></span>
                        </div>
                    </div> 
                </div>
                <div class="uk-flex uk-flex-center">
                    <div class="form-actions">
                        <input name="register_btn" type="submit" class="uk-button uk-button-primary" value="Create">
                        <a class="uk-button uk-button-submit" href="home.php">Back</a>
                    </div>
                </div>

            </form>

        </div>

        <!-- /container -->
    </body>

    </html>
