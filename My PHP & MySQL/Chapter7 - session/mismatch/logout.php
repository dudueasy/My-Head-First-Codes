<?php
//if user logged in, delete session to log them out
session_start();
if(isset($_SESSION['user_id'])){
    $_SESSION = array();

//if cookie is available, delete session_name cookie
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),'',time()-3600);
    }

    //destroy and close session
    session_destroy();
}

//redirect to home page
$home_url = 'http://'. $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php';
header('Location: '.$home_url);
?>