<?php
set_time_limit(0);

header("access-control-allow-origin: *");

include 'connect.php';

$email = $_POST['email'];

$sql = "SELECT keyword FROM users WHERE email='$email'";
$result = mysql_query($sql);
$row=mysql_fetch_array($result);


if($row[0]!='') {
	
	$key  = $row['keyword'];//FETCHING PASS
	$to = $email;
	$subject = "RMSCI Password Recovery";
	$from = "RMSCI";
	$url = "http://rmsci.fc.ul.pt";
	$body  =  "RMSCI Keyword Recovery<br>
	----------------------------------<br>
	<br>
	<br>
	URL: $url<br>
	Email details: $to<br>
	Here is your password: $key<br>
	<br>
	Sincerely,<br>
	RMSCI";
	$from = "rflorencio@lasige.di.fc.ul.pt";
	$headers1 = "From: RMSCI <rflorencio@lasige.di.fc.ul.pt>\r\n";
	$headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
	$headers1 .= "X-Priority: 1\r\n";
	$headers1 .= "X-MSMail-Priority: High\r\n";
	$headers1 .= "X-Mailer: Just My Server\r\n";
	$sentmail = mail ( $to, $subject, $body, $headers1 );
	if ($sentmail == 1) {
		echo 'success';
		
	} else {
		echo "error";
	}

} else {
    echo "invalid email";
	
}




?>