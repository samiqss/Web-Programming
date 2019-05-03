<!-- Created by Sami Al-Qusus March 17, 2018 -->
<!-- modified March 18, 2018 -->
<!-- Lab9.php required for Lab9 -->
<?php
require('dbinfo.inc');
require_once('front.php');
?>

<h2>IDEAS</h2>

<?php

if (isset($_POST['search'])) {
       $pattern = $_POST['search'];
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
    $result =$dbh->query("SELECT * from Ideas where iname LIKE '%$pattern%' LIMIT $curr, $perpage");
    $num = $dbh->query("SELECT COUNT(iname) as c from Ideas where iname LIKE '%$pattern%'");
    foreach ($num as $count){
    $max_pages = ceil($count['c'] / $perpage);}
    echo "<div>".$count['c']." result(s) found for <b>".$pattern."</b></div>";
    foreach ($result as $row){
	      $iname = $row['iname'];
              $desc = $row['description'];
	      $id = $row['ideaID'];
?>
	      <div>
	          <a href="view.php?id=<?php echo $id;?>">
                   <?php echo $iname;?>
		  </a>
                  <p><?php echo substr($desc, 0, 200); ?> ...</p>
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
