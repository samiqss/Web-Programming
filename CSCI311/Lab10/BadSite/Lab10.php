<?php
	/*author: Sarah Carruthers
	  date: Spring 2018
	*/
	require_once("dbinfo.inc");
	$page_title = "Lab 10 Start Page";
	require_once("front.php");
?>
<header><h1>Welcome to Lab 10</h1></header>
<div class="mainContainer text-left">

	<p>For this lab, your task is to identify and fix all security problems found
	in the following files:</p>
	<ul>
		<li><a href="insertAlbum.php">Insert Album</a></li>
		<li><a href="showAlbums.php">Show Albums by Artist</a></li>
		<li><a href="showAll.php">Show All Albums</a></li>
	</ul>
	<p>There are problems in every one of those files.  The problems include (but may not be 
	limited to):</p>
	<ul>
		<li>SQL Injection</li>
		<li>XSS</li>
		<li>Lack of validation</li>
		<li>Lack of sanitization</li>
	</ul>
</div>
<?php
	require_once("back.php");
?>