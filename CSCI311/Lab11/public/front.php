<!DOCTYPE html>
<!-- Created by Sami Al-Qusus March 17, 2018 -->
<!-- modified April 1, 2018 -->
<!-- front.php for Lab11 -->

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
                
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        <!-- popper library -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
                
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	
        <title><?php echo $title; ?></title>
    </head>
<?php

if(isset($_SESSION['theme'])){
	$theme=$_SESSION['theme'];
	if($theme=="daytime"){
		echo "<body class='container text-dark bg-light' >";
	}else{
		echo "<body class='container text-white bg-dark' >";
	} 
}else{
	echo "<body>";
}
?>
      <header>
	  <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
	       <a class="navbar-brand" href="Lab11.php">Home</a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                   <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
               <ul class="navbar-nav ml-auto  mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="UserPage.php">User's Page &nbsp;</a>
		</li>
                <li class="nav-item">
                    <a class="nav-link" href="EveryonePage.php">Anyone's Page &nbsp;</a>
               </li>
	       </ul>
               </div>
          </nav>
      </header><br><br><br>
      <div class="container"> 
