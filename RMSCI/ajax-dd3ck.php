<?Php
require "config.php"; // connection details

error_reporting(0);// With this no error reporting will be there
//////////
/////////////////////////////////////////////////////////////////////////////
$country=$_GET['country'];// 
//$country='IND'; // To check you can use this
$state1=$_GET['state'];
$city1=$_GET['city'];
$serie1=$_GET['serie'];
if (isset($_GET['key'])) {
	$key=$_GET['key'];
} else {
	$key = 'public';
}

//$state1="Andhra Pradesh";
///////////// Validate the inputs ////////////
// Checking country variable ///
if((strlen($country)) > 0 and (!ctype_alpha($country))){ 
echo "Data Error";
exit;
}

/////////// end of input validation //////

if(strlen($country) > 0 and $country == 'CR'){
$q_country="SELECT DISTINCT bodypart
FROM cr_filters WHERE email = (SELECT email FROM users WHERE keyword= '$key');";
$sth = $dbo->prepare($q_country);
$sth->execute();
$state = $sth->fetchAll(PDO::FETCH_COLUMN);
}else if (strlen($country) > 0 and $country == 'CT') {
$q_country="SELECT DISTINCT bodypart
FROM ct_filters WHERE bodypart!= '' AND email = (SELECT email FROM users WHERE keyword= '$key');";
$sth = $dbo->prepare($q_country);
$sth->execute();
$state = $sth->fetchAll(PDO::FETCH_COLUMN);
} else {
$state="SELECT DISTINCT slice_thick from mg_filters WHERE email = (SELECT email FROM users WHERE keyword= '$key') order by slice_thick";	
$sth = $dbo->prepare($state);
$sth->execute();
$state = $sth->fetchAll(PDO::FETCH_COLUMN);

}
//echo $q_country;

$q_state = "SELECT DISTINCT equipmentmodel FROM ct_filters WHERE bodypart = '$state1' AND email = (SELECT email FROM users WHERE keyword= '$key')";

if(strlen($state1) > 0 and $country == 'CT'){
$sth = $dbo->prepare($q_state);
$sth->execute();
$city = $sth->fetchAll(PDO::FETCH_COLUMN);
$serie =['Not Available'];
} elseif (strlen($state1) > 0 and $country == 'CR') {
	
	$q_state="SELECT DISTINCT seriesDesc FROM cr_filters WHERE bodypart = '$state1' AND email = (SELECT email FROM users WHERE keyword= '$key')";
	
	$sth = $dbo->prepare($q_state);
	$sth->execute();
	$serie = $sth->fetchAll(PDO::FETCH_COLUMN);
	
	} elseif ($country == 'MG') {
		if ($state1!='body') {
$q_state="SELECT DISTINCT equipmentmodel FROM mg_filters where round(slice_thick, 2)='$state1' AND email = (SELECT email FROM users WHERE keyword= '$key')";
$sth = $dbo->prepare($q_state);
$sth->execute();
$city = $sth->fetchAll(PDO::FETCH_COLUMN);
$serie = ['Not Available'];
		} else if ($state1=='body') {
			
			$q_state="SELECT DISTINCT equipmentmodel FROM mg_filters WHERE email = (SELECT email FROM users WHERE keyword= '$key')";
$sth = $dbo->prepare($q_state);
$sth->execute();
$city = $sth->fetchAll(PDO::FETCH_COLUMN);
$serie = ['Not Available'];
		} 
}

if (strlen($serie1) > 0 and $country =='CR') {
	$q_state1="SELECT DISTINCT equipmentmodel FROM cr_filters WHERE seriesDesc = '$serie1' AND email = (SELECT email FROM users WHERE keyword= '$key')";
	$sth = $dbo->prepare($q_state1);
	$sth->execute();
	$city = $sth->fetchAll(PDO::FETCH_COLUMN);
	
}
$main = array('state'=>$state,'city'=>$city, 'serie'=> $serie, 'value'=>array("state1"=>"$state1","city1"=>"$city1", "serie1"=>"$serie1"));
echo json_encode($main);

////////////End of script /////////////////////////////////////////////////////////////////////////////////
?>