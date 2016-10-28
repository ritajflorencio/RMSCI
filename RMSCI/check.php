<?php
set_time_limit(0);
header('content-type: text/html; charset=utf-8');
header("access-control-allow-origin: *");

include 'connect.php';
session_start();
$key = $_POST['key'];


$sql = "SELECT keyword FROM users WHERE keyword='$key'";
$result = mysql_query($sql);
$row=mysql_fetch_array($result);

if($row[0]!='') {
	$_SESSION["key"]=$key;
	$query = mysql_query("SELECT user FROM users WHERE keyword='$key'");
	$user = mysql_fetch_array($query, MYSQL_ASSOC);
	$_SESSION["user"]=$user["user"];
	

    if(isset($_SESSION["user"])) {
		
		echo "<script>window.location = 'http://localhost/public_html/RMSCI/login.php?key=$key';</script>";
	}


} else {
    echo "<script>document.getElementById('text').value = ''; document.getElementById('text').placeholder = 'Type a valid key';</script>";
	
}




?>