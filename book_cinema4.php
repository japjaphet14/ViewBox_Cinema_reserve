<?php 
    require_once('database.php');
    include('function.php');
    session_start();
	$name = $_SESSION['name'];
	$username = $_SESSION['name'];
   if (!isset($_SESSION['name']) || empty($_SESSION['name'])){
  header("location: login.php");
  exit;
    }
	$sched_err = $ticket_err = "";
	$sched = $ticket = "";
    $limit = "";
    $holder = "";
    $time_slot = "";
    $sold = "";

	if($_SERVER["REQUEST_METHOD"] == "POST"){

        //to display the available seats

         $sqlcheck = "SELECT * FROM cinema_available WHERE time_slot = '".$_POST['sched']."' AND cinema='4'";
        $resCheck = mysqli_query($connection, $sqlcheck);
        $dataCheck = mysqli_fetch_assoc($resCheck);
        if ($dataCheck['number_of_seats'] < 1) {

            echo '<div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <center>
                    <p style="margin-bottom:0px">NO AVAILABLE SEATS!</p>
                    </center>
                </div>';
        }else if($_POST['ticket'] > $dataCheck['number_of_seats']) {

            echo '<div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <center>
                    <p style="margin-bottom:0px">Insufficient Seats!</p>
                    </center>
                </div>';
        }else {

        $time_slot = $_POST['sched'];
        $cin = $_POST['ticket'];

        $sql1 = "SELECT * FROM cinema_available WHERE cinema ='4' and time_slot = '$time_slot'";
        $res1 = mysqli_query($connection, $sql1);
        
        while($row2 = mysqli_fetch_assoc($res1)) { 
          
          $limit = $row2['number_of_seats'];  
        }
        $limit -= $cin;

        $sqladd = "UPDATE cinema_available SET number_of_seats = '$limit' WHERE cinema ='4' and time_slot = '$time_slot'";
        $resadd = mysqli_query($connection, $sqladd);




		// Validate Schedule
		$input_sched = trim($_POST["sched"]);
		if($input_sched == '0'){
				$sched_err = '<p style="color:red; margin-bottom:-20px;">Please Select Schedule.</p>';
		} else{
				$sched = ($input_sched);
		}
		// Validate Tickers
		$input_ticket = trim($_POST["ticket"]);
		if(empty($input_ticket)){
				$ticket_err = '<p style="color:red;margin-bottom:-20px;">Please Input Number of Tickets.</p>';
		} else{
				$ticket = ($input_ticket);
		}
		if(empty($ticket_err) && empty($sched_err)){
			$sqlhis = "SELECT * FROM user_info WHERE username ='" . $username . "'";
                $his_res = mysqli_query($connection, $sqlhis);
				$row_his = mysqli_fetch_assoc($his_res);
				$sqlhis2 = "INSERT INTO user_history (username, cinema, sched, ticket) values('{$username}', '{$row_his['cinema']}', '{$row_his['sched']}', '{$row_his['ticket']}')";
				mysqli_query($connection, $sqlhis2);
			$sql = "UPDATE user_info SET cinema=?, sched=?, ticket=? WHERE username=?";
			if($stmt = mysqli_prepare($connection, $sql)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "iiis", $param_cinema, $param_sched, $param_ticket, $param_name);
				// Set parameters
				$param_sched = $sched;
				$param_ticket = $ticket;
				$param_name = $name;
				$param_cinema =4;
				//$param_name = $name;
				// Attempt to execute the prepared statement
				 if(mysqli_stmt_execute($stmt)){
					// Records updated successfully. Redirect to landing page
					header("location: book.php");
					exit();
				} else{
					echo "Something went wrong. Please try again later.";
				} 
					
			}
			// Close statement
			mysqli_stmt_close($stmt);
		  }
        }
	}
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


	<!--navbar -->
 <div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar">
            <nav class="uk-navbar-container" uk-navbar style="position: relative; z-index: 980;background-color:black; color:white; height:50px">
                <div class="uk-navbar-left">
                    <div class="uk-padding"></div>
                    <ul class="uk-navbar-nav uk-subnav-divider">

                         <li><a href="home.php"><span uk-icon = "icon: home"></span>Home</a></li>
                        <li><a href="#cinema"><span uk-icon = "icon: image"></span>Cinema</a></li>
                        <li><a href="aboutus.php"><span uk-icon = "icon: user"></span>About Us</a></li>
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
        <br><br>

        <center>   
             <div class="uk-card uk-card-secondary ">
                    <h1 class="uk-card-title">Cinema 4 Reservation</h1>
                </center>
            </div>
    <div class="uk-card uk-card-secondary uk-grid-collapse uk-child-width-1-2@s uk-margin" style=" margin-left:50px; margin-right:50px; margin-top:0px; margin-bottom:0px"uk-grid>
                <div class="uk-card-media-left uk-cover-container">
        
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
                                                     
                            echo '</center>';
                        ?>
                    </div>
              
              <div>
                 <div class="uk-card-body">

                         <?php  
                         $sql_cinema = "SELECT * FROM movies WHERE name = '$name'";
                           $cin4_res = mysqli_query($connection, $sql_cinema);
                            $row = mysqli_fetch_assoc($cin4_res);
                             $description = $row['description'];

                            echo '<center>';
                            echo '<h2 style="margin-bottom: 0px; margin-top: 15px;">' . $name . '</h2>';                     
                            echo '</center>';
                            echo '<p style="margin-bottom: 0px; margin-top: 15px; text-align: justify;">' . $description . '</p>'; 
                        ?>
                    
                </div>
                 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <label>Time Schedule</label>&nbsp;&nbsp;
							<select name="sched" id="meetingPlace">
								<option value="0">Select Time</option>
								<option value="1">10:00AM-12:30PM</option>
								<option value="2">12:30PM-3:00PM</option>
								<option value="3">3:00PM-5:30PM</option>
								<option value="4">5:30PM-8:00PM</option>
								<option value="5">8:00PM-10:30PM</option>
							</select>
							<span class="help-block"><?php echo $sched_err;?></span><br>
							 <label>Number of Tickets</label>
							<input type="text" name="ticket" style="width:50px" class="form-control">
							<span class="help-block"><?php echo $ticket_err;?></span>
                            <div id="results"></div>
                            <?php 
                                $numSeats = array();
                                $sqlg = "SELECT * FROM cinema_available WHERE cinema ='4'";
                                $resg = mysqli_query($connection, $sqlg);
                                $x = 0;
                                while($rowg = mysqli_fetch_assoc($resg)) { 
                                  
                                  $numSeats[$x] = $rowg['number_of_seats']; 
                                  $x++;
                                }
                            ?>
                            <script>
                                $("#meetingPlace").on("change", function(){
                                  
                                    var selected = $(this).val();
                                    var seats;
                                    if(selected == 1) {

                                        seats = <?php echo json_encode($numSeats[0]); ?>;
                                    }else if(selected == 2) {

                                        seats = <?php echo json_encode($numSeats[1]); ?>;
                                    }else if(selected == 3) {

                                        seats = <?php echo json_encode($numSeats[2]); ?>;
                                    }else if(selected == 4) {

                                        seats = <?php echo json_encode($numSeats[3]); ?>;
                                    }else if(selected == 5) {

                                        seats = <?php echo json_encode($numSeats[4]); ?>;
                                    }
                                    if(seats < 1) {

                                        $("#results").html("No Tickets are available!");
                                    }else {

                                        $("#results").html("Number of Seats: " + seats);
                                    }
                                })
                            </script>

                        
                    <input type="checkbox" name="formDoor[]" required ><a href="tac.php"> I have read the terms and condition</a><br />
                    <input type="checkbox" name="formDoor[]" required >I agree that 30 minutes before the showing, I must settle my reservation.<br />
                        
                         <center>
                         <br>
                    <input type="submit" class="uk-button uk-button-default" value="Book">
                         </center>
                    </form>
            </div>
    </div>

</body>
</html>