<!DOCTYPE html>
<html lang="en">

<head>
  <title>Guitar Wars - Remove a High Score</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

  <?php
require_once('appvars.php');
require_once('connectvars.php');

if(isset($_GET['id']) && isset($_GET['date']) &&isset($_GET['screenshot'])&&
isset($_GET['score']) && isset($_GET['name'])){
    //grab data from the GET
    
    $id = $_GET['id'];
    $score = $_GET['score'];
    $name= $_GET['name'];
    $date = $_GET['name'];
    $screenshot = $_GET['screenshot'];

   //show the form 
    echo '<p>Are you sure you want to delete the following high score?</p>';
    echo '<p><strong>Name: </strong>'.$name.'</p>';
    echo '<p><strong>Date: </strong>'.$date.'</p>';
    echo  '<p><strong>Score: </strong>'.$score.'</p>';
    
    echo '<form method="POST" action="remove.php">';
    echo '<input type="radio" name="confirm" value="YES">YES<br>';
    echo  '<input type="radio" name="confirm" value="NO">NO<br>';
    echo  '<input type="submit" name="submit" value="submit">';
    echo  '<input type="hidden" name="id" value="'.$id.'">';
    echo  '<input type="hidden" name="name" value="'.$name.'">';
    echo  '<input type="hidden" name="score" value="'.$score.'">';

    echo '</form>';
}
else if (isset($_POST['id']) && isset($_POST['score']) && isset($_POST['name'])){
    //grab data from POST
    
    $id = $_POST['id'];
    $score = $_POST['score'];
    $name= $_POST['name'];
    
}
else{
    echo '<p class="error">Sorry, no high score was specified for removal.</p>';
    }

if(isset($_POST['submit'])){
    if($_POST['confirm']== 'YES'){
        //delete screenshot from the server
        @unlink(GW_UPLOADPATH.$screenshot);
        
        //connect to database
        $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        $query = "DELETE FROM guitarwars WHERE `id` = $id LIMIT 1";
        
        //delete the score data from the database
        mysqli_query($dbc,$query);
        mysqli_close($dbc);

        //confirm success 
        echo '<p>The high score of '.$score.' for '.$name.' was successfully removed.</p>' ;
            
    }
    else{
        echo '<p class="error">The high score was not removed</p>';
    }
}

/*
else if(isset($id) && isset($name) && isset($score) && isset($date) && isset($screenshot)){
    
    echo '<p>Are you sure you want to delete the following high score?</p>';
    echo '<p><strong>Name: </strong>'.$name.'</p>';
    echo '<p><strong>Date: </strong>'.$date.'</p>';
    echo  '<p><strong>Score: </strong>'.$score.'</p>';
    
    echo '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
    echo '<input type="radio" name="confirm" value="YES">YES<br>';
    echo  '<input type="radio" name="confirm" value="NO">NO<br>';
    echo  '<input type="submit" name="submit" value="submit">';
    echo  '<input type="hidden" name="id" value="'.$id.'">';
    echo  '<input type="hidden" name="id" value="'.$name.'">';
    echo  '<input type="hidden" name="id" value="'.$score.'">';

    echo '</form>';
}*/
echo '<p><a href="admin.php">&lt;&lt; Back to admin page</a></p>';

?>

</body>

</html>