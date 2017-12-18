   <?php
    session_start();
    require_once('database.php');
    include('function.php');

    $name ="";
    ?>
    
    <html>

   <head>
        <link rel="stylesheet" href="css/uikit.min.css">
        <link rel="stylesheet" href="css/slide.css">
        <link rel="shortcut icon" href="asd_images/viewbox.png">
        <title>View Box</title>

    </head>
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>


    <body style="background-image: url(asd_images/background3.jpg); ">
        <!--NAVBAR-->
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
                        <li><a href="#cinema" uk-scroll><span uk-icon = "icon: image"></span>Cinema</a></li>
                        <li><a href="aboutus.php"><span uk-icon = "icon: user"></span>About Us</a></li>
                        <?php 
                        if(isset($_SESSION['name'])){
                            if($_SESSION['name'] == 'admin'){
                                echo '<li><a href="admin.php"><span uk-icon = "icon: lock"></span>Admin Page</a></li>';
                            }
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
                                echo '<a href="viewbook.php';
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
        <!-- SLIDESHOW-->

     <center>
     
            <div class="uk-position-relative uk-visible-toggle uk-light " uk-slideshow=" autoplay: true" style="height:550px;width:950px;">
              <div>
                <ul class="uk-slideshow-items autoplay: true">
                <li>
                    <image >
                    <img src="asd_images/pic8.jpg" alt="asdasd" uk-cover>
                    </image>
                </li>
                <li>
                    <image >
                    <img src="asd_images/pic7.jpg" alt="asdasd" uk-cover>
                    </image>
                </li>
                <li>
                    <image >
                    <img src="asd_images/pic4.jpg" alt="asdasd" uk-cover>
                    </image>
                </li>
                <li>
                    <image >
                    <img src="asd_images/pic5.jpg" alt="asdasd" uk-cover>
                    </image>
                </li>
                </ul>

            <a class="uk-slidenav-large uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
            <a class="uk-slidenav-large uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
            </div>
        <ul class="uk-dotnav uk-flex-center uk-margin">
            <li uk-slideshow-item="0"><a href="#">Item 1</a></li>
            <li uk-slideshow-item="1"><a href="#">Item 2</a></li>
            <li uk-slideshow-item="2"><a href="#">Item 3</a></li>
            <li uk-slideshow-item="3"><a href="#">Item 4</a></li>
         </ul>
         </div>
            
         </center>   
                        </br>
                        </br>
                        </br>
                        </br>
        <center>
            <div style="width: 80%">
                <hr class="uk-divider-icon">
            </div>
        </center>
                        </br>
                        </br>

        <center>
        <h1 id="cinema" style="color:white;">Now Showing!</h1>
        
        </center>
        <!--CINEMA-->
        <div class="uk-padding"  style="padding-bottom:0px"></div>
        <div class="uk-child-width-1-3@m uk-grid-match" uk-grid uk-grid uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-card; delay: 500; repeat: true">
                    <div>
                    <div class="uk-card uk-card-hover uk-card-secondary uk-card-body">
                    <h3 class="uk-card-title uk-heading-divider">Cinema 1</h3>  
                        <?php  
                            $sql_cinema = "SELECT * FROM cinemas WHERE slot = '1'";
                            $cin1_res = mysqli_query($connection, $sql_cinema);
                            $row = mysqli_fetch_assoc($cin1_res);
                            $name = $row['movie_name'];
                            $sql_movie = "SELECT * FROM movies WHERE name = '$name'";
                            $mov1_res = mysqli_query($connection, $sql_movie);
                            $data = mysqli_fetch_assoc($mov1_res);
                            echo '<center>';
                                echo '<div class="uk-width-1-2">';
                                    echo '<img src="data:image/jpeg;base64,'.base64_encode($data['image']).'">';
                                echo '</div>';
                                echo '<h2 style="margin-bottom: 0px; margin-top: 15px;">' . $name . '</h2>';
                                
                                echo '<a href="book_cinema1.php" class="uk-button uk-button-default">Book</a>';
                            echo '</center>';
                        ?>
                    </div>
                    </div>

                    <div>
                    <div class="uk-card uk-card-hover uk-card-secondary uk-card-body">
                        <h3 class="uk-card-title uk-heading-divider">Cinema 2</h3>
                        <?php  

                            $sql_cinema = "SELECT * FROM cinemas WHERE slot = '2'";
                            $cin2_res = mysqli_query($connection, $sql_cinema);
                            $row = mysqli_fetch_assoc($cin2_res);
                            $name = $row['movie_name'];
                            $sql_movie = "SELECT * FROM movies WHERE name = '$name'";
                            $mov2_res = mysqli_query($connection, $sql_movie);
                          $data = mysqli_fetch_assoc($mov2_res);
                            echo '<center>';
                                echo '<div class="uk-width-1-2">';
                                    echo '<img src="data:image/jpeg;base64,'.base64_encode($data['image']).'">';
                                echo '</div>';
                                echo '<h2 style="margin-bottom: 0px; margin-top: 15px;">' . $name . '</h2>';
                              
                                echo '<a href="book_cinema2.php" class="uk-button uk-button-default">Book</a>';
                            echo '</center>';
                        ?>
                    </div>
                    </div>
                

                    <div>
                    <div class="uk-card uk-card-hover uk-card-secondary uk-card-body">
                        <h3 class="uk-card-title uk-heading-divider">Cinema 3</h3>
                       <?php  

                            $sql_cinema = "SELECT * FROM cinemas WHERE slot = '3'";
                            $cin3_res = mysqli_query($connection, $sql_cinema);
                            $row = mysqli_fetch_assoc($cin3_res);
                            $name = $row['movie_name'];
                            $sql_movie = "SELECT * FROM movies WHERE name = '$name'";
                            $mov3_res = mysqli_query($connection, $sql_movie);
                            $data = mysqli_fetch_assoc($mov3_res);
                            echo '<center>';
                                echo '<div class="uk-width-1-2">';
                                    echo '<img src="data:image/jpeg;base64,'.base64_encode($data['image']).'">';
                                echo '</div>';
                                echo '<h2 style="margin-bottom: 0px; margin-top: 15px;">' . $name . '</h2>';
                               
                                echo '<a href="book_cinema3.php" class="uk-button uk-button-default">Book</a>';
                            echo '</center>';
                        ?>
                    </div>
                    </div>
        </div>

        <!--2nd line of cinema -->
        <div class="uk-child-width-1-3@m uk-grid-match" uk-grid uk-grid uk-scrollspy="cls: uk-animation-fade; target: > div > .uk-card; delay: 500; repeat: true">
                    <div>
                    <div class="uk-card uk-card-hover uk-card-secondary uk-card-body">
                        <h3 class="uk-card-title uk-heading-divider">Cinema 4</h3>
                             <?php  
                            $sql_cinema = "SELECT * FROM cinemas WHERE slot = '4'";
                            $cin4_res = mysqli_query($connection, $sql_cinema);
                            $row = mysqli_fetch_assoc($cin4_res);
                            $name = $row['movie_name'];
                            $sql_movie = "SELECT * FROM movies WHERE name = '$name'";
                            $mov4_res = mysqli_query($connection, $sql_movie);
                            $data = mysqli_fetch_assoc($mov4_res);
                            echo '<center>';
                                echo '<div class="uk-width-1-2">';
                                    echo '<img src="data:image/jpeg;base64,'.base64_encode($data['image']).'">';
                                echo '</div>';
                                echo '<h2 style="margin-bottom: 0px; margin-top: 15px;">' . $name . '</h2>';
                               
                                echo '<a href="book_cinema4.php" class="uk-button uk-button-default">Book</a>';
                            echo '</center>';
                        ?>
                    </div>
                    </div>
                    <div>
                    <div class="uk-card uk-card-hover uk-card-secondary uk-card-body">
                        <h3 class="uk-card-title uk-heading-divider">Cinema 5</h3>
                           <?php  
                            $sql_cinema = "SELECT * FROM cinemas WHERE slot = '5'";
                            $cin5_res = mysqli_query($connection, $sql_cinema);
                            $row = mysqli_fetch_assoc($cin5_res);
                            $name = $row['movie_name'];
                            $sql_movie = "SELECT * FROM movies WHERE name = '$name'";
                            $mov5_res = mysqli_query($connection, $sql_movie);
                            $data = mysqli_fetch_assoc($mov5_res);
                            echo '<center>';
                                echo '<div class="uk-width-1-2">';
                                    echo '<img src="data:image/jpeg;base64,'.base64_encode($data['image']).'">';
                                echo '</div>';
                                echo '<h2 style="margin-bottom: 0px; margin-top: 15px;">' . $name . '</h2>';
                                
                                echo '<a href="book_cinema5.php" class="uk-button uk-button-default">Book</a>';
                            echo '</center>';
                        ?>
                    </div>
                    </div>
                    <div>
                    <div class="uk-card uk-card-hover uk-card-secondary uk-card-body">
                        <h3 class="uk-card-title uk-heading-divider ">Cinema 6</h3>
                           <?php  
                            $sql_cinema = "SELECT * FROM cinemas WHERE slot = '6'";
                            $cin6_res = mysqli_query($connection, $sql_cinema);
                            $row = mysqli_fetch_assoc($cin6_res);
                            $name = $row['movie_name'];
                            $sql_movie = "SELECT * FROM movies WHERE name = '$name'";
                            $mov6_res = mysqli_query($connection, $sql_movie);
                            $data = mysqli_fetch_assoc($mov6_res);
                            echo '<center>';
                                echo '<div class="uk-width-1-2">';
                                    echo '<img src="data:image/jpeg;base64,'.base64_encode($data['image']).'">';
                                echo '</div>';
                                echo '<h2 style="margin-bottom: 0px; margin-top: 15px;">' . $name . '</h2>';
                              
                                echo '<a href="book_cinema6.php" class="uk-button uk-button-default">Book</a>';
                            echo '</center>';
                        ?>
                    </div>
                    </div>
        </div>
        <!--CINEMA-->
       <ul class="uk-breadcrumb" style="margin-bottom:0px; background-color: black;">
            <li>Copyright © 2017 ViewBox - All Rights Reserved</li>
            <!--<li><a href="tac.php">Terms and Condition</a></li>
            <li><a href="#">Privacy Policy</a></li>-->
        </ul>
    </body>

    </html>
