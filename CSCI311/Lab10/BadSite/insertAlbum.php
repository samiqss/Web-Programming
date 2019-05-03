<?php
	/* author: Sarah Carruthers
	  date: Spring 2018
	*/
	require_once("dbinfo.inc");
	/*create a file named dbinfo.inc, and place in it the following in a php script:
	<?php
	$servername = "wwwstu.csci.viu.ca";//use localhost instead if not working on school server
	$username = "username";//this is your mysql username
	$password = "password";//your mysql password
	$database = "username";//this is the name of your mysql database, it is the same as your user name on the csci server
	//replacing username with your username, and password for your mysql password$name;
	?>
	*/
	$err;
	$bandID;
	$name;
	$success;
	if (($_SERVER['REQUEST_METHOD']=="POST")){
		$name = $_POST['albumname'];
		$bandID = $_POST['band'];
		$rdate = $_POST['releasedate'];
		if(trim($name) === ""){
			$err = "Sorry, album name cannot be empty";
		}
	}
	$page_title = "Insert Albums";
	require_once("front.php");
?>
<header><h1>Safely add things to the database</h1></header>
<div class="mainContainer text-left">
<p>
<?php
	//if there was no error set, and the name and bandID were set,
	//create a connection to the db 
	//build a query to insert the album, in $name, into the albums table and bandID, 
	if(isset($name) && isset($bandID) && !isset($err)){
		try{
			$dbh = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
			$myQuery = "insert into albums (albumName, bandID, releaseDate) values (\"$name\", $bandID, \"$rdate\")";
			
			if($dbh->exec($myQuery) !==false){
				$success = $name." was successfully added";
			}else{
				$err = "The album was not inserted";
			}
			$dbh = null;	
		}catch(PDOException $e){
			echo "Connection failed: " . $e->getMessage();
		}
	}
?>
</p>	
<form action="insertAlbum.php" method="post">
<?php if(isset($err)) echo "<p>".$err."</p>";?>
<?php if(isset($success)) echo "<p>".$success."</p>";?>
<label for="band">Band</label>
<select name="band" id="band">
	<option value="1">The Who</option>
	<option value="2">Moxy Fruvous</option>
	<option value="3">The Doors</option>
	<option value="4">Maroon 5</option>
	<option value="5">Justin Bieber</option>
	<option value="6">Michael Jackson</option>
	<option value="7">Prince</option>
</select>
<label for="albumname">Album Name</label>
<input name="albumname" type="text" id="albumname"/>
<label for="releasedate">Release Date</label>
<input name="releasedate" type="text" id="releasedate"/>	
<input type="submit" value="Insert"/>

</form>
</div>
<?php
	require_once("back.php");
	?>