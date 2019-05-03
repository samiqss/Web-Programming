<!-- Created by Sami Al-Qusus -->
<!-- Originally created by Sami Al-Qusus February 19, 2018 -->
<!-- modified February 26, 2018 -->
<!-- Lab6.php required for Lab6 -->
<?php
session_start();
if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
	exit;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta charset="utf-8"/>
<title>form lab6</title>
<style>
   body {background-color: powderblue;}
</style>
</head>
<body>
<div>
<h1 style="text-align:center;";>Lab6 Form</h1>
<p>Please fill in the form below:</p>
<form action="processForm.php" method="post">
  <div>
  <label for="name" >Name</label>
  <input id="name" type="text" placeholder="you name" name="name"/>
  </div>
  <div>
  <label for="color1" >Background color</label>
  <input id="color1" type="text" placeholder="color" name="color1"/>
  </div>
  <div>
  <label for="color2" >Font color</label>
  <input id="color2" type="text" placeholder="color" name="color2"/>
  </div>
  <div>
  <label for="animal" >favourite animal</label>
  <input id="animal" type="text" placeholder="animal" name="animal"/>
  </div>
  <div>
  <label for="font" >font</label>
  <select id="font" name="font">
    <option value="Arial">Arial</option>
    <option value="Helvetica">Helvetica</option>
    <option value="Times New Roman">Times New Roman</option>
    <option value="Courier New">Courier New</option>
  </select>
  </div>
  <div>
  <label for="country" >select one or more countries you would like to visit:</label><br>
   <input type="checkbox" name="country[]" value="Morocco">Morocco<br>
   <input type="checkbox" name="country[]" value="Japan">Japan<br>
   <input type="checkbox" name="country[]" value="Ireland">Ireland<br>
   <input type="checkbox" name="country[]" value="Portugal">Portugal<br>
   <input type="checkbox" name="country[]" value="Mexico">Mexico<br>
   <input type="checkbox" name="country[]" value="Netherland">Netherlands<br>
   <input type="checkbox" name="country[]" value="Sri Lanka">Sri Lanka<br>
   <input type="checkbox" name="country[]" value="Vietnam">Vietnam<br>
   <input type="checkbox" name="country[]" value="South Africa">South Africa<br>
   <input type="checkbox" name="country[]" value="India">India<br>
   <input type="checkbox" name="country[]" value="Thailand">Thailand<br>
   <input type="checkbox" name="country[]" value="New Zealand">New Zealand<br>
   <input type="checkbox" name="country[]" value="Australia">Australia<br>
   <input type="checkbox" name="country[]" value="Greece">Greece<br>
   <input type="checkbox" name="country[]" value="Spain">Spain<br>
   <input type="checkbox" name="country[]" value="France">France<br>
   <input type="checkbox" name="country[]" value="Italy">Italy<br>
  </div>
  <input type="submit" value="Submit">
</form> 
</div>
<footer style="text-align:center;">
   <small>Copyright &copy;2018 Sami Al-Qusus</small>
</footer>
</body>
</html>
