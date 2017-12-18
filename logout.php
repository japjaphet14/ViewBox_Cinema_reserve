<?php

    session_start();
    include('function.php');


    $_SESSION['user_id'] = null;
    $_SESSION['name'] = null;
   
    header("location: home.php");
?>