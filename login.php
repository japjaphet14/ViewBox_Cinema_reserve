<?php
    session_start();
    require_once("function.php");
    require_once("database.php");
    $errors = array();
    already_logged_in();

    if (isset($_POST['login_btn'])) {
        
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        
        $sql = "SELECT * FROM user_info WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($connection, $sql);
        $data = mysqli_fetch_assoc($result);
        
        //Validations if empty
        $fields_required = array("username", "password");
        foreach($fields_required as $field) {
            
            $value = trim($_POST[$field]);
            if(!has_presence($value)) {
                
                $errors[$field] ='<p style ="color:red;margin-bottom:0px;margin-top:0px;">'. ucfirst($field).'</p>' . '<p style="color:red;margin-bottom:0px;margin-top:0px;"> cant be blank</p>';
            }
        }
        
        if(empty($errors)) {
            //user validation
            if($username == $data['username'] && $password == $data['password']) {
            
                $_SESSION["user_id"] = $data['user_ID'];
                $_SESSION["name"] = $data['username'];
                header("location: home.php");
            }else {
            
                $errors["match_form"] = '<p style="color:red;margin-bottom:0px;margin-top:0px;">Username/Password do not match</p>';
            }
        }
    }
     ?>
  

    <html>

    <head>
        <link rel="stylesheet" href="css/uikit.min.css">
        <link rel="shortcut icon" href="asd_images/viewbox.png">
        <title>View Box</title>

    </head>
    <script src="js/uikit.min.js"></script>

    <body style="background-image: url(asd_images/background2.jpeg);">

        <div class="uk-position-center" >
            <div class="uk-card uk-card-secondary uk-card-large uk-card-body ">
                <?php 
                                                    
                    echo '<p style =background-color: Black; color: red;>'.form_errors($errors).'</p>';
                ?>
                <h2 class="uk-heading-divider">Reserve</h2>

                <form class="uk-form-horizontal uk-margin" method="post">

                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-horizontal-text" style="width:100px">Username</label>
                        <div class="uk-form-controls" style="margin-left:100px">
                            <input class="uk-input" name="username" id="form-horizontal-text" type="text">
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-horizontal-select" style="width:100px">Password</label>
                        <div class="uk-form-controls" style="margin-left:100px" ss>
                            <input class="uk-input" name="password" id="form-horizontal-text" type="password">
                        </div>
                    </div>
                    <div class="uk-flex uk-flex-center">

                        <input class="uk-button uk-button-primary" type="submit" name="login_btn" value="Login"> &nbsp;
                        <a class="uk-button uk-button-submit" href="home.php">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </body>

    </html>
