<?php
    session_start();
    require_once('database.php');
    include('function.php');
    	$user = "";
    	$cinema = "";
    	$sched = "";
    ?>


    <html>
    <head>
        <link rel="shortcut icon" href="asd_images/viewbox.png">
        <title>View Box</title>
        <meta charset="utf-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/uikit.min.css" rel="stylesheet">
         <script src="js/uikit-icons.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/uikit.min.js"></script>
    </head>
    <body style="background-image: url(asd_images/background2.jpeg);"> 

<div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar">
            <nav class="uk-navbar-container" uk-navbar style="position: relative; z-index: 980;background-color:black; color:white; height:50px">
                <div class="uk-navbar-left">
                    <div class="uk-padding"></div>
                    <ul class="uk-navbar-nav uk-subnav-divider">
                        <li><a href="home.php"><span uk-icon = "icon: home"></span> Home</a></li>
                        <li><a href="#cinema" uk-scroll><span uk-icon = "icon: image"></span>Cinema</a></li>
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
        
        	<center>
        <!--NAVBAR-->
        <div class="uk-card uk-card-secondary uk-card-body" style="width:950px;height:550px">

        	<table class="uk-table uk-table-hover">
        		<thead style="background-color:black;">
		        <tr>
		            <th>Username</th>
		            <th>Email</th>
		            <th>First Name</th>
		            <th>Last Name</th>
		            <th>Phone Number</th>
					<th>Cinema</th>
					<th>Schedule</th>
					<th>Tickets</th>
		        
		        </tr>
		    </thead>
		    <tbody>

        <?php
        		$sql = "SELECT * FROM user_info";
		        	$res = mysqli_query($connection, $sql);
		        	while($row = mysqli_fetch_assoc($res)) {
		        		
		        		if($row['username'] == $_SESSION['name'] ){
		        		if($row['sched'] == 1){
						$sched = '10:00AM-12:30PM';		
					}else if($row['sched'] == 2){
						$sched = '12:30PM-3:00PM';
					}else if($row['sched'] == 3){
						$sched = '3:00PM-5:30PM';
					}else if($row['sched'] == 4){
						$sched = '5:30PM-8:00PM';
					}else if($row['sched'] == 5){
						$sched = '8:00PM-10:30PM';
					}else if ($row['sched'] == 0 ){
						$sched = 'Not yet book';
					}
					if($row['cinema'] == 1){
						$cinema = 'Cinema 1';		
					}else if($row['cinema'] == 2){
						$cinema = 'Cinema 2';
					}else if($row['cinema'] == 3){
						$cinema = 'Cinema 3';
					}else if($row['cinema'] == 4){
						$cinema = 'Cinema 4';
					}else if($row['cinema'] == 5){
						$cinema = 'Cinema 5';
					}else if($row['cinema'] == 6){
						$cinema = 'Cinema 6';
					}else if ($row['cinema'] == 0 ){
						$cinema = 'Not yet book';
					}
									
					echo '<tr>';
		        		echo '<th>'. $row['username'] .'</th>';
		        		echo '<th>'. $row['email'] .'</th>';
		        		echo '<th>'. $row['fName'] .'</th>';
		        		echo '<th>'. $row['lName'] .'</th>';
		        		echo '<th>'. $row['phoneNumber'] .'</th>';
						echo '<th>'. $cinema .'</th>';
						echo '<th>'. $sched .'</th>';
						echo '<th>'. $row['ticket'] .'</th>';			        		
		        	echo '</tr>';
					
					$sql2 = "SELECT * FROM user_history order by created_at DESC";
		        	$res2 = mysqli_query($connection, $sql2);
		        	while($row2 = mysqli_fetch_assoc($res2)) {	        		
		        	if($row2['username'] == $_SESSION['name'] ){
		        		if($row2['sched'] == 1){
						$sched2 = '10:00AM-12:30PM';		
					}else if($row2['sched'] == 2){
						$sched2 = '12:30PM-3:00PM';
					}else if($row2['sched'] == 3){
						$sched2 = '3:00PM-5:30PM';
					}else if($row2['sched'] == 4){
						$sched2 = '5:30PM-8:00PM';
					}else if($row2['sched'] == 5){
						$sched2 = '8:00PM-10:30PM';
					}else if ($row2['sched'] == 0 ){
						$sched2 = 'Not yet book';
					}
					if($row2['cinema'] == 1){
						$cinema2 = 'Cinema 1';		
					}else if($row2['cinema'] == 2){
						$cinema2 = 'Cinema 2';
					}else if($row2['cinema'] == 3){
						$cinema2 = 'Cinema 3';
					}else if($row2['cinema'] == 4){
						$cinema2 = 'Cinema 4';
					}else if($row2['cinema'] == 5){
						$cinema2 = 'Cinema 5';
					}else if($row2['cinema'] == 6){
						$cinema2 = 'Cinema 6';
					}else if ($row2['cinema'] == 0 ){
						$cinema2 = 'Not yet book';
					}
					
					echo '<tr>';
						echo '<th>'. $row['username'] .'</th>';
		        		echo '<th>'. $row['email'] .'</th>';
		        		echo '<th>'. $row['fName'] .'</th>';
		        		echo '<th>'. $row['lName'] .'</th>';
		        		echo '<th>'. $row['phoneNumber'] .'</th>';
						echo '<th>'. $cinema2 .'</th>';
						echo '<th>'. $sched2 .'</th>';
						echo '<th>'. $row2['ticket'] .'</th>';			        		
		        	echo '</tr>';
					
						}}
					
		        		}
		        	}
		   ?>  

			</tbody>

		</table>

			<br><br><br><br><br><br><br><br><br><br><br><br><br>
			<p>NOTE: Please settle your payment 30 minutes before the schedule or it will be void.</p>
			<p> Thank you for choosing ViewBox! </p>
		</div>
		</center>



    </body>
    </html>