<!-- Created by Sami Al-Qusus April 1, 2018 -->
<!-- modified April 1, 2018 -->
<!-- USerPage.php required for Lab11 -->

<?php
session_start();
if(!isset($_SESSION['UserData']['Username'])){
	header("location:Lab11.php");
	exit;
}
$username=htmlspecialchars($_SESSION['UserData']['Username']);
$title = $username;
require_once('front.php');
echo "<h1 class='text-center'>Welcome to your page</h1>";
?>


<div class="container">Hi <?php echo $username; ?> </div>

<div class="container">your theme is <?php echo $theme; ?> </div>

<div class="container"><a href='Logout.php'>Log out</a></div>

<img src="droneviewSFU1.JPG" alt="view" width='70%' height='80%'>

<?php	
require_once('back.php');
?>

