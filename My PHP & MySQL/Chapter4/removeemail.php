<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Make Me Elvis - Remove Email</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <?php
$dbc = mysqli_connect('localhost', 'root', 'root', 'elvis_store')
or die('Error connecting to MySQL server.');

if(isset($_POST['submit'])){
  foreach($_POST['todelete'] as $delete_id) {
  $query = "DELETE FROM email_list where id = $delete_id";
  mysqli_query($dbc,$query)
  or die('Error querying database');
}
echo 'Customers removed <br>';
}





//Display the costumer rows with checkboxes for deleting;
$query = "SELECT * FROM email_list";
$result = mysqli_query($dbc, $query);

while ($row = mysqli_fetch_array($result)){
    echo '<input type="checkbox" value="'.$row['id'].'" name="todelete[]">';
    echo $row['first_name'];
    echo ' '. $row['last_name'];
    echo ' '. $row['email'];
    echo  '<br />';
    
}

mysqli_close($dbc);
?>
      <input type="submit" name="submit" value="remove">
  </form>
</body>
</html>