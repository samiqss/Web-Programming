<!-- Created by Sami Al-Qusus April 1, 2018 -->
<!-- modified April 1, 2018 -->
<!-- Signup.php required for Lab11 -->

<?php
session_start();
$title = "Sign up";
require_once('front.php');
require('../private/loginHelpers.php');
$status;
$passWord;
$email;
$username;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST['username'])){
		$status=2;
	}else{
	  $username =test_input($_POST['username']);
    }
	if (empty($_POST['password'])){
		$status=2;
	}else{
	  $passWord =test_input($_POST['password']);
    }
	if (empty($_POST['email'])){
		$status=2;
	}else{
	    $email =test_input($_POST['email']);
    }
	if (empty($_POST['theme'])){
		$status=2;
	}else{
	    $theme =test_input($_POST['theme']);
    }
    if(!$status==2 && createAccount($username,$passWord,$email,$theme)){

	$status = 1;
	$_SESSION['UserData']['Username']=$username;
	$_SESSION['theme']=$theme;
	header("Location:Lab11.php");
	exit;
    }else if ($status==2){
        $status=2;
    } else{
	$status = 0;
    }
}

echo "<h1 class='text-center'>Sign up</h1>";
?>
<div class="container">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<div class="container">
    <label for="ideaName"><b>Username</b></label></br>
    <input type="text" name="username" value=""></br>
  </div>
<div class="container">
    <label for="password" ><b>Password</b></label></br>
    <input type="password" name="password" value=""></br>
</div></br>
<div class="container">
    <label for="email" ><b>email</b></label></br>
    <input type="email" name="email" value=""></br>
</div></br>
<div class="container">
<div>Pick a theme:</div>
<input type="checkbox" name="theme" value="daytime">daytime<br>
<input type="checkbox" name="theme" value="nighttime">nighttime<br>
<input class="btn btn-primary"  type="submit" name="submit" value="Submit">
</div></br>
</form>
</div>

<?php
if($status === 0 ){
	echo "Error: account creation failed";
}

if($status === 2 ){
	echo "Error: can not have empty sections";
}

require_once('back.php');
?>

