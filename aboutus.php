<?php
   session_start();
    require_once('database.php');
    include('function.php');
     ?>
<html>
	<head>
    <link rel="stylesheet" href="css/uikit.min.css">
    <link rel="stylesheet" href="css/slide.css">
    <link rel="shortcut icon" href="asd_images/viewbox.png">
 	</head>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <body style="background-image: url(asd_images/background2.jpeg);">
<body>
 <!--NAVBAR-->
        <div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar">
            <nav class="uk-navbar-container" uk-navbar style="position: relative; z-index: 980;background-color:black; color:white; height:50px">
                <div class="uk-navbar-left">
                    <div class="uk-padding"></div>
                    <ul class="uk-navbar-nav uk-subnav-divider">
                        <li><a href="home.php"><span uk-icon = "icon: home"></span>Home</a></li>
                        <?php 
                            if(!isset($_SESSION['name'])) {

                                echo '<li><a href="login.php"><span uk-icon = "icon: sign-in"></span>Reserve</a></li>';
                                echo '<li><a href="create_from_home.php"><span uk-icon = "icon: pull"></span>Register</a></li>';
                            }
                        ?>
                        <li><a href="#cinema" uk-scroll><span uk-icon = "icon: image"></span>Cinema</a></li>
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
        

        <!--NAVBAR-->

 <div class="uk-padding" id="about">
             
                <div class="uk-card uk-card-secondary uk-card-body" style="margin-left: 180px;width:950px;height:550px">

                    <div class="uk-flex uk-flex-center">
                        <div class="uk-margin">
                            <h2>About us</h2>

                            <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ViewBox is a reservation site wherein people can reserve seats for their desires movies </p>
                            <p style="text-align:justify;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp We strive to improve every day to ensure our customers have the best time and leave with fond memories only to return for more exciting cinematic experience.
							We have a dedicated team behind these screens who are committed to make you smile! We refurbished some of our flagship locations to give it a fresh look,
							mainly to adopt a more welcoming, vibrant, contemporary ambiance. Some of the cinema halls were redesigned and renovated to maximise the space.
                                <p>
                            <div class="uk-column-1-2 uk-column-divider">
                                <h2>Where are we located?</h2>
                                <p>We are located at Nidea st. Barrio Obrerro Davao City</p>

                                 <br>
                                <h2 style="margin-top:75px">Contact Details</h2>
                                <p style="margin-top:0px;margin-bottom:0px"><a class="uk-icon-button" uk-icon="icon: facebook"></a>&nbsp&nbsp&nbsp&nbsp&nbsp ViewBox@yahoo.com</p>
                                <p style="margin-top:0px;margin-bottom:0px"><a class="uk-icon-button" uk-icon="icon: google"></a>&nbsp&nbsp&nbsp&nbsp&nbsp ViewBox@gmail.com</p>
                                <p style="margin-top:0px;margin-bottom:0px"><span class="uk-icon-button" uk-icon="icon: location"></span>&nbsp&nbsp&nbsp&nbsp&nbsp Nidea st. Barrio Obrerro Davao City</p>
                                <p style="margin-top:0px;margin-bottom:0px"><span class="uk-icon-button" uk-icon="icon: phone"></span>&nbsp&nbsp&nbsp&nbsp&nbsp 09300635711</p>
                                <p style="margin-top:0px;margin-bottom:0px"><span class="uk-icon-button" uk-icon="icon: whatsapp"></span>&nbsp&nbsp&nbsp&nbsp&nbsp 220-3132</p>
                            </div>        
                        </div>
                    </div>
                </div>
            </div>
        

</body>

</html>