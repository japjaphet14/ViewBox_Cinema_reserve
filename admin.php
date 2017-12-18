<?php
    session_start();
    require_once('database.php');
    include('function.php');
    confirm_logged_in_admin();
	$sched ="";
    $errors = array();
    $number_of_seats = "";
    $time_slot = "";
    $time = "";
        if(isset($_POST['add_btn'])) {
    	print_r($_POST);
    	$movie_name = $_POST['movie_name'];
    	$description = $_POST['description'];
    	$image_name = $_POST['image_name'];
    	if(!has_presence($image_name)) {
            
            $errors[$image_name] = "Please Select Image";
        }else {
            
            $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        }

        $add_sql = "INSERT INTO movies(name, description, image) values('$movie_name', '$description', '$image')";
        mysqli_query($connection, $add_sql);

    }

    if(isset($_POST['delete_movie'])) {

    	$movie_id = $_POST['movie_id'];
    	$del_sql = "DELETE FROM movies where id ='$movie_id'";
    	mysqli_query($connection, $del_sql);
    }

    if(isset($_POST['delete_user'])) {

    	$user_id = $_POST['user_id'];
    	$del_sql = "DELETE FROM user_info where user_ID ='$user_id'";
    	mysqli_query($connection, $del_sql);
    }

    if(isset($_POST['select_btn'])) {

    	$position = $_POST['pos']+1;
        $movies = $_POST['movies'];

        $sql_cinema = "UPDATE cinemas SET movie_name = '$movies' WHERE slot = '$position'";
        mysqli_query($connection, $sql_cinema);
    }



?>
<html>
	<head>
		<link rel="stylesheet" href ="css/uikit.min.css">
		<script src="js/uikit.min.js"></script>
        <link rel="shortcut icon" href="asd_images/viewbox.png">
        <title>View Box</title>

	</head>
	<body style="background-image: url(asd_images/admin.jpg); ">
		<div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar">
    <nav class="uk-navbar-container" uk-navbar="dropbar: true;" style="position: relative; z-index: 980; background-color: white;">
        <div class="uk-navbar-left">

            <ul class="uk-navbar-nav" >
                <li><a href="home.php"><button class="uk-button uk-button-text">Home</button></a></li>
                <li><a href="#user" uk-scroll><button class="uk-button uk-button-text ">Client</button></a></li>
                <li><a href="#movie" uk-scroll><button class="uk-button uk-button-text ">Add Movie</button></a></li>
                <li><a href="#available " uk-scroll><button class="uk-button uk-button-text ">Available Movies</button></a></li>
                <li><a href="#cinema" uk-scroll><button class="uk-button uk-button-text ">Cinema</button></a></li>
                <li><a href="#slots" uk-scroll><button class="uk-button uk-button-text ">Update Slots</button></a></li>

            </ul>

        </div>
        <div class="uk-navbar-right">
         <ul class="uk-navbar-nav">
                <li><a href="logout.php">Logout</a></li>
                </ul>
    </nav>
    </div>
 
    <!-- USER MANAGEMENT  -->
    <div id="user">
       <br>
    <br>
    <br>
    <br>
    <center>
  
    <div class="uk-card uk-card-secondary" style="width:80%">
    <h1>Client Management</h1>
	    <table class="uk-table uk-table-hover">

		    <thead style="background-color:black;">
		        <tr>
		            <th>Username</th>
		            <th>Email</th>
		            <th>Password</th>
		            <th>First Name</th>
		            <th>Last Name</th>
		            <th>Phone Number</th>
					<th>Cinema</th>
					<th>Schedule</th>
					<th>Tickets</th>
		            <th>Action</th>
		        </tr>
		    </thead>
		    <tbody>
		        <?php
		        	$sql = "SELECT * FROM user_info";
		        	$res = mysqli_query($connection, $sql);
		        	while($row = mysqli_fetch_assoc($res)) {
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
		        		echo '<th>'. $row['password'] .'</th>';
		        		echo '<th>'. $row['fName'] .'</th>';
		        		echo '<th>'. $row['lName'] .'</th>';
		        		echo '<th>'. $row['phoneNumber'] .'</th>';
						echo '<th>'. $cinema .'</th>';
						echo '<th>'. $sched .'</th>';
						echo '<th>'. $row['ticket'] .'</th>';
		        		echo '<th style="padding-top:7px; padding-bottom:7px;">';
		        		echo '<form method="post">';
		        		echo '<input type="hidden" name="user_id" value="'. $row['user_ID'] .'">';
		        		echo '<input type="submit" name="delete_user" class="uk-button uk-button-danger" value="Delete">';
		        		echo '</form>';
		        		echo '</th>';
		        		echo '</tr>';
		        	}
		        ?>
		    </tbody>
		</table>
		</div>
		</center>
    </div>
	        </br>
	        </br>
	        <center>
	            <div style="width: 80%">
	                <hr class="uk-divider-icon">
	            </div>
	        </center>
	        


	<!-- MOVIE MANAGEMENT  -->
	 <div id="movie">
	 		</br>
	        </br>
	        	    </br>
	    </br>
    <center>
    
    	<div class="uk-card uk-card-secondary uk-card-large uk-card-body" style="width:80%;">
    	<h1>Movie Management</h1>
            <form class="uk-form-horizontal uk-margin-large"  method="post" enctype="multipart/form-data">

			    <div class="uk-margin">
			        <label class="uk-form-label" for="form-horizontal-text">Movie Name</label>
			        <div class="uk-form-controls">
			            <input class="uk-input" id="form-horizontal-text" type="text" name="movie_name" placeholder="movie name">
			        </div>
			    </div>
			    <div class="uk-margin" uk-margin>
			        <div uk-form-custom="target: true">
			        <label class="uk-form-label" for="form-horizontal-text">Select Movie Image</label>
			            <input type="file" name="image" id="image">
			            <input class="uk-input uk-form-width-medium" type="text" name="image_name" placeholder="Select file">
			        </div>
			    </div>
			    <div class="uk-margin" uk-margin>
				    <label class="uk-form-label">Movie Description</label>
				    <textarea class="uk-textarea" rows="8" placeholder="Textarea" name="description"></textarea>
				    <input name="add_btn" type="submit" class="uk-button uk-button-default" value="Add Movie">
			    </div>
			</form>
        </div>
    <br>
    <div id="available">
    <br>
	<br>
			<center>
	            <div style="width: 80%">
	                <hr class="uk-divider-icon">
	            </div>
	        </center>
    	
    	<!-- Available movies-->

    <div class="uk-card uk-card-secondary" style="width:80%">
    <h1>Available Movies</h1>
	    <table class="uk-table uk-table-hover">
		    <thead style="background-color:black;">
		        <tr>
		            <th>ID</th>
		            <th>Movie Name</th>
		            <th>Description</th>
		            <th>Image</th>
		            <th>Action</th>
		        </tr>
		    </thead>
		    <tbody>
		        <?php
		        	$sql = "SELECT * FROM movies";
		        	$res = mysqli_query($connection, $sql);
		        	while($row = mysqli_fetch_assoc($res)) {
		        		echo '<tr>';
		        		echo '<th style="padding-top:10px;">'. $row['id'] .'</th>';
		        		echo '<th style="padding-top:10px;">'. $row['name'] .'</th>';
		        		echo '<th style="padding-top:10px;">'. $row['description'] .'</th>';
		        		echo '<th>';
		        		echo '<div class="uk-width-1-3">';
		        		echo '<img class="card-img-top" src="data:image/jpeg;base64,';
		        		echo base64_encode($row['image']); 
		        		echo '" alt="Card image cap">';
		        		echo '</div>';
		        		echo '</th>';
		        		echo '<th style="padding-top:7px; padding-bottom:7px;">';
		        		echo '<form method="post">';
		        		echo '<input type="hidden" name="movie_id" value="'. $row['id'] .'">';
		        		echo '<input type="submit" name="delete_movie" class="uk-button uk-button-danger" value="Delete">';
		        		echo '</form>';
		        		echo '</th>';
		        		echo '</tr>';
		        	}
		        ?>
		    </tbody>
		</table>
		</div>
		</center>
		</div>
    </div>

    	</br>
	    </br>
	    <center>
	    <div style="width: 80%">
	        <hr class="uk-divider-icon">
	     </div>
	    </center>


	<!-- CINEMA MANAGENT -->
	<div id="cinema">
		    </br>
	    </br>	    </br>
	    </br>
    <center>
    
    <div class="uk-card uk-card-default" style="width:80%">
    <h1>Cinema Management</h1>
	    <table class="uk-table">
		    <thead style="background-color:black;">
		        <tr>
		            <th>Cinema</th>
		            <th>Movie Name</th>
		            <th>Selection</th>
		        </tr>
		    </thead>
		    <tbody>
		        <?php
		        	$sql = "SELECT * FROM cinemas";
		        	$res = mysqli_query($connection, $sql);
		        	$x = 1;
		        	$z = 0;
		        	while($row = mysqli_fetch_assoc($res)) {

		        		$sql_all_movies = 'SELECT * FROM movies';
                        $query_result2[$z] = mysqli_query($connection, $sql_all_movies);

		        		echo '<tr>';
		        		echo '<th> Cinema '. $x++ .'</th>';
		        		echo '<th>'. $row['movie_name'] .'</th>';
		        		echo '<th><form method = "post">';
                        echo '<div class="uk-margin">';
                        echo '<select class="uk-select" name="movies">';
                        echo '<option></option>';
                        while ($movie = mysqli_fetch_assoc($query_result2[$z])) {
                                                            
                            echo '<option>';
                            echo $movie['name'];
                            echo '</option>';
                        }
                        echo '</select>';
                        echo '</div>';
                        echo '<input  type="hidden"  name="pos" value="'. $z .' " > ';
                        echo '<input class="uk-button uk-button-default" name="select_btn[]" type="submit" value="Select"> ';
                        echo '</form></th>';	
		        		echo '</tr>';
		        		$z++;
		        	}
		        ?>
		    </tbody>
		</table>
		</div>
		</center>


    </div>  
	</body>
</html>