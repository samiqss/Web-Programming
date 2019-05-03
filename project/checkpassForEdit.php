<!-- Created by Sami Al-Qusus March 17, 2018 -->
<!-- modified March 18, 2018 -->
<!-- checkpassForEdit.php for CSCI370 -->

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
	 if ($testPassword==$ipassword){
		 $redirect = true;
	 }else
	 {
		 echo "try again wrong password";
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
    $result =$dbh->query("SELECT * from Orders O, Branch B where B.bid=O.bid and O.oid= $id");
?>    
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<?php
    foreach ($result as $row){
	    $password = $row['password'];
    }
?>
     <div class="container">
     <p><b>Enter your password to make changes to Order: </b><input type="password" name="testPassword" value=""></p>
     <input class="d-none" type="password" name="password" id="password" value='<?php echo $password; ?>'>
     <input class="d-none" type="number" name="id" id="id" value=<?php echo $id; ?>>
     <input class="btn btn-primary btn-lg"  type="submit" name="submit" value="Submit Changes">
     </div>
</form>
<?php
}catch(PDOException $e){
	print "Error!" . $e->getMessage() . "<br/>";
        
}

}else{


if($redirect){
	
	header("location:edit.php?id=$id");
	exit;

}
 
}
require_once('back.php');
?>

