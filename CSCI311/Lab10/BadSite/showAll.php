<?php
	/* author: Sarah Carruthers
	  date: Spring 2018
	*/
	require_once("dbinfo.inc");
	$err;
	$msg;
	$page_title="Show Albums";
	// create a file named dbinfo.inc, and place in it the following in a php script:
//	<?php
//	$servername = "wwwstu.csci.viu.ca";//use localhost instead if not working on school server
//	$username = "username";//this is your mysql username
//	$password = "password";//your mysql password
//	$database = "username";//this is the name of your mysql database, it is the same as your user name on the csci server
	//replacing username with your username, and password for your mysql password$name
//	
	require_once("front.php");

?>
<header>
<h1>Albums by the Best Bands Ever</h1>
</header>
<div class="mainContainer">

<div class="myTable">
<div class="myRow">
	<span class="myCol table-head">Band</span>
	<span class="myCol table-head">Album</span>
	<span class="myCol table-head">Release Date</span>
</div>
<?php
//connect to db and get the band, album and producer using a joined query:
	$myHandle;
	try{
		$myHandle = new PDO("mysql:host= $servername; dbname=$database", $username, $password);

	}catch(PDOException $e){
		$err .= "Connection failed: " . $e->getMessage() . "\n";
	}
	//if the db connection was successful	
	if($myHandle){
	//build the query
		$mystmt = "select bandName, albumName, releaseDate from bands, albums where bands.bandID=albums.bandID";
		$rslt = $myHandle->query($mystmt);
		$i = 1;
		$albums;
		//iterate through the result set
		//building an associative array for each field, for each row
		foreach($rslt as $row){
			foreach($row as $field=>$value){
				$albums[$i][$field] = $value;
			}
			$i++;
		}
		$numAlbums = sizeof($albums);
		for($j=1; $j<=$numAlbums; $j++){
			//build the table
			echo "<div class='myRow text-left'>";
			echo "<span class='myCol'>{$albums[$j]['bandName']}</span>";
			echo "<span class='myCol'>{$albums[$j]['albumName']}</span>";
			echo "<span class='myCol'>{$albums[$j]['releaseDate']}</span>";
			echo "</div>\n";
		}
		
	}
	
?>
</div>
</div>
<?php
	require_once("back.php");
?>
