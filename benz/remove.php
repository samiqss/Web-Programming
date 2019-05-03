<!-- Created by Sami Al-Qusus March 17, 2018 -->
<!-- modified March 18, 2018 -->
<!-- Lab9.php required for Lab9 -->

<?php
require('dbinfo.inc');
require_once('front.php');

$redirect= false;
$stat = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['password'])){
	    	$ipassword = $_POST['password'];
	}
	if (isset($_POST['testPassword'])){
		$testPassword = $_POST['testPassword'];
	}
 
        if (isset($_POST['Step'])){
                $Step =  $_POST['Step'];
         }
         if (isset($_POST['Wish'])){
	         $Wish =  $_POST['Wish']; 
	 }
	 if ($testPassword==$ipassword){
		 $redirect = true;
	 }else
	 {
	     echo "try again wrong passwprd";
	 }
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
    $result =$dbh->query("SELECT * from Ideas I, Users U where U.ideaID=I.ideaID and I.ideaID= $id");
?>    
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<?php
    $countStep=0;
    $countWish=0;
    foreach ($result as $row){
      $password = $row['password'];
?>
      <div class="container">
<?php
      $stmt =$dbh->query("SELECT * from Ideas I, Wishes W where W.ideaID=I.ideaID and I.ideaID= $id");
      foreach ($stmt as $stmtRow){
	      $countWish++;
	      }
      $stmt =$dbh->query("SELECT * from Ideas I, Steps S where S.ideaID=I.ideaID and I.ideaID= $id");
      foreach ($stmt as $stmtRow){
              $countStep++;
              }
    }
?>
     <p><b>Enter your password to remove the idea: </b><input type="password" name="testPassword" value=""></p>
     
     <input class="d-none" type="number" name="Wish" id="Wish" value='<?php echo $countWish ?>'>
     <input class="d-none" type="number" name="Step" id="Step" value='<?php echo $countStep ?>'>
     <input class="d-none" type="password" name="password" id="password" value='<?php echo $password ?>'>
     <input class="d-none" type="number" name="id" id="id" value='<?php echo $id ?>'>
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
     $updateSQL="DELETE FROM Ideas WHERE ideaID = :id";
     $insertStmt = $dbh->prepare($updateSQL);
     $insertStmt->bindParam(':id' , $id); 
     $insertStmt->execute();

     $updateSQL="DELETE FROM Users WHERE ideaID = :id";
     $insertStmt = $dbh->prepare($updateSQL);
     $insertStmt->bindParam(':id', $id);
     $insertStmt->execute();
     
     $temp = 0;
     while ($temp<$Step){
	    $temp++;
	    $updateSQL="DELETE FROM Steps WHERE ideaID = :id and Snumber=:num";
	    $insertStmt = $dbh->prepare($updateSQL);
	    $insertStmt->bindParam(':id', $id);
	    $insertStmt->bindParam(':num', $temp);
	    $insertStmt->execute();
     }

    $temp = 0;
    while ($temp<$Wish){
	    $temp++;
	    $updateSQL="DELETE FROM Wishes WHERE ideaID = :id and Wnumber=:num";
	    $insertStmt = $dbh->prepare($updateSQL);
	    $insertStmt->bindParam(':id', $id);
	    $insertStmt->bindParam(':num', $temp);
	    $insertStmt->execute();
    }
}catch(PDOException $e){
	print "Error!" . $e->getMessage() . "<br/>";
	$redirect = false;
        
}


if($redirect){
	session_start();
	$message = 'Your idea has been removed!';
	header("location:index.php");
	$_SESSION['message']=$message;
	exit;

}
 
}
require_once('back.php');
?>

