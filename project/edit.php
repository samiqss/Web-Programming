<!-- Created by Sami Al-Qusus March 17, 2018 -->
<!-- modified April 15, 2018 -->
<!-- edit.php for CSCI370 Project -->

<?php
require('dbinfo.inc');
require_once('front.php');

$redirect= false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['sid'])){
	       $sid =$_POST['sid'];
	}
        if (isset($_POST['tableNumber'])){
	        $tableNumber = $_POST['tableNumber'];
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
	 if (isset($_POST['id'])) {
		 $id = $_POST['id'];
	 }
}

if (!$redirect){
	
   if (isset($_GET['id'])) {
  	$id = $_GET['id'];
   }

try {
    
    $dbh = new PDO("mysql:host=$host;dbname=$user", $user, $password);
    $result =$dbh->query("SELECT * from Orders O where O.oid= $id");
?>    
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<?php
    $countDish=0;
    $countDrink=0;
    foreach ($result as $row){
      $sid = $row['sid'];
      $note = $row['note'];
      $tableNumber=$row['tableNumber'];
?>
      <div class="container">
	  <label for="sid"><b>sid</b></label></br>
	   <input type="text" name="sid" value="<?php echo $sid;?>"><br><br>
	   <label for="tableNumber"><b>Table number</b></label></br>
           <input type="text" name="tableNumber" value="<?php echo $tableNumber;?>"><br><br>
      </div>

<?php
    }
      echo "<div class='container' id='dishes'>";
      $stmt =$dbh->query("SELECT * from Dishes D where D.oid= $id");
      foreach ($stmt as $stmtRow){
	      $countDish++;
	      $dishNumber= $stmtRow['dishNumber'];
	      $dishName= $stmtRow['dishName'];
	      $dishPrice= $stmtRow['dishPrice'];
	     
	      echo "<div id='dish".$dishNumber."l'><label for='dishes'><b>Dish".$dishNumber."</b></label></div>";
	      echo "<div id='dish".$dishNumber."i'>Dish Name: <input type='text' name='dish".$dishNumber."n' value='".$dishName."'>  Dish Price: <input type='text' name='dish".$dishNumber."p' value='".$dishPrice."'><button class='btn btn-link' type='button' onclick='removeDish()'>remove dish</button></div>";
	     
             }
      echo "</div>";
 
      echo "<div class='container' id='drinks'>";
      $stmt =$dbh->query("SELECT * from Drinks D where D.oid= $id");
      foreach ($stmt as $stmtRow){
              $countDrink++;
	      $drinkNumber= $stmtRow['drinkNumber'];
	      $drinkName= $stmtRow['drinkName'];
	      $drinkPrice= $stmtRow['drinkPrice'];
	      echo "<div id='drink".$drinkNumber."l'><label  for='drinks'><b>Drink".$drinkNumber."</b></label></div>";
	      echo "<div id='drink".$drinkNumber."i'>Drink Name: <input type='text' name='drink".$drinkNumber."n' value='".$drinkName."'>  Drink Price: <input type='text' name='drink".$drinkNumber."p' value='".$drinkPrice."'><button class='btn btn-link' type='button' onclick='removeDrink()'>remove drink</button></div>";
      }
       echo "</div>";
?>
	<label for="note" ><b>Note</b></label></br>
        <textarea name="note" style="width:400px; height:200px;"><?php echo $note;?></textarea>
     
     <input class="d-none" type="number" name="Drink" id="Drink" value=<?php echo $countDrink; ?>>
     <input class="d-none" type="number" name="Dish" id="Dish" value=<?php echo $countDish; ?>>
     <input class="d-none" type="number" name="id" id="id" value=<?php echo $id; ?>>
     <input class="btn btn-primary btn-lg"  type="submit" name="submit" value="Submit Changes">
</div>
</form>

<?php
}catch(PDOException $e){
	print "Error!" . $e->getMessage() . "<br/>";
        
}

}else{

try {
     $dbh = new PDO("mysql:host=$host;dbname=$user", $user, $password);
     $updateSQL = "UPDATE ORDERS SET sid=:sid,TableNumber=:TableNumber,note=:note WHERE oid = :id";
     $insertStmt = $dbh->prepare($updateSQL);
     $insertStmt->bindParam(':id', $id);   
     $insertStmt->bindParam(':note', $note);
     $insertStmt->bindParam(':TableNumber', $TableNumber);
     $insertStmt->bindParam(':sid', $sid);
     $insertStmt->execute();
     
     $temp = 0;
     while ($temp<$Dish){
	    $temp++;
	    $updateSQL="UPDATE Dishes SET dishName= :dishName, dishPrice= :dishPrice WHERE dishNumber=:num and oid=:id";
	    $insertStmt = $dbh->prepare($updateSQL);
	    $insertStmt->bindParam(':id', $id);
	    $insertStmt->bindParam(':num', $temp);
	    $insertStmt->bindParam(':dishName',$dishN[$temp]);
	    $insertStmt->bindParam(':dishPrice', $dishP[$temp]);
	    $insertStmt->execute();
     }

    $temp = 0;
    while ($temp<$Drink){
	    $temp++;
	    $updateSQL ="UPDATE Drinks SET drinkName= :drinkName, drinkPrice= :drinkPrice WHERE drinkNumber=:num and oid=:id";
	    $insertStmt = $dbh->prepare($updateSQL);
	    $insertStmt->bindParam(':id', $id);
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
	$message = 'Changes successful';
	header("location:index.php");
	$_SESSION['message']=$message;
	exit;

}
 
}
require_once('back.php');
?>

