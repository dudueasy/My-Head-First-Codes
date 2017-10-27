<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Make Me Elvis - Send Email</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

  <?php
if (isset($_POST['submit'])) {
    $output_form = false;
    $from = 'elmer@makemeelvis.com';
    $subject = $_POST['subject'];
    $text = $_POST['elvismail'];
    
    if (empty($subject)&&empty($text)) {
        echo 'You forgot the email subject and body text';
        $output_form = true;
    }
    
    
    if (empty($subject)&!empty($text)) {
        echo 'You forgot the email subject';
        $output_form =true;
    }
    
    if (!empty($subject)&empty($text)) {
        echo 'You forgot the email body text';
        $output_form =true;
    }
    
    if (!empty($subject)&&!empty($text)) {
        $dbc = mysqli_connect('localhost', 'root', 'root', 'elvis_store')
        or die('Error connecting to MySQL server.');
        
        $query = "SELECT * FROM email_list";
        $result = mysqli_query($dbc, $query)
        or die('Error querying database.');
        
        while ($row = mysqli_fetch_array($result)) {
            $to = $row['email'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $msg = "Dear $first_name $last_name,\n$text";
            mail($to, $subject, $msg, 'From:' . $from);
            echo 'Email sent to: ' . $to . '<br />';
        }
        
        mysqli_close($dbc);
    }
} else {
    $output_form = true;
    
 /*   ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

      <label for="subject">Subject of email:</label>
      <br />
      <input id="subject" type="text" name="subject" value="" size="30">
      <br>
      <label for="elvismail">Body of email:</label>
      <br>
      <textarea name="elvismail" id="elvismail" rows="8" cols="40"></textarea>
      <br>
      <input type="submit" name="submit" value="submit">
    </form>
    <?php
    */
}

if ($output_form == true) {
    ?>
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <label for="subject">Subject of email:</label>
        <br />
        <input id="subject" type="text" name="subject" value="<?php if(isset($subject)){ echo $subject;} ?>" size="30">
        <br>
        <label for="elvismail">Body of email:</label>
        <br>
        <textarea name="elvismail" id="elvismail" rows="8" cols="40"><?php if(isset($text)){echo $text;} ?></textarea>
        <br>
        <input type="submit" name="submit" value="submit">

      </form>

      <?php
}
?>






</body>

</html>