<!-- Created by Sami Al-Qusus March 17, 2018 -->
<!-- modified April 15, 2018 -->
<!-- create.php for CSCI370 Project-->
<?php
require('dbinfo.inc');
require_once('front.php');
$redirect= false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['sid'])){
        $sid =$_POST['sid'];
    }
    if (isset($_POST['tableNumber'])){
        $TableNumber = $_POST['tableNumber'];
    }
    
    if (isset($_POST['note'])){
	$note = $_POST['note'];
    }
   
    if (isset($_POST['Dish'])){
       $Dish =  $_POST['Dish'];
       $temp = $Dish;
       while ($temp > 0){
	    $dishName = "dish".$temp."n";
            if (isset($_POST[$dishName])){
		  $dishN[$temp] =  $_POST[$dishName];
	    }
	    $dishName = "dish".$temp."p";
	    if (isset($_POST[$dishName])){
		    $dishP[$temp] =  $_POST[$dishName];
	    }
	    $temp--;
       }
    }
    if (isset($_POST['Drink'])){
       $Drink =  $_POST['Drink']; 
       $temp = $Drink;
       while ($temp > 0){
	    $drinkName = "drink".$temp."n";
            if (isset($_POST[$drinkName])){
		    $drinkN[$temp]  =  $_POST[$drinkName];
	    }
	    $drinkName = "drink".$temp."p";
	    if (isset($_POST[$drinkName])){
		    $drinkP[$temp]  =  $_POST[$drinkName];
	    }
	    $temp--;
       }
   }
    $redirect = true;
}

if (!$redirect){//if form not submitted show form and ignore other php proccessing form 

?>

<h1>Create New Order</h1>
<div class="container">
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
  <div class="container">
    <label for="sid" ><b>Server ID</b></label></br>
    <input type="text" name="sid" value="" required>
  </div>
  <div class="container">
    <label for="tableNumber" ><b>tableNumber</b></label></br>
    <input type="number" name="tableNumber" value=0 required>
  </div>
  <div class="container" id="dishes"></div>
  <button type="button" class="btn btn-link" onclick="addDish()">add a Dish</button>
  <div class="container" id="drinks"></div>
  <button type="button" class="btn btn-link" onclick="addDrink()">add a Drink</button>
  <div class="container">
    <label for="note" ><b>note</b></label></br>
    <textarea name="note" style="width:400px; height:200px;"></textarea>
  </div>
  <input class="d-none" type="number" name="Drink" id="Drink" value=0>
  <input class="d-none" type="number" name="Dish" id="Dish" value=0>
<input class="btn btn-primary btn-lg"  type="submit" name="submit" value="Submit">
</form>
</div>

<script>
var Drink=0;
var Dish=0;
 function addDish() {
    Dish++;
    var d = document.getElementById('dishes');
    d.insertAdjacentHTML('beforeend',"<div id='dish"+Dish+"l'><label for='dishes'><b>Dish"+Dish+"</b></label></div>");
    d = document.getElementById('dishes');
    d.insertAdjacentHTML('beforeend',"<div id='dish"+Dish+"i'>Dish Name: <input type='text' name='dish"+Dish+"n' value=''>  Dish Price: <input type='text' name='dish"+Dish+"p' value=''><button class='btn btn-link' type='button' onclick='removeDish()'>remove dish</button></div>");
    document.getElementById("Dish").value = Dish;
 }

 function removeDish() {
    var element1 = document.getElementById("dish"+Dish+"l");
    var element2 = document.getElementById("dish"+Dish+"i");
    element1.parentNode.removeChild(element1);
    element2.parentNode.removeChild(element2);
    Dish--;
    document.getElementById("Dish").value = Dish;
    
 }

 function addDrink() {
    Drink++;
    var d = document.getElementById('drinks');
    d.insertAdjacentHTML('beforeend',"<div id='drink"+Drink+"l'><label  for='drinks'><b>Drink"+Drink+"</b></label></div>");
    d = document.getElementById('drinks');
    d.insertAdjacentHTML('beforeend',"<div id='drink"+Drink+"i'>Drink Name: <input type='text' name='drink"+Drink+"n' value=''>  Drink Price: <input type='text' name='drink"+Drink+"p' value=''><button class='btn btn-link' type='button' onclick='removeDrink()'>remove drink</button></div>");
    document.getElementById("Drink").value = Drink;
 }
 function removeDrink() {
    
    var element1 = document.getElementById("drink"+Drink+"l");
    var element2 = document.getElementById("drink"+Drink+"i");
    element1.parentNode.removeChild(element1);
    element2.parentNode.removeChild(element2);
    Drink--;
    document.getElementById("Drink").value = Drink;
   
 }


</script>

<?php
}else{//if form submitted do this
try {
    $dbh = new PDO("mysql:host=$host;dbname=$user", $user, $password);
    $sql = "INSERT INTO Orders (sid, TableNumber, note) VALUES (:sid,:TableNumber,:note)";
    $insertStmt = $dbh->prepare($sql);
    $insertStmt->bindParam(':sid', $sid);
    $insertStmt->bindParam(':TableNumber', $TableNumber);
    $insertStmt->bindParam(':note', $note);
    $insertStmt->execute();
    $num = $dbh->query('SELECT MAX(oid) as c from Orders');
    foreach ($num as $count){
	    $currID = $count['c'];
    }
    $temp = 0;
    while ($temp<$Dish){
	   $temp++;
	   $stmt2 = "INSERT INTO Dishes (dishNumber, oid, dishName, dishPrice) VALUES (:num, :currID, :dishName, :dishPrice)";
	   $insertStmt = $dbh->prepare($stmt2);
	   $insertStmt->bindParam(':currID', $currID);
	   $insertStmt->bindParam(':num', $temp);
	   $insertStmt->bindParam(':dishName', $dishN[$temp]);
	   $insertStmt->bindParam(':dishPrice', $dishP[$temp]);
	   $insertStmt->execute();
    }
    $temp = 0;
    while ($temp<$Drink){
           $temp++;
	   $stmt3 ="INSERT INTO Drinks (drinkNumber, oid, drinkName, drinkPrice) VALUES (:num, :currID, :drinkName, :drinkPrice)";
	   $insertStmt = $dbh->prepare($stmt3);
	   $insertStmt->bindParam(':currID', $currID);
	   $insertStmt->bindParam(':num', $temp);
	   $insertStmt->bindParam(':drinkName',$drinkN[$temp]);
	   $insertStmt->bindParam(':drinkPrice', $drinkP[$temp]);
	   $insertStmt->execute();
    }
}catch(PDOException $e){
	print "Error!" . $e->getMessage() . "<br/>";
	$redirect = false;
        
}


if($redirect){
	session_start();
	$message = 'Order is Created';
	header("location:index.php");
	$_SESSION['message']=$message;
	exit;

}
}//closing else

require_once('back.php');
?>
