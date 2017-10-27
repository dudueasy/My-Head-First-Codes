<?php

$subject = $_POST['subject'];
$from = '423848003@QQ.COM';
$text = $_POST['elvismail'];


$dbc = mysqli_connect('localhost','root','root','elvis_store')
or die ('Error connectiong MySQL server');

$query = 'SELECT * FROM email_list ';
$result = mysqli_query($dbc,$query)
    or die('Error querying database.');



while($row = mysqli_fetch_array($result)){
    $firstname= $row['first_name'];    
    
    $lastname= $row['last_name'];
    $to = $row['email'];
        
    $msg = "Dear $firstname $lastname,\n$text";

    mail($to,$subject,$msg,'From:'.$from);
    print_r($row);
    echo "mail sent to $to.<br /> ";
}

mysqli_close($dbc);
?>