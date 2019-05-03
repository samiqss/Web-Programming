<!-- Created by Sami Al-Qusus March 17, 2018 -->
<!-- modified March 18, 2018 -->
<!-- Lab9.php required for Lab9 -->

<?php
require('dbinfo.inc');
require_once('front.php');
require_once('submitEdit.php');

if (isset($_GET['id'])) {
	        $id = $_GET['id'];
}

try {
    
    $dbh = new PDO("mysql:host=$host;dbname=$user", $user, $password);
    $result =$dbh->query("SELECT * from Ideas I, Users U where U.ideaID=I.ideaID and I.ideaID= $id");
?>    
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<?php
    foreach ($result as $row){
      $iname = $row['iname'];
      $userName = $row['name'];
      $location = $row['location'];
      $email = $row['email'];
      $desc = $row['description'];
  //    $id = $row['ideaID'];
      $note = $row['note'];
?>
      <div class="container">
	 <div class="row">
         <div class="col">
	  <label for="ideaName" ><b>Idea name</b></label></br>
	   <input type="text" name="ideaName" value="<?php echo $iname;?>"><br><br>
	  <label for="ideaDescription" ><b>Idea Description</b></label></br>
	  <textarea name="ideaDescription" style="width:400px; height:200px;"><?php echo $desc ?></textarea>
<?php
      echo "<div class='container' id='wishes'>";
      $stmt =$dbh->query("SELECT * from Ideas I, Wishes W where W.ideaID=I.ideaID and I.ideaID= $id");
      foreach ($stmt as $stmtRow){
	      $Wnumber = $stmtRow['Wnumber'];
	      $Wdesc = $stmtRow['Wdescription'];
	      $Wstatus =$stmtRow['Wstatus'];
	      echo "<div id='wish".$Wnumber."l'><label  for='wishes'><b>Wish".$Wnumber."</b></label></div>";
	      echo "<div id='wish".$Wnumber."i'><input type='text' name='wish".$Wnumber."' value='".$Wdesc."'><button class='btn btn-link' type='button' onclick='removeWish()'>remove wish</button></div>";
             }
      echo "</div>";
 
      echo "<div class='container' id='steps'>";
      $stmt =$dbh->query("SELECT * from Ideas I, Steps S where S.ideaID=I.ideaID and I.ideaID= $id");
      foreach ($stmt as $stmtRow){
              $Snumber = $stmtRow['Snumber'];
	      $Sdesc = $stmtRow['Sdescription'];
	      $Sstatus =$stmtRow['Sstatus'];
	      echo "<div id='step".$Snumber."l'><label for='steps'><b>Step".$Snumber."</b></label></div>";
	      echo "<div id='step".$Snumber."i'><input type='text' name='step".$Snumber."' value='".$Sdesc."'><button class='btn btn-link' type='button' onclick='removeStep()'>remove step</button></div>";
      }
       echo "</div>";
?>
	<label for="note" ><b>Note</b></label></br>
        <textarea name="note" style="width:400px; height:200px;"><?php echo $note ?></textarea>
         </div>
	 <div class="col">
          <h4> contact info</h4>
	  <p><b>name:</b> <input type="text" name="userName" value="<?php echo $userName;?>"> </p>
	  <p><b>location:</b> <input type="text" name="location" value="<?php echo $location;?>"></p>
	  <p><b>email:</b> <input type="email" name="email" value="<?php echo $email;?>"></p>
         </div>
         </div>
     </div>
     <input class="d-none" type="number" name="Wish" id="Wish" value=0>
     <input class="d-none" type="number" name="Step" id="Step" value=0>
     <input class="btn btn-primary btn-lg"  type="submit" name="submit" value="Submit Changes">
</form>
<?php
    }
}catch(PDOException $e){
	print "Error!" . $e->getMessage() . "<br/>";
        
}
require_once('back.php');
?>

