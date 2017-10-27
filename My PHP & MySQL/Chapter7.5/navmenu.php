<?php 
//generate nav menu
echo'<hr/>';
if(isset($_SESSION['username'])){
?>

<a href="index.php">Home</a> &#10084;
<a href="viewprofile.php">viewprofile</a> &#10084;
<a href="editprofile.php">editprofile</a> &#10084;
<a href="logout.php">Log Out  <?php echo $_SESSION['username']; ?></a>

<?php
}
else{
 ?>   
<a href="login.php">Log In</a> &#10084;
<a href="signup.php">Sign Up</a>;
<?php 
}
echo'<hr/>';
?>