<?Php
//require "../include/z_db1.php";
require "config.php";// connection to database
session_start();
ini_set('max_execution_time', 300);

$sql="select distinct modality from exam where email='".$_SESSION['email']. "'";

foreach ($dbo->query($sql) as $row) {
	echo "<option value=$row[modality]>$row[modality]</option>";
}
	




?>