<!-- Created by Sami Al-Qusus March 17, 2018 -->
<!-- modified March 18, 2018 -->
<!-- Lab9.php required for Lab9 -->
<?php
require('dbinfo.inc');
require_once('front.php');

if (isset($_GET['id'])) {
	        $id = $_GET['id'];
}

try {
    
    $dbh = new PDO("mysql:host=$host;dbname=$user", $user, $password);
    $result =$dbh->query("SELECT * from Ideas I, Users U where U.ideaID=I.ideaID and I.ideaID= $id");
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
	  <h2> <?php echo $iname;?></h2>
          <b>Description</b>
	  <p><?php echo $desc ?></p>
<?php
      echo "<div class='container'>";
      echo "<table class='table table-bordered'>";
       echo "<thead><tr>";
          echo "<th>Wish List</th>";
          echo "<th>Status</th>";
	  echo "</tr></thead>";
	  echo "<tbody>";
      $stmt =$dbh->query("SELECT * from Ideas I, Wishes W where W.ideaID=I.ideaID and I.ideaID= $id");
      foreach ($stmt as $stmtRow){
	      $Wnumber = $stmtRow['Wnumber'];
	      $Wdesc = $stmtRow['Wdescription'];
	      $Wstatus =$stmtRow['Wstatus'];
              echo "<tr>"; 	      
	      if($Wstatus==0){
		  echo "<td><b>".$Wnumber.".</b>".$Wdesc."</td>";
		  echo "<td class='text-warning'>To do</td>";
	      }
	    
	      if($Wstatus==1){
		  echo "<td><b>".$Wnumber.".</b>".$Wdesc."</td>";
		  echo "<td class='text-success'>Done</td>";
	      }
      }
      echo "</tbody>";
      echo "</table>";
      echo "</div>";

 
      echo "<div class='container'>";
      echo "<table class='table table-bordered'>";
      echo "<thead><tr>";
      echo "<th>Steps</th>";
      echo "<th>Status</th>";
      echo "</tr></thead>";
      echo "<tbody>";
      $stmt =$dbh->query("SELECT * from Ideas I, Steps S where S.ideaID=I.ideaID and I.ideaID= $id");
      foreach ($stmt as $stmtRow){
              $Snumber = $stmtRow['Snumber'];
	      $Sdesc = $stmtRow['Sdescription'];
	      $Sstatus =$stmtRow['Sstatus'];
	      echo "<tr>";
	   
	      if($Sstatus==0){
		      echo "<td><b>".$Snumber.".</b>".$Sdesc."</td>";
		      echo "<td class='text-warning'>To do</td>";
	      }
              
	      if($Sstatus==1){		      
		      echo "<td><b>".$Snumber.".</b>".$Sdesc."</td>";
		      echo "<td class='text-success'>Done</td>";
      }
      
      }
      echo "</tbody>";
      echo "</table>";
      echo "</div>";
?>
          <b>Note</b>
          <p><?php echo $note ?></p>
         </div>
	 <div class="col">
          <h4> contact info</h4>
	  <p><b>name:</b> <?php echo $userName;?> </p>
	  <p><b>location:</b> <?php echo $location;?></p>
	  <p><b>email:</b> <?php echo $email;?></p>
           <a href="edit.php?id= <?php echo $id;?>">Edit</a><br>
       <!--   <a href="checkpassForEdit.php?id= <?//php echo $id;?>">Edit</a><br>  remove abouve line and uncomment this and inside phpp //  if want edit page pass-->
          <a href="remove.php?id=<?php echo $id;?>">Remove</a>
         </div>
         </div>
     </div>
<?php
    }
}catch(PDOException $e){
	print "Error!" . $e->getMessage() . "<br/>";
        
}

require_once('back.php');
?>
