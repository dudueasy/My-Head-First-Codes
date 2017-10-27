<?php  
session_start();

//If session variables aren't existed, set them with cookie
if(!isset($_SESSION['user_id'])){
    if(isset($_COOKIE['user_id']) && isset($_COOKIE['username'])){
        $_SESSION['user_id'] = $_COOKIE['user_id'];
        $_SESSION['username'] = $_COOKIE['username'];
    }
}

?>