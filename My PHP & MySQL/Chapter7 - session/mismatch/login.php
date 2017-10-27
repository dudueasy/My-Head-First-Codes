<?php
require_once('connectvars.php');

session_start();
//clear the error message
$error_msg = "";

//if user is not logged in
if(!isset($_SESSION['user_id'])){
    if(isset($_POST['submit'])){
        // connect to the database;
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        
        //grab user entered log-in data;
        $user_username =  mysqli_real_escape_string($dbc,trim($_POST['username']));
        $user_password =  mysqli_real_escape_string($dbc,trim($_POST['password']));
        if(!empty($user_username) && !empty($user_password)){
            //Look up the username in database;
            $query = "SELECT `user_id`, `username` FROM mismatch_user WHERE username = '$user_username' and password = SHA('$user_password')";
            $data = mysqli_query($dbc, $query);
            
            //log in successfully;
            if( mysqli_num_rows($data)== 1 ){
                //set user_id and username variables;
                $row = mysqli_fetch_array($data);
                
                
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                //redirect to main page while log in;
                $home_url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index.php';
                header('Location: '.$home_url);
            }
            
            //log in fail so send the authentication header;
            else{
                $error_msg='sorry, you must enter a valid username and password to log in.';
            }
        }
        else{
            //The user information is not entered
            $error_msg = 'Sorry, you must enter your username and password to log in.';
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
      <?php
}
else{
    //confirm the successful log in
    echo '<p class="login">You are logged in as '.$_SESSION['username'].'</p>';
}
?>
  </body>

  </html>