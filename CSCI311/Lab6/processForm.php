<!-- Created by Sami Al-Qusus -->
<!-- Originally created by Sami Al-Qusus February 19, 2018 -->
<!-- modified February 26, 2018 -->
<!-- processForm.php required for Lab6 -->
<?php

if (isset($_POST['name'])){
	$userName = $_POST['name'];
	$userName = trim($userName);
	if(strlen($userName) <=0) {
	   $err1=true;
	}else{
	   $err1=false;
	}
}else{
	$err1 = true;
}

if (isset($_POST['animal'])){
	$animal = $_POST['animal'];
	$animal = trim($animal);
	if(strlen($animal) <=0) {
	   $err2=true;
	}else{
	   $err2=false;
	}
}else{
	$err2 = true;
}

if (isset($_POST['color1'])){
	$color1 = $_POST['color1'];
	$err3 = false;
}else{
	$err3 = true;
}

if (isset($_POST['color1'])){
	$color2 = $_POST['color2'];
	$err4 = false;
}else{
	$err4 = true;
}

if (isset($_POST['color1'])){
	$font = $_POST['font'];
	$err5 = false;
}else{
	$err5 = true;
}
if ($err1 or $err2 or $err3 or $err4 or $err5){
        header("location:Bad.html");	
}else{
	require_once('front.php');
?>
	<body style="background-color: <?php echo $color1; ?>; color:<?php echo $color2; ?>; font-family:<?php echo $font; ?>;">
        <h1 style="text-align:center;">Lab6 Results</h1>
        <nav><a href="Lab6.php">Back to form</a></nav>
	<h1> <?php echo $userName; ?>'s Favourite Animal</h1>
        <p><?php echo $animal; ?></p>
<?php
	if(!empty($_POST['country'])) {
	     echo "<h2>Countries $userName would like to visit:</h2><br/>";
           foreach($_POST['country'] as $check) {
             echo $check."<br/>";
	   }
	}
	   require_once('back.php');
}

?>

