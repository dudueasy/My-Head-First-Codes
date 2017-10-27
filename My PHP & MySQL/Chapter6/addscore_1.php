<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Guitar Wars - Add Your High Score</title>
</head>

<body>
  <h2>Guitar Wars - Add Your High Score</h2>
<?php
//define the upload path and maximum file size constants
require_once('appvars.php');
require_once('connectvars.php');
if(isset($_POST['submit'])){
    //grab the score data from the POST for information
    $name = mysqli_real_escape_string($dbc,trim($_POST['name']));
    $score = mysqli_real_escape_string($dbc,trim($_POST['score']));
    $screenshot =time().$_FILES['screenshot']['name'];
    if(!empty($name) && !empty($score)&& is_numeric($score)&& !empty( $_FILES['screenshot']['name'])){
        //file type and file size check
        if((($_FILES['screenshot']['type']=='image/png') ||($_FILES['screenshot']['type']=='image/jpeg')
        ||($_FILES['screenshot']['type']=='image/pjpeg')||($_FILES['screenshot']['type']=='image/gif'))
        &&($_FILES['screenshot']['size']>0) && ($_FILES['screenshot']['size'] <= GW_MAXFILESIZE)){
            IF($_FILES['screenshot']['error'] == 0){
                //connect database
                $target = GW_UPLOADPATH . $screenshot;
                echo $_FILES['screenshot']['tmp_name'];
                // move the file folder of updated pic firstly;
                if(move_uploaded_file($_FILES['screenshot']['tmp_name'],$target)){
                    
                    $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
                    $query = "INSERT INTO guitarwars (`date`,`name`,`score`,`screenshot`) VALUES(NOW(),'$name','$score','$screenshot')"
                    or die('Error querying database');
                    mysqli_query($dbc,$query);
                    
                    // Confirm success with the user;
                    echo '<p>Thanks for adding your new high score!</p>';
                        echo '<p><strong>Name:</strong> ' . $name . '<br />';
                    echo '<strong>Score:</strong> ' . $score . '</p>';
                    echo '<img src="'.$target.'" alt="Score image" >';
                    echo '<p><a href="index.php">&lt;&lt; Back to high scores</a></p>';
                    
                    // Clear the score data to clear the form;
                    $name = "";
                    $score = "";
                    
                    
                    
                    mysqli_close($dbc);
                }
                else{
                    echo '<p class="error">Sorry, there was a problem uploading your screenshot image.</p>';
                }
            }
        } else{
            echo '<p class="error"> The screen shot must be a GIF, JPEG, or PNG image file no greater than '
            .(GW_MAXFILESIZE/1024).'KB in size</p>';
        }
        @unlink($_FILES['screenshot']['tmp_name']);
    }
    else{
        echo '<p class="error"> Please enter all the information. </p>';
    }
    
}
?>
    <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF'];?> ">
      <input type="hidden" name="MAX_FILE_SIZE" value="32768">
      <label for="name">Name: </label>
      <input type="text" id="name" name="name" value="<?php if(isset($name)){echo $name;} ?>">

      <label for="score">Score: </label>
      <input type="text" id="score" name="score" value="<?php if(isset($score)){echo $score;} ?>">

      <input type="file" name="screenshot" value="">
      <hr />

      <input type="submit" name="submit" value="Add">

    </form>


</body>

</html>