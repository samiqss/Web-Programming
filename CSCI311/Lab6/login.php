<!-- Created by Sami Al-Qusus -->
<!-- Originally created by Sami Al-Qusus February 19, 2018 -->
<!-- modified February 26, 2018 -->
<!-- login.php required for Lab6 -->

<?php session_start(); /* Starts the session */
	
	/* Check Login form submitted */	
	if(isset($_POST['Submit'])){
		/* Define username and associated password array */
		/* Modify this array, to create a username for me, and for you, and (optionally) for a third person
		Please do not modify my user name, but give me a different password*/
		$logins = array('Sarah' => 'homework1','sami' => 'homework1');
						
		/* Check and assign submitted Username and Password to new variable */
		$Username = isset($_POST['Username']) ? $_POST['Username'] : '';
		$Password = isset($_POST['Password']) ? $_POST['Password'] : '';
								
		/* Check Username and Password existence in defined array */		
		if (isset($logins[$Username]) && $logins[$Username] == $Password){
			/* Success: Set session variables and redirect to Protected page  */
			$_SESSION['UserData']['Username']=$logins[$Username];
			/*header("location:index.php");*/
			header("location:Lab6.php");			
			exit;
		} else {					
		/*Unsuccessful attempt: Set error message */	  		
		$msg="<span style='color:red'>Invalid Login Details</span>";			
		}
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sami's Lab6 login</title>
<link href="./css/style.css" rel="stylesheet">
</head>
<body>
<div id="Frame0">
  <h1>Sami's Lab6 login</h1>
</div>
<br>
<form action="" method="post" name="Login_Form">
  <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
    <?php if(isset($msg)){?>
    <tr>
      <td colspan="2" align="center" valign="top"><?php echo $msg;?></td>
    </tr>
    <?php } ?>
    <tr>
      <td colspan="2" align="left" valign="top"><h3>Login</h3></td>
    </tr>
    <tr>
      <td align="right" valign="top">Username</td>
      <td><input name="Username" type="text" class="Input"></td>
    </tr>
    <tr>
      <td align="right">Password</td>
      <td><input name="Password" type="password" class="Input"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="Submit" type="submit" value="Login" class="Button3"></td>
    </tr>
  </table>
</form>
</body>
</html>
