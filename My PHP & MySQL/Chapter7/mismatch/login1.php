<?php

require_once('connectvars.php');
$error_msg = '';
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if(isset($_COOKIE['user_id'])){
    echo 'You are logged in as '.$_COOKIE['username'] ;
}

else{
    if(isset($_POST['submit'])){
        if(isset($_POST['username'])&& isset($_POST['password'])){
            $username = mysqli_real_escape_string($dbc,trim($_POST['username']));
            $password = mysqli_real_escape_string($dbc,trim($_POST['password']));
            
            //  $user_username =  mysqli_real_escape_string($dbc,trim($_POST['username']));
            // $user_password =  mysqli_real_escape_string($dbc,trim($_POST['password']));
            
            $query = "SELECT user_id, username from mismatch_user where username = '$username' and password = SHA('$password')";
            // $query = "SELECT `user_id`, `username` FROM mismatch_user WHERE username = '$user_username' and password = SHA('$user_password')";
            
            $data = mysqli_query($dbc,$query);
            if(mysqli_num_rows($data) == 1){
                $row = mysqli_fetch_array($data);
                
                
                setcookie('user_id',$row['user_id'],time()+(7*24*60*60));
                setcookie('username',$row['username'],time()+(7*24*60*60));
                //redirect to home page
                $url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php';
                header('Location:'.$url);
            }
            else{
                $error_msg = 'Please input valid username and password';
            }
        } else{
            $error_msg = 'Please input username and password';
        }
    }
    ?>
  <html lang="en">

  <head>
    <title>Mismatch - Log In</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style.css" rel="stylesheet">
  </head>

  <body>
    <h3>Mismatch - Log In</h3>
    <?php if(!isset($_COOKIE['user_id'])){
        echo '<p class="error">'.$error_msg.'</p>';
    }
    ?>
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
          <legend>Log In</legend>
          <label for="">Username:
            <input type="text" id="username" name="username" value="<?php if(isset($user_username)){echo $user_username;}?>" />
          </label>
          <label for="">Password:
            <input type="password" id="password" name="password" value="<?php if(isset($user_password)){echo $user_password;}?>">
          </label>
          <br>
          <br>
          <input type="checkbox" id="checkbox" name="checkbox" value="">
          <label for="checkbox">Remember me in a week</label>
        </fieldset>
        <input type="submit" name="submit" id="submit" value="Log In">
      </form>
  </body>

  </html>
  <?php
}
?>