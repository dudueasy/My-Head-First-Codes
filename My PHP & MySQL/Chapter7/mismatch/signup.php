<?php
require_once('appvars.php');
require_once('connectvars.php');

//connect to the database
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if(isset($_POST['submit'])){
    //grab profile data from POST
    $username = mysqli_real_escape_string($dbc,trim($_POST['username']));
    $password1 = mysqli_real_escape_string($dbc,trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc,trim($_POST['password2']));
    
    if( !empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)){
        
        $query = "SELECT * FROM mismatch_user WHERE username = '$username'";
        
        $data = mysqli_query($dbc, $query);

        if(mysqli_num_rows($data) == 0 ){
            //The username is unique, so insert the data into database;
            $query = "INSERT INTO mismatch_user (username, password,join_date ) VALUES ('$username',SHA('$password1'),NOW())";
            mysqli_query($dbc, $query);
            
            //confirm success with user;
            echo '<p>Your new account has been successfully created. You\'re now ready to log in and'.
            '<a href="editprofile.php">Edit your profile</a></p>';
            mysqli_close($dbc);
            exit();
        } // username occupied;
        else{
            echo '<p class="error">An account already exists for this username. Please use a different username</p>';
            }
        
    } // information incompleted or wrong;
    else{
        echo '<p class="error">Please enter all the information</p>';
        mysqli_close($dbc);
    }
}
?>
  <p>Please enter your username and desired password to sign up to Mismatch </p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <fieldset>
      <label for="">Username:
        <input type="text" name="username" id="username" value="<?php if(isset($_POST['username'])){echo $_POST['username']; } ?>">
      </label>
      <label for="">Password:
        <input type="password" name="password1" id="password1" value="<?php if(isset($_POST['password1'])){echo $_POST['password1']; } ?>">
      </label>
      <label for="">Confirm the password:
        <input type="password" name="password2" id="password2" value="<?php if(isset($_POST['password2'])){echo $_POST['password2']; } ?>">
      </label>
    </fieldset>
    <input type="submit" name="submit" value="Sign up">
  </form>