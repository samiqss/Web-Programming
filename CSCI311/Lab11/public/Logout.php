<!DOCTYPE html>
<!-- Created by Sami Al-Qusus April 1, 2018 -->
<!-- modified April 1, 2018 -->
<!-- Logout.php for Lab11 -->
<?php
session_start(); 
session_destroy(); 
header("location:Lab11.php");
exit;
?>
