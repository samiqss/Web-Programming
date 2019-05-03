<!-- Created by Sami Al-Qusus March 17, 2018 -->
<!-- modified March 18, 2018 -->
<!-- Lab9.php required for Lab9 -->
<?php
require('dbinfo.inc');
require_once('front.php');
$redirect= false;
$stat = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ideaName'])){
        $ideaName =$_POST['ideaName'];
    }
    if (isset($_POST['ideaDescription'])){
        $ideaDescription = $_POST['ideaDescription'];
    }
    if (isset($_POST['userName'])){
	$userName = $_POST['userName'];
    }
    if (isset($_POST['location'])){
        $location = $_POST['location'];
    }
    if (isset($_POST['email'])){
	$email = $_POST['email'];
    }
    if (isset($_POST['password'])){
	$ipassword = $_POST['password'];
    }
    if (isset($_POST['note'])){
	$note =  $_POST['note']; 
    }
 
    if (isset($_POST['Step'])){
       $Step =  $_POST['Step'];
       $temp = $Step;
       while ($temp > 0){
	    $stepName = "step".$temp;
            if (isset($_POST[$stepName])){
		  $stepDesc[$temp] =  $_POST[$stepName];
	    }
	    $temp--;
       }
    }
    if (isset($_POST['Wish'])){
       $Wish =  $_POST['Wish']; 
       $temp = $Wish;
       while ($temp > 0){
	    $wishName = "wish".$temp;
            if (isset($_POST[$wishName])){
		  $wishDesc[$temp]  =  $_POST[$wishName];
	    }
	    $temp--;
       }
   }
    $redirect = true;
}

if (!$redirect){//if form not submitted show form and ignore other php proccessing form 

?>

<h1>Create and Share your Idea</h1>
<div class="container">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
  <div class="container">
    <label for="ideaName" ><b>Idea name</b></label></br>
    <input type="text" name="ideaName" value="">
  </div>
  <div class="container">
    <label for="ideaDescription" ><b>Idea Description</b></label></br>
    <textarea name="ideaDescription" style="width:400px; height:200px;"></textarea>
  </div>
  <div class="container" id="steps"></div>
  <button type="button" class="btn btn-link" onclick="addStep()">add a step</button>
  <div class="container" id="wishes"></div>
  <button type="button" class="btn btn-link" onclick="addWish()">add a wish</button>
  <div class="container">
    <label for="userName" ><b>Owner name</b></label></br>
    <input type="text" name="userName" value="">
  </div>
  <div class="container">
    <label for="location" ><b>location</b></label></br>
    <input type="text" name="location" value="">
  </div>
  <div class="container">
    <label for="email" ><b>email</b></label></br>
    <input type="email" name="email" value="">
  </div>
  <div class="container">
    <label for="password" ><b>password</b></label></br>
    <input type="password" name="password" value="">
  </div>
  <div class="container">
    <label for="note" ><b>note</b></label></br>
    <textarea name="note" style="width:400px; height:200px;"></textarea>
  </div>
  <input class="d-none" type="number" name="Wish" id="Wish" value=0>
  <input class="d-none" type="number" name="Step" id="Step" value=0>
<input class="btn btn-primary btn-lg"  type="submit" name="submit" value="Submit">
</form>
</div>

<script>
var Step=0;
var Wish=0;
 function addStep() {
    Step++;
    var d = document.getElementById('steps');
    d.insertAdjacentHTML('beforeend',"<div id='step"+Step+"l'><label for='steps'><b>Step"+Step+"</b></label></div>");
    d = document.getElementById('steps');
    d.insertAdjacentHTML('beforeend',"<div id='step"+Step+"i'><input type='text' name='step"+Step+"' value=''><button class='btn btn-link' type='button' onclick='removeStep()'>remove step</button></div>");

    document.getElementById("Step").value = Step;
 }

 function removeStep() {
    var element1 = document.getElementById("step"+Step+"l");
    var element2 = document.getElementById("step"+Step+"i");
    element1.parentNode.removeChild(element1);
    element2.parentNode.removeChild(element2);
    Step--;
    document.getElementById("Step").value = Step;
    
 }

 function addWish() {
    Wish++;
    var d = document.getElementById('wishes');
    d.insertAdjacentHTML('beforeend',"<div id='wish"+Wish+"l'><label  for='wishes'><b>Wish"+Wish+"</b></label></div>");
    d = document.getElementById('wishes');
    d.insertAdjacentHTML('beforeend',"<div id='wish"+Wish+"i'><input type='text' name='wish"+Wish+"' value=''><button class='btn btn-link' type='button' onclick='removeWish()'>remove wish</button></div>");
    document.getElementById("Wish").value = Wish;
 }
 function removeWish() {
    
    var element1 = document.getElementById("wish"+Wish+"l");
    var element2 = document.getElementById("wish"+Wish+"i");
    element1.parentNode.removeChild(element1);
    element2.parentNode.removeChild(element2);
    Wish--;
    document.getElementById("Wish").value = Wish;
   
 }


</script>

<?php
}else{//if form submitted do this
try {
    $dbh = new PDO("mysql:host=$host;dbname=$user", $user, $password);
    $sql = "INSERT INTO Ideas (iname, description, password, note, status) VALUES (:ideaName,:ideaDescription,:ipassword,:note, :stat)";
    $insertStmt = $dbh->prepare($sql);
    $insertStmt->bindParam(':ideaName', $ideaName);
    $insertStmt->bindParam(':ideaDescription', $ideaDescription);
    $insertStmt->bindParam(':ipassword', $ipassword);
    $insertStmt->bindParam(':note', $note);
    $insertStmt->bindParam(':stat', $stat);
    $insertStmt->execute();
    $num = $dbh->query('SELECT COUNT(iname) as c from Ideas');
    foreach ($num as $count){
	    $currID = $count['c'];
    }
    $stmt2 = "INSERT INTO Users (ideaID, name, location, email) VALUES (:currID,:userName,:location,:email)";
    $insertStmt = $dbh->prepare($stmt2);
    $insertStmt->bindParam(':currID', $currID);
    $insertStmt->bindParam(':userName', $userName);
    $insertStmt->bindParam(':location', $location);
    $insertStmt->bindParam(':email', $email);
    $insertStmt->execute();
    $temp = 0;
    while ($temp<$Step){
	   $temp++;
	   $stmt3 = "INSERT INTO Steps (ideaID, Snumber, Sdescription, Sstatus) VALUES (:currID,:num, :stepDes, :stat)";
	   $insertStmt = $dbh->prepare($stmt3);
	   $insertStmt->bindParam(':currID', $currID);
	   $insertStmt->bindParam(':num', $temp);
	   $insertStmt->bindParam(':stepDes', $stepDesc[$temp]);
	   $insertStmt->bindParam(':stat', $stat);
	   $insertStmt->execute();
    }
    $temp = 0;
    while ($temp<$Wish){
           $temp++;
	   $stmt3 ="INSERT INTO Wishes (ideaID, Wnumber, Wdescription, Wstatus) VALUES (:currID,:num, :wishDes, :stat)";
	   $insertStmt = $dbh->prepare($stmt3);
	   $insertStmt->bindParam(':currID', $currID);
	   $insertStmt->bindParam(':num', $temp);
	   $insertStmt->bindParam(':wishDes',$wishDesc[$temp]);
	   $insertStmt->bindParam(':stat', $stat);
	   $insertStmt->execute();
    }
}catch(PDOException $e){
	print "Error!" . $e->getMessage() . "<br/>";
	$redirect = false;
        
}


if($redirect){
	session_start();
	$message = 'Thank you for sharing your idea! Its now out there..';
	header("location:index.php");
	$_SESSION['message']=$message;
	exit;

}
}//closing else

require_once('back.php');
?>
