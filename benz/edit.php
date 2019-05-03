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
			$Stat = "sstat".$temp;
		    if (isset($_POST[$stepName])){
		         $stepDesc[$temp] =  $_POST[$stepName];
		    }
		    if (isset($_POST[$Stat])){
		    	$stepStat[$temp] = 1;
		    }else{
			$stepStat[$temp] = 0;
		    }
	            $temp--;
                 } 
         }
         if (isset($_POST['Wish'])){
	         $Wish =  $_POST['Wish']; 
		 $temp = $Wish;
		 while ($temp > 0){
			 $wishName = "wish".$temp;
			 $Stat = "wstat".$temp;
		     if (isset($_POST[$wishName])){
			  $wishDesc[$temp]  =  $_POST[$wishName];
		     }
		     if (isset($_POST[$Stat])){
			 $wishStat[$temp] = 1;
                     }else{
			 $wishStat[$temp] =0;
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
    $result =$dbh->query("SELECT * from Ideas I, Users U where U.ideaID=I.ideaID and I.ideaID= $id");
?>    
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<?php
    $countStep=0;
    $countWish=0;
    foreach ($result as $row){
      $iname = $row['iname'];
      $userName = $row['name'];
      $location = $row['location'];
      $email = $row['email'];
      $desc = $row['description'];
      $password = $row['password'];
      $note = $row['note'];
?>
      <div class="container">
	 <div class="row">
         <div class="col">
	  <label for="ideaName" ><b>Idea name</b></label></br>
	   <input type="text" name="ideaName" value="<?php echo $iname;?>"><br><br>
	  <label for="ideaDescription" ><b>Idea Description</b></label></br>
	  <textarea name="ideaDescription" style="width:400px; height:200px;"><?php echo $desc; ?></textarea>
<?php
    }
      echo "<div class='container'>check the steps and wishes that have been completed:</div>";
      echo "<div class='container' id='wishes'>";
      $stmt =$dbh->query("SELECT * from Ideas I, Wishes W where W.ideaID=I.ideaID and I.ideaID= $id");
      foreach ($stmt as $stmtRow){
	      $countWish++;
	      $Wnumber = $stmtRow['Wnumber'];
	      $Wdesc = $stmtRow['Wdescription'];
	      $Wstatus =$stmtRow['Wstatus'];
	      $check='';
	      if ($Wstatus==1){
		      $check='checked';
	      }
	      echo "<div id='wish".$Wnumber."l'><label  for='wishes'><b>Wish".$Wnumber."</b></label></div>";
	      echo "<div id='wish".$Wnumber."i'><input type='text' name='wish".$Wnumber."' value='".$Wdesc."'><input type='checkbox' name='wstat".$Wnumber."' value=".$Wstatus." ".$check."></div>";
             }
      echo "</div>";
 
      echo "<div class='container' id='steps'>";
      $stmt =$dbh->query("SELECT * from Ideas I, Steps S where S.ideaID=I.ideaID and I.ideaID= $id");
      foreach ($stmt as $stmtRow){
              $countStep++;
              $Snumber = $stmtRow['Snumber'];
	      $Sdesc = $stmtRow['Sdescription'];
	      $Sstatus =$stmtRow['Sstatus'];
	      $check='';
	      if ($Sstatus==1){
		      $check='checked';
	      }
	      echo "<div id='step".$Snumber."l'><label for='steps'><b>Step".$Snumber."</b></label></div>";
	      echo "<div id='step".$Snumber."i'><input type='text' name='step".$Snumber."' value='".$Sdesc."'><input type='checkbox' name='sstat".$Snumber."' value=".$Sstatus." ".$check."></div>";
      }
      
       echo "</div>";
?>
	<label for="note" ><b>Note</b></label></br>
        <textarea name="note" style="width:400px; height:200px;"><?php echo $note;?></textarea>
         </div>
	 <div class="col">
          <h4> contact info</h4>
	  <p><b>name:</b> <input type="text" name="userName" value="<?php echo $userName;?>"> </p>
	  <p><b>location:</b> <input type="text" name="location" value="<?php echo $location;?>"></p>
	  <p><b>email:</b> <input type="email" name="email" value="<?php echo $email;?>"></p>
         </div>
         </div>
     </div>
     <input class="d-none" type="number" name="Wish" id="Wish" value='<?php echo $countWish ?>'>
     <input class="d-none" type="number" name="Step" id="Step" value='<?php echo $countStep ?>'>
     <input  type="password" name="password" id="password" value='<?php echo $password ?>'>
     <input class="d-none" type="number" name="id" id="id" value='<?php echo $id ?>'>
     <input class="btn btn-primary btn-lg"  type="submit" name="submit" value="Submit Changes">
</form>
<?php
}catch(PDOException $e){
	print "Error!" . $e->getMessage() . "<br/>";
        
}

}else{

try {
     $dbh = new PDO("mysql:host=$host;dbname=$user", $user, $password);
     $updateSQL="UPDATE Ideas SET iname=:ideaName, description=:ideaDescription, password=:ipassword, note=:note, status=:stat WHERE ideaID = :id";
     $insertStmt = $dbh->prepare($updateSQL);
     $insertStmt->bindParam(':id' , $id); 
     $insertStmt->bindParam(':ideaName', $ideaName);
     $insertStmt->bindParam(':ideaDescription', $ideaDescription);
     $insertStmt->bindParam(':ipassword', $ipassword);
     $insertStmt->bindParam(':note', $note);
     $insertStmt->bindParam(':stat', $stat);
     $insertStmt->execute();

     $updateSQL="UPDATE Users SET name=:userName, location=:location,email=:email WHERE ideaID = :id";
     $insertStmt = $dbh->prepare($updateSQL);
     $insertStmt->bindParam(':id', $id);
     $insertStmt->bindParam(':userName', $userName);
     $insertStmt->bindParam(':location', $location);
     $insertStmt->bindParam(':email', $email);
     $insertStmt->execute();
     
     $temp = 0;
     while ($temp<$Step){
	    $temp++;
	    $updateSQL="UPDATE Steps SET Sdescription=:stepDes, Sstatus=:stat WHERE ideaID = :id and Snumber=:num";
	    $insertStmt = $dbh->prepare($updateSQL);
	    $insertStmt->bindParam(':id', $id);
	    $insertStmt->bindParam(':num', $temp);
	    $insertStmt->bindParam(':stepDes', $stepDesc[$temp]);
	    $insertStmt->bindParam(':stat', $stepStat[$temp]);
	    echo $stepDesc[$temp]." ";
	    $insertStmt->execute();
     }

    $temp = 0;
    while ($temp<$Wish){
	    $temp++;
	    $updateSQL="UPDATE Wishes SET Wdescription=:wishDes, Wstatus=:stat WHERE ideaID = :id and Wnumber=:num";
	    $insertStmt = $dbh->prepare($updateSQL);
	    $insertStmt->bindParam(':id', $id);
	    $insertStmt->bindParam(':num', $temp);
	    $insertStmt->bindParam(':wishDes', $wishDesc[$temp]);
	    $insertStmt->bindParam(':stat', $wishStat[$temp]);
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
 
}
require_once('back.php');
?>

