<?php
require_once('authorize.php');
?>

<?php  
require_once('appvars.php');
require_once('connectvars.php');

if(isset($_GET['id']) && isset($_GET['date']) &&isset($_GET['screenshot'])&&
isset($_GET['score']) && isset($_GET['name'])){
    
    $id = $_GET['id'];
    $score = $_GET['score'];
    $name= $_GET['name'];
    $date = $_GET['date'];
    $screenshot = $_GET['screenshot'];
    
    echo '<p>Are you sure you want to approve the following high score?</p>';
    echo '<p><strong>Name: </strong>'.$name.'</p>';
    echo '<p><strong>Date: </strong>'.$date.'</p>';
    echo  '<p><strong>Score: </strong>'.$score.'</p>';
    
    echo '<form method="POST" action="approvescore.php">';
    echo '<label><input type="radio" name="confirm" value="YES">YES </label><br>';
    echo  '<label><input type="radio" name="confirm" value="NO" selected>NO</lable><br>';
    echo  '<input type="submit" name="submit" value="submit">';
    echo  '<input type="hidden" name="id" value="'.$id.'">';
    echo  '<input type="hidden" name="name" value="'.$name.'">';
    echo  '<input type="hidden" name="score" value="'.$score.'">';
    
    echo '</form>';
}

if( isset($_POST['submit']) ){
    
$score = $_POST['score'];
$name = $_POST['name'];
$id = $_POST['id'];

    if( $_POST['confirm']== 'YES' ){
        $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        $query = "UPDATE guitarwars SET approved = 1 WHERE id = $id";
        
        mysqli_query($dbc,$query);
        mysqli_close($dbc);
        echo '<p>The high score of '.$score.' for '.$name.' was successfully approved.</p>';
        
    }
    else if($_POST['confirm'] == 'NO') {
        echo '<p class="error">The high score is not approved.</p>';
    }
    
}

echo '<p><a href="admin.php">&lt;&lt; Back to admin page</a></p>';

?>