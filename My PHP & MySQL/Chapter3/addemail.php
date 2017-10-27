<?php
$dbc = mysqli_connect('localhost','root','root','elvis_store')
    or die('Error connecting to MySQL server');
    
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];

$query = "INSERT INTO email_list() VALUES('$first_name','$last_name','$email')";

mysqli_query($dbc,$query)
    or die('Error querying database'); 

mysqli_close($dbc);

echo 'Customer added.';

?>