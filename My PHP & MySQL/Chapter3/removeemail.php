<?php

$email = $_POST['email'];

$dbc = mysqli_connect('localhost','root','root','elvis_store')
or die('Error connecting MySQL server');

$query  = "DELETE FROM email_list WHERE email = '$email'";

mysqli_query($dbc,$query)
or die('Error querying database');
mysqli_close($dbc);

echo($email."<br />");
echo("$email" ."<br />");
echo "Your email: $email will no longer receive our message";
?>