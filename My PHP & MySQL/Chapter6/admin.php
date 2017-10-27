<?php
require_once('authorize.php');
?>
<?php
require_once('connectvars.php');
require_once('appvars.php');

$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$query = "SELECT * FROM guitarwars ORDER BY `score` DESC, `date` ASC";
$data = mysqli_query($dbc,$query);

echo '<table>';
while($row = mysqli_fetch_array($data)){
    echo '<tr class="scorerow"><td><strong>'.$row['name'].'</strong></td>' ;
    echo '<td>'.$row['date'].'</td>';
    echo '<td>'.$row['score'].'</td>';
    echo '<td><a href="remove.php?id='.$row['id'].'&amp;date='.$row['date'].'&amp;name='.
    $row['name'].'&amp;score='.$row['score'].'&amp;screenshot='.$row['screenshot'].
    '">REMOVE</a></td>';

    if($row['approved']==0){
          echo '<td><a href="approvescore.php?id='.$row['id'].'&amp;date='.$row['date'].'&amp;name='.
    $row['name'].'&amp;score='.$row['score'].'&amp;screenshot='.$row['screenshot'].
    '">approve</a></td></tr>';
    }
  
}
echo '</table>';
?>