<?php
set_time_limit(0);
header('content-type: text/html; charset=utf-8');
header("access-control-allow-origin: *");

include 'connect.php';
session_start();
$target_dir = "uploads/";
$characters = 'ABCDEFGHIJKLMNOPQRSTUVXZWabcdefghijklmnopqrstuvwxyz0123456789';
$string = '';

if(isset($_FILES["file"]["type"]))
{
	// generates the key
	for ($i = 0; $i < 20; $i++) {
      $string .= $characters[rand(0, strlen($characters) - 1)];
	}
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	//upload file and enters data in database
	if ($FileType == 'sql') {
		move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
		$sqlfile = fopen($target_file, "r") or die("Unable to open file!");
		$contents = file($target_file);
		$stop = false;
		$duplicates = false;
		$duplicate_email = false;
		$dif_logged = false;
		$invali_user = false;
		
		
		
		foreach($contents as $line) {
			if ($_SESSION["user"]== 'all') {
				
				//duplicate email
				$result = mysql_query("SELECT email FROM users") or die('Query failed: ' . mysql_error());
				while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					if (stripos($line, $row['email']) !== false) {
						
						$stop = true;
						$duplicate_email = true;
						
						break;
						
					}
					
				}
			}
			
			// sql injection
			if ((stripos($line, 'DROP') !== false) or (stripos($line, 'DELETE') !== false) or (stripos($line, 'UPDATE') !== false) or (stripos($line, 'CREATE') !== false)) {
				
				$stop = true;
				$sqlinjection = true;
				
				break;
			}
			
			if ($_SESSION["user"]!= 'all') {
				
				//differnt email when loged
				
				if (stripos($line, $_SESSION["email"]) == false) {
						
						$stop = true;
						$dif_logged = true;
						
						break;
						
					}
				// invalid user
				if (stripos($line, "INSERT IGNORE INTO users") !== false) {
						$username = explode(",", $line);
						$inter = explode("(", $username[0]);
						$user = $inter[1];
						$user = str_replace("'", "", $user);
						
						if ($user != $_SESSION["user"]) {
							$stop = true;
							$invali_user = true;
						
							break;
						}
						
						
				}
				
				// duplicates
				if (stripos($line, 'INSERT IGNORE INTO exam') !== false) {
					
					$username = explode(",", $line);
					$inter = explode("(", $username[0]);
					$examID = $inter[1];
					// email
					$a = explode(")", $username[9]);
										
					$email = $a[0];
					
					$check_duplicates = mysql_query("SELECT examID FROM exam WHERE examID = $examID AND email = $email");
					
					$row=mysql_fetch_array($check_duplicates);
					
					
					if($row[0]!='') {
						$stop = true;
						$duplicates = true;
						break;
					}
				}
					
				
			}
			
			
			
			

		}
		
		if ($stop == false) {
			
			foreach($contents as $line) {
				 
				$result = mysql_query($line) or die("<span id='success' style= 'color: white;'>Error: $line: Your data is not supported.");
				$file_name= str_replace("'", "", basename($target_file,".sql"));
				if (stripos($line, 'patient') !== false) {
					$username = explode(",", $line);
					$inter = explode(")", $username[4]);
					$user = str_replace("'", "", $inter[0]);
					$email = str_replace(" ", "", $user);
				}
			
			}
			if ($_SESSION["user"]!= 'all') {
				echo "<span id='success' style= 'color: white;'>SQL file uploaded. Your data will be updated in 5 seconds.</span>";
			} else {
				
				$query = mysql_query("UPDATE users SET keyword = '".$string."' WHERE email= '$email'") or die('Query failed: ' . mysql_error());
				$string= str_replace("'", "", $string);
				echo "<span id='success' style= 'color: white;'>SQL file uploaded. Login and view your data with the key: $string</span>";
			}
		} else {
			if ($dif_logged == true) {
				echo "<span id='success' style= 'color: white;'>Error: You can only upload different e-mail data on homepage.";
			} elseif ($duplicates == true) {
				echo "<span id='success' style= 'color: white;'>Error: Duplicates are not supported.";
			} elseif ($duplicate_email == true){
				echo "<span id='success' style= 'color: white;'>Error: E-mail already registered. Login to view your data.";
			} elseif ($invali_user == true) {
				echo "<span id='success' style= 'color: white;'>Error: Wrong user. Run python script with the correct user.";
			} elseif ($sqlinjection == true) {
				echo "<span id='success' style= 'color: white;'>Error: Your data is not supported.";
			}
			
		}
	} else {
		echo "<span id='success' style= 'color: white;'>Error: Choose only SQL files.</span>";
	} 


} 


?>