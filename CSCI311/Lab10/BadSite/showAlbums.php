<?php
	/* author: Sarah Carruthers
	  date: Spring 2018
	*/
	require_once("dbinfo.inc");
	$err;
	$msg;
	$title = "Song Picker-doodle";
	if(isset($_GET['bandID'])){
		
		$title = $_GET['bandName'] ."'s Super Awesome Songs";
	}
	$page_title = "Show Songs";
	require_once("front.php");
?>

<header>
	<h1><?php echo $title?></h1>
</header>
<div class="mainContainer">
<form method="get" action="showAlbums.php">
<?php
if(isset($_GET['bandID'])){
	//we've selected a band, so build a table of that band's songs
	echo "<div class='myTable'>".
		"<div class='myRow'><span class='myCol table-head'>Band</span><span class='myCol table-head'>Album</span>".
		"</div>";
	
	//create a connection to the database
	$myHandle;
	try{
		$myHandle = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

	}catch(PDOException $e){
		$err .= "Connection failed: " . $e->getMessage() . "\n";
	}	
		
	//if the database connection was valid	
	if($myHandle){
		//find out which band they selected
		$bandID = $_GET['bandID'];
		//build a query to get all that band's albums
		$mystmt = "select bandName, albumName from bands left join albums on bands.bandID=albums.bandID where bands.bandID=$bandID and albums.bandID=$bandID";
		//query the db
		$rslt = $myHandle->query($mystmt);
		//iterate through the returned results, and build an array of albums
		$i=1;
		foreach($rslt as $row){
			foreach($row as $field=>$value){
				$albums[$i][$field] = $value;
			}
			$i++;
		}
		$numAlbums = sizeof($albums);
		//iterate through the array of albums and build a table
		for($j=1; $j<=$numAlbums; $j++){
		//build the table
			echo "<div class='myRow'>";
			echo "<span class='myCol'>{$albums[$j]['bandName']}</span>";
			echo "<span class='myCol'>{$albums[$j]['albumName']}</span>";
			echo "</div>\n";		
		}
		echo "<a href='showAlbums.php'>Back</a>";//put a link back, after the table
	}
	echo "</div>";//end table	
}else{

	//this is if we haven't picked a band yet
	
	//create a connection to the database
	$myHandle;
	try{
		$myHandle = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

	}catch(PDOException $e){
		$err .= "Connection failed: " . $e->getMessage() . "\n";
	}	
	//if the connection to the db is valid
	if($myHandle){
		//build a query to get the band names and ids from the db
		$mystmt = "select bandName, bandID from bands order by bandName";
		$rslt = $myHandle->query($mystmt);
		
		//build an associative array, where the band's id is the key, and the band's name is the value
		$i = 1;
		foreach($rslt as $row){
			foreach($row as $field=>$value){
				$bands[$i][$field] = $value;
			}
			$i++;
		}	
		$i++;
		$numBands = sizeof($bands);
		//build a drop down for the band
		echo "<label for='bandID'>Pick a Band:</label>".
			 "<select id='bandID' name='bandID' onchange='setName()'>";
		for($j=1; $j<=$numBands; $j++){
		//build the table
			echo "<option value=\"{$bands[$j]['bandID']}\">{$bands[$j]['bandName']}</option>";	
		}
		echo "</select><br/>".
		     "<input type='submit' value='Get Albums'/>".
		     //this hidden input contains the band's name, which is needed later
		     //initialize it to the 1st option's value
			 "<input type='hidden' id='bandName' name='bandName' value=\"{$bands[1]['bandName']}\"/>";	
	}
	$myHandle=null;
}
?>
</form>
</div>
<script>
	/*
		This function is called when the dropdown changes value
		It copies the name of the band into the hidden input element
	*/
	function setName(){
		var bandID = document.getElementById('bandID');

    	if (bandID.selectedIndex == -1)
        	return null;

    	var bandName = bandID.options[bandID.selectedIndex].text;
    	document.getElementById('bandName').value = bandName;
		
	}
</script>
<?php
require_once("back.php");
?>