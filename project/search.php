<!-- Created by Sami Al-Qusus March 17, 2018 -->
<!-- modified April 15, 2018 -->
<!-- search,php for CSCI370 Project -->
<?php
require('dbinfo.inc');
require_once('front.php');
?>

<h2>Orders</h2>

<?php

if (isset($_POST['search'])) {
       $search = $_POST['search'];
}

if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}
$perpage = 5;

$curr = ($page-1)*$perpage;

try {
    
    $dbh = new PDO("mysql:host=$host;dbname=$user", $user, $password);
    $result =$dbh->query("SELECT * from Orders where oid=$search LIMIT $curr, $perpage");
    $num = $dbh->query("SELECT COUNT(oid) as c from Orders where oid=$search");
    foreach ($num as $count){
    $max_pages = ceil($count['c'] / $perpage);}
    echo "<div>".$count['c']." result(s) found for <b>".$search."</b></div>";
    foreach ($result as $row){ 
	    $tableNum = $row['tableNumber'];
	    $ServerID = $row['sid'];
	    $Orderid = $row['oid'];
?>    
            <div>
                 <a href="view.php?id=<?php echo $Orderid;?>">Order ID: <?php echo $Orderid;?></a>
                 <p><b>TABLE NUMBER: </b><?php echo $tableNum;?><b> |</b>Server ID: <?php echo $ServerID;?></p>
            </div>
<?php
     }
}catch(PDOException $e){
	print "Error!" . $e->getMessage() . "<br/>";

}
?>
 	<div class="container center-text">           
         <a href="?page=1">First</a>      
	 <a href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>">Prev</a>
         <b><?php echo"$page"?></b>
         <a href="<?php if($page >= $max_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>">Next</a>
         <a href="?page=<?php echo $max_pages; ?>">Last</a>
        </div>
<?php
require_once('back.php');
?>
