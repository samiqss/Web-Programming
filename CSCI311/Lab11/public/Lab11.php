<!-- Created by Sami Al-Qusus April 1, 2018 -->
<!-- modified April 1, 2018 -->
<!-- Lab11.php required for Lab11 -->

<?php
session_start(); 
$title = "Lab 11";

require_once('front.php');
require_once("../private/loginHelpers.php");
$theme;
$status=0;
if(isset($_SESSION['UserData']['Username'])){
	$status = 2;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['username'])){
           $status=3;
    }else{
	  $username =test_input($_POST['username']);
    }
    if (empty($_POST['password'])){
	    $status=3;
    }else{
	  $passWord =test_input($_POST['password']);
    }


    if(!$status==3 && attempt_login($username,$passWord)){
	$status = 1;
	$_SESSION['UserData']['Username']=htmlspecialchars($username);
        $_SESSION['theme']=$theme;
    }else if ($status==3){
        $status=3;
    }else{
	$status = 0;
    }
}

echo "<h1 class='text-center'>Lab 11 Home Page</h1>";
?>
<div class="container">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<div class="container">
    <label for="ideaName"><b>Username</b></label></br>
    <input type="text" name="username" value=""></br>
  </div>
<div class="container">
    <label for="ipassword" ><b>Password</b></label></br>
    <input type="password" name="password" value=""></br>
</div></br>
<div class="container">
    <input class="btn btn-primary"  type="submit" name="submit" value="Submit">
</div></br>
</form>
</div>

<?php

if($status ===1 || $status ===2 ){
	echo "<div class='container'>you're logged in! ";
	echo "<a href='Logout.php'>Log out</a></div>";
}else if ($status ===3){
	echo "<div class='container'><b>we need both your username and password </b>Do you have an account?";
	echo "<a href='Signup.php'>Sign up</a></div>";
}else{
	echo "<div class='container'>Do you have an account? ";
	echo "<a href='Signup.php'>Sign up</a></div>";
}
	

require_once('back.php');
?>

