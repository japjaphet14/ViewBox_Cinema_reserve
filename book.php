<?php
    session_start();
    require_once('database.php');
    include('function.php');
?>
<html>
<head>
	<link rel="stylesheet" href="css/uikit.min.css">

</head>
	<script src="js/uikit.min.js"></script>
	<script src="js/uikit-icons.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="asd_images/viewbox.png">
    <title>View Box</title>
	
	<body style="background-image: url(asd_images/background3.jpg);">


	 <div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar">
            <nav class="uk-navbar-container" uk-navbar style="position: relative; z-index: 980;background-color:black; color:white; height:50px">
                <div class="uk-navbar-left">
                    <div class="uk-padding"></div>
                    <ul class="uk-navbar-nav uk-subnav-divider">
                        <li><a href="home.php"><span uk-icon = "icon: home"></span></a></li>
                        <?php 
                            if(!isset($_SESSION['name'])) {

                                echo '<li><a href="login.php"><span uk-icon = "icon: sign-in"></span>Reserve</a></li>';
                                echo '<li><a href="create_from_home.php"><span uk-icon = "icon: pull"></span>Register</a></li>';
                            }
                        ?>
                        <li><a href="#cinema"><span uk-icon = "icon: image"></span>Cinema</a></li>
                        <li><a href="aboutus.php"><span uk-icon = "icon: user"></span>About Us</a></li>
                        <?php 
                            if($_SESSION['name'] == 'admin'){
                                echo '<li><a href="admin.php"><span uk-icon = "icon: lock"></span>Admin Page</a></li>';
                            }
                        ?>
                        <li style="color:red;"><span uk-icon = "icon: uikit"></span>ViewBox</li>

                    </ul>
                </div>


                <div class="uk-navbar-right">

                    <ul class="uk-navbar-nav">
                    </ul>
                    <div class="uk-padding"></div>
                </div>


                <div class="uk-navbar-right">

                    <ul class="uk-navbar-nav">

                        <?php 
                            if(isset($_SESSION['name'])) {

                                echo '<div class="uk-navbar-item"><div>WELCOME! '; 
                                echo '<a href="';
                                echo '">'; 
                                echo $_SESSION['name'] .'</a></div></div>';
                                echo '<li><a href="logout.php">Logout</a></li>';
                            }
                        ?>
                    </ul>
                    <div class="uk-padding"></div>
                </div>


                 
            </nav>
        </div>
        	<br><br><br>
		 <div class="uk-card uk-card-hover uk-card-default uk-card-body" style="margin-left:350px; margin-right:350px; height:300px;">
			 <center><br>
			 	<h1>Thank you for choosing ViewBox!</h1>
			 	<a href="home.php" class="uk-button uk-button-primary" style="height:40px;width:100px;">Home</a>
			 </center>
		 </div>


</body>
</html>