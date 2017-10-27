<?php
//if user logged in, delete cookie to log them out
if(isset($_COOKIE['username']) && isset($_COOKIE['user_id'])){
setcookie('user_id','',time()-3600);
setcookie('username','',time()-3600);
}

//redirect to home page
$home_url = 'http://'. $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php';
header('Location: '.$home_url);
?>