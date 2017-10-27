<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Risky Jobs - Registration</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
  <img src="riskyjobs_title.gif" alt="Risky Jobs" />
  <img src="riskyjobs_fireman.jpg" alt="Risky Jobs" style="float:right" />
  <h3>Risky Jobs - Registration</h3>

  <?php
if (isset($_POST['submit'])) {
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $job = $_POST['job'];
    $resume = $_POST['resume'];
    $output_form = 'no';
    $regex = ' /^\(?[2-9]\d{2}\)?[-\s\.]\d{3}[-\s\.]\d{4}$/ ';
    $pattern = ' /[\(\)\s-\.]/ ';
    $new_phone = preg_replace($pattern, '',$phone);
    
      
    
    if (empty($first_name)) {
        // $first_name is blank
        echo '<p class="error">You forgot to enter your first name.</p>';
        $output_form = 'yes';
    }
    
    if (empty($last_name)) {
        // $last_name is blank
        echo '<p class="error">You forgot to enter your last name.</p>';
        $output_form = 'yes';
    }
    
    //validate email
    if(!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', $email)){
        //valid prefix of email
        echo 'Your email address is invalid.<br>';
        $output_form = 'yes';
    }else{
        $domain = preg_replace('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/','',$email);
        // check if $domain is registered
        if(!checkdnsrr($domain)){
            echo 'Your email address is invalid.<br>';
            $output_form = 'yes';
        }else{
            echo "Your are registered as $email";
        }
        
    }
    
    if (!preg_match($regex,$phone)) {
        // $phone is not matched;
        echo '<p class="error">Please enter a valid phone number.</p>';
        $output_form = 'yes';
    }else{
        echo'<p>Your phone number has been registered as '.$new_phone.'</p>';
    }
    
    if (empty($job)) {
        // $job is blank
        echo '<p class="error">You forgot to enter your desired job.</p>';
        $output_form = 'yes';
    }
    
    if (empty($resume)) {
        // $resume is blank
        echo '<p class="error">You forgot to enter your resume.</p>';
        $output_form = 'yes';
    }
}
else {
    $output_form = 'yes';
}

if ($output_form == 'yes') {
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <p>Register with Risky Jobs, and post your resume.</p>
      <table>
        <tr>
          <td>
            <label for="firstname">First Name:</label>
          </td>
          <td>
            <input id="firstname" name="firstname" type="text" value="<?php  echo (isset($first_name))?$first_name:''; ?>" />
          </td>
        </tr>
        <tr>
          <td>
            <label for="lastname">Last Name:</label>
          </td>
          <td>
            <input id="lastname" name="lastname" type="text" value="<?php echo (isset($last_name))?$last_name:''; ?>" />
          </td>
        </tr>
        <tr>
          <td>
            <label for="email">Email:</label>
          </td>
          <td>
            <input id="email" name="email" type="text" value="<?php echo (isset($email))?$email:''; ?>" />
          </td>
        </tr>
        <tr>
          <td>
            <label for="phone">Phone:</label>
          </td>
          <td>
            <input id="phone" name="phone" type="text" value="<?php echo (isset($phone))?$phone:''; ?>" />
          </td>
        </tr>
        <tr>
          <td>
            <label for="job">Desired Job:</label>
          </td>
          <td>
            <input id="job" name="job" type="text" value="<?php echo (isset($job))?$job:'' ; ?>" />
          </td>
        </tr>
      </table>
      <p>
        <label for="resume">Paste your resume here:</label>
        <br />
        <textarea id="resume" name="resume" rows="4" cols="40">
          <?php echo (isset($resume))?$resume:'';?>
        </textarea>
        <br />
        <input type="submit" name="submit" value="Submit" />
      </p>
    </form>

    <?php
}
else if ($output_form == 'no') {
    echo '<p>' . $first_name . ' ' . $last_name . ', thanks for registering with Risky Jobs!</p>';
        
    // code to insert data into the RiskyJobs database...
}
?>

</body>

</html>