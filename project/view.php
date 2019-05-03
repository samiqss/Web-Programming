<!-- Created by Sami Al-Qusus March 17, 2018 -->
<!-- modified March 18, 2018 -->
<!-- view.php for CSCI370 Project -->
<?php
require('dbinfo.inc');
require_once('front.php');

if (isset($_GET['id'])) {
	        $id = $_GET['id'];
}

try {
    
    $dbh = new PDO("mysql:host=$host;dbname=$user", $user, $password);
    $result =$dbh->query("SELECT * from Orders O, Server S, Branch B where S.sid=O.sid and B.bid=O.bid and O.oid= $id");
    foreach ($result as $row){
      $sname = $row['sname'];
      $bname = $row['bname'];
      $phone = $row['phone'];
      $bid = $row['bid'];
      $location = $row['address'];
      $tableNumber= $row['tableNumber'];
      $orderDate = $row['orderDate'];
      $note = $row['note'];
?>
      <div class="container">
	 <div class="row">
         <div class="col">
	  <h2> Order: <?php echo $id ?></h2>
          <p><b>Date:</b><?php echo $orderDate;?></p>
          <p><b>Table #</b><?php echo $tableNumber;?></p>
	  <p><b>Branch #</b><?php echo $bid;?></b> <?php echo $bname;?></p>
          <p><b>Phone: </b><?php echo $phone;?></p>
          <p><b>Address: </b><?php echo $location;?></p>
	  <p><b>Server: </b><?php echo $sname;?></p>
          <p><b>Note/Allergies: </b><?php echo $note;?></p>
<?php
      echo "<div class='container'>";
      echo "<table class='table table-bordered'>";
       echo "<thead><tr>";
          echo "<th>Dish List</th>";
          echo "<th>Price</th>";
	  echo "</tr></thead>";
	  echo "<tbody>";
      $stmt =$dbh->query("SELECT * from Dishes D where D.oid= $id");
      foreach ($stmt as $stmtRow){
	      $dishNumber = $stmtRow['dishNumber'];
	      $dishName = $stmtRow['dishName'];
	      $dishPrice =$stmtRow['dishPrice'];
              echo "<tr>"; 	      
	      echo "<td><b>".$dishNumber.".</b>".$dishName."</td>";
              echo "<td>$dishPrice</td>";
      }
      echo "</tbody>";
      echo "</table>";
      echo "</div>";
 
      echo "<div class='container'>";
      echo "<table class='table table-bordered'>";
      echo "<thead><tr>";
      echo "<th>Drinks</th>";
      echo "<th>Price</th>";
      echo "</tr></thead>";
      echo "<tbody>";
      $stmt =$dbh->query("SELECT * from Drinks D where D.oid= $id");
      foreach ($stmt as $stmtRow){
              $drinkNumber = $stmtRow['drinkNumber'];
	      $drinkName = $stmtRow['drinkName'];
	      $drinkPrice =$stmtRow['drinkPrice'];
	      echo "<tr>";
	      echo "<td><b>".$drinkNumber.".</b>".$drinkName."</td>";
	      echo "<td>$drinkPrice</td>";
      }
      echo "</tbody>";
      echo "</table>";
      $result =$dbh->query("SELECT SUM(dishPrice) as dishTotal from Dishes D where D.oid= $id");
      foreach ($result as $row){
	      $dishTot = $row['dishTotal'];
      }
      $result =$dbh->query("SELECT SUM(drinkPrice) as drinkTotal from Drinks D where D.oid= $id");
      foreach ($result as $row){
	      $drinkTot = $row['drinkTotal'];
      }
      $SUBTOTAL=number_format(($dishTot + $drinkTot), 2, '.', '');
      $GST= number_format(($SUBTOTAL*5/100), 2, '.', '');
      $TOTAL= number_format(($GST + $SUBTOTAL), 2, '.', '');
      
      echo "<p><b>SUBTOTAL </b>$SUBTOTAL</p>";
      echo "<p><b>GST (5%) </b>$GST</p>";
      echo "<h2>TOTAL      $TOTAL</h2>";
      echo "</div>";
?>
         </div>
	 <div class="col">
           <a href="checkpassForEdit.php?id= <?php echo $id;?>">Edit</a><br>
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
