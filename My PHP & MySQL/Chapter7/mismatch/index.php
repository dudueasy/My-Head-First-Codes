<html>

<head>
  <meta charset="utf-8" />
  <title>Mismatch - Where opposites attract!</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
  <h3>Mismatch - Where opposites attract!</h3>

  <?php
require_once('appvars.php');
require_once('connectvars.php');

if(isset($_COOKIE['user_id'])&&isset($_COOKIE['username'])){
    // Generate the navigation menu
    echo '&#10084; <a href="viewprofile.php">View Profile</a><br />';
    echo '&#10084; <a href="editprofile.php">Edit Profile</a><br />';
    echo '&#10084; <a href="logout.php">Log out '.$_COOKIE['username'].'</a><br />';
    
}
else{
    echo '&#10084; <a href="login.php">login</a><br />';
    echo '&#10084; <a href="signup.php">signup</a><br />';
}


// Connect to the database
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Retrieve the user data from MySQL
$query = "SELECT user_id, first_name, picture FROM  mismatch_user WHERE first_name IS NOT NULL ORDER BY join_date DESC LIMIT 5";
$data = mysqli_query($dbc, $query);

// Loop through the array of user data, formatting it as HTML
echo '<h4>Latest members:</h4>';
echo '<table>';
while ($row = mysqli_fetch_array($data)) {
    if (is_file(MM_UPLOADPATH . $row['picture']) && filesize(MM_UPLOADPATH . $row['picture']) > 0) {
        echo '<tr><td><img src="' . MM_UPLOADPATH . $row['picture'] . '" alt="' . $row['first_name'] . '" /></td>';
    }
    else {
        echo '<tr><td><img src="' . MM_UPLOADPATH . 'nopic.jpg' . '" alt="' . $row['first_name'] . '" /></td>';
    }
    echo '<td>' . $row['first_name'] . '</td></tr>';
}
echo '</table>';

mysqli_close($dbc);
?>

</body>

</html>