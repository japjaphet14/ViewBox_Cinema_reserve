<?php

    function form_errors($errors = array()) {
    
        $errorMessage = "";
        if(!empty($errors)) {
            
            $errorMessage .= "<div class=\"uk-alert-warning\" uk-alert>";
            $errorMessage .= "<a class=\"uk-alert-close\" uk-close></a>";
            $errorMessage .= "<h4 style=\"margin-bottom: 0px;\">ERROR!</h4><ul style=\"margin-top:0px\">";
            foreach ($errors as $key => $error) {
                
                $errorMessage .= "<li>{$error}</li>";
            }
            $errorMessage .= "</ul>";
            $errorMessage .= "</div>";
        }
        return $errorMessage;
    }

    function has_presence($value) {
        
        return isset($value) && $value !== "";
    }

    function num_Checker($val) {
        
        $numberInString = 0;
        for($x = 0; $x < $val.length(); $x++) {
            
            if(is_Numeric($val[$x])) {
                
                $numberInString++;
            }
        }
        
        if($numberInString > 0) {
            
            return false;
        }else {
            
            return true;
        }
    }

    function has_max_length($value, $max) {
        
        return strlen($value) <= $max;
    }

    function logged_in_admin() {
        
        if($_SESSION['name'] == 'admin') {
            
            return true;
        }else {
            
            return false;
        }
    }
    
    function confirm_logged_in_admin() {
        
        if(!logged_in_admin()) {
            
            header("location:home.php");
        }
    }

    function already_logged_in() {
        
        if(isset($_SESSION['name'])) {
            
            header("location:home.php");
        }
    }
?>