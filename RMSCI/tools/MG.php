<?php

date_default_timezone_set('Europe/Dublin');

function get_OrganDose($key) {
	$query = "select organDose, sliceThickness_cm, equipmentmodel, date from allmgdata where organDose IS NOT NULL AND email= (SELECT email FROM users WHERE keyword= '".$key."')";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		
		$date = (strtotime($line["date"])*1000);
		
		$final = new organDose($date, floatval($line["organDose"]), $line["sliceThickness_cm"], $line["equipmentmodel"]);
		$array[] = $final;
		

	}
	sort($array);

	$organDose_data = json_encode($array);
	echo $organDose_data;

}

function get_MGVOLTAGE ($key) {
	$query = "SELECT voltage, date, equipmentmodel from allmgdata WHERE email= (SELECT email FROM users WHERE keyword= '".$key."') group by examid, voltage";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		
		
		$date = (strtotime($line["date"]))*1000;

		$final = new MG($date, floatval($line["voltage"]), $line["equipmentmodel"]);
		$array[] = $final;


	}
	
	
	$organDose_data = json_encode($array);
	echo $organDose_data;

}

function get_MGCOMP($key) {
	$query = "SELECT date, cforce_N, equipmentmodel from allmgdata WHERE email= (SELECT email FROM users WHERE keyword= '".$key."') group by examid, cforce_N";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		
	
		$date = (strtotime($line["date"]))*1000;
		
		$final = new MG($date, floatval($line["cforce_N"]), $line["equipmentmodel"]);

		$array[] = $final;


	}
	
	
	$organDose_data = json_encode($array);
	echo $organDose_data;

}

function get_MGTIME($key) {
	$query = "SELECT examid, date, exposureTime, equipmentmodel from allmgdata WHERE email= (SELECT email FROM users WHERE keyword= '".$key."') group by examid, exposureTime";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		
	
			$date = (strtotime($line["date"]))*1000;
			
			$final = new MG($date, floatval($line["exposureTime"]), $line["equipmentmodel"]);
			$array[] = $final;


	}
	
	
	$organDose_data = json_encode($array);
	echo $organDose_data;

}


function get_mgAVG($key, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(allmgdata.organDose) FROM `allmgdata` WHERE (unix_timestamp(allmgdata.date) * 1000)>= '".$xmin."' AND (unix_timestamp(allmgdata.date) * 1000) < '".$xmax."' AND allmgdata.organDose>= '".$ymin."' AND allmgdata.organDose <'".$ymax."' and allmgdata.email=(SELECT email FROM users WHERE keyword= '".$key."')";
	
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(allmgdata.organDose)"]);


}

function get_mgThicknessAVG($key, $thick, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(allmgdata.organDose) FROM `allmgdata` WHERE (unix_timestamp(allmgdata.date) * 1000)>= '".$xmin."' AND (unix_timestamp(allmgdata.date) * 1000) < '".$xmax."' AND allmgdata.organDose>= '".$ymin."' AND allmgdata.organDose <'".$ymax."' and allmgdata.email=(SELECT email FROM users WHERE keyword= '".$key."') AND round(allmgdata.sliceThickness_cm, 2)='".$thick."'";
	
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(allmgdata.organDose)"]);


}

function get_mgEquipAVG($key, $thick, $equipment, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(allmgdata.organDose) FROM `allmgdata` WHERE (unix_timestamp(allmgdata.date) * 1000)>= '".$xmin."' AND (unix_timestamp(allmgdata.date) * 1000) < '".$xmax."' AND allmgdata.organDose>= '".$ymin."' AND allmgdata.organDose <'".$ymax."' and allmgdata.email=(SELECT email FROM users WHERE keyword= '".$key."') AND round(allmgdata.sliceThickness_cm, 2)='".$thick."' AND allmgdata.equipmentmodel='".$equipment."'";
	
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(allmgdata.organDose)"]);


}

function get_mgTIMEAVG($key, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(allmgdata.exposureTime) FROM allmgdata WHERE (unix_timestamp(allmgdata.date) * 1000)>= '".$xmin."' AND (unix_timestamp(allmgdata.date) * 1000) < '".$xmax."' AND allmgdata.exposureTime>= '".$ymin."' AND allmgdata.exposureTime <'".$ymax."' and allmgdata.email=(SELECT email FROM users WHERE keyword= '".$key."')";
	
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(allmgdata.exposureTime)"]);


}

function get_mgTIMEEquipAVG($key, $equipment, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(allmgdata.exposureTime) FROM allmgdata WHERE (unix_timestamp(allmgdata.date) * 1000)>= '".$xmin."' AND (unix_timestamp(allmgdata.date) * 1000) < '".$xmax."' AND allmgdata.exposureTime>= '".$ymin."' AND allmgdata.exposureTime <'".$ymax."' and allmgdata.email=(SELECT email FROM users WHERE keyword= '".$key."') AND allmgdata.equipmentmodel='".$equipment."'";
	
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(allmgdata.exposureTime)"]);


}


function get_mgVOLTAGEAVG($key, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(allmgdata.voltage) FROM allmgdata WHERE (unix_timestamp(allmgdata.date) * 1000)>= '".$xmin."' AND (unix_timestamp(allmgdata.date) * 1000) < '".$xmax."' AND allmgdata.voltage>= '".$ymin."' AND allmgdata.voltage <'".$ymax."' and allmgdata.email=(SELECT email FROM users WHERE keyword= '".$key."')";
	
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(allmgdata.voltage)"]);


}

function get_mgVOLTAGEEquipAVG($key, $equipment, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(allmgdata.voltage) FROM allmgdata WHERE (unix_timestamp(allmgdata.date) * 1000)>= '".$xmin."' AND (unix_timestamp(allmgdata.date) * 1000) < '".$xmax."' AND allmgdata.voltage>= '".$ymin."' AND allmgdata.voltage <'".$ymax."' and allmgdata.email=(SELECT email FROM users WHERE keyword= '".$key."') AND allmgdata.equipmentmodel='".$equipment."'";
	
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(allmgdata.voltage)"]);


}


function get_mgCOMPFORCEAVG($key, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(allmgdata.cforce_N) FROM allmgdata WHERE (unix_timestamp(allmgdata.date) * 1000)>= '".$xmin."' AND (unix_timestamp(allmgdata.date) * 1000) < '".$xmax."' AND allmgdata.cforce_N>= '".$ymin."' AND allmgdata.cforce_N <'".$ymax."' and allmgdata.email=(SELECT email FROM users WHERE keyword= '".$key."')";
	
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(allmgdata.cforce_N)"]);


}


function get_mgCOMPFORCEquipEAVG($key, $equipment, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(allmgdata.cforce_N) FROM allmgdata WHERE (unix_timestamp(allmgdata.date) * 1000)>= '".$xmin."' AND (unix_timestamp(allmgdata.date) * 1000) < '".$xmax."' AND allmgdata.cforce_N>= '".$ymin."' AND allmgdata.cforce_N <'".$ymax."' and allmgdata.email=(SELECT email FROM users WHERE keyword= '".$key."') AND allmgdata.equipmentmodel='".$equipment."'";
	
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(allmgdata.cforce_N)"]);


}



function get_MGPERC($key, $xmin, $xmax, $ymin, $ymax){
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when organDose BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then organDose end ORDER BY organDose SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM allmgdata where email= (SELECT email FROM users WHERE keyword= '".$key."') AND organDose is not null";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}

function get_MGThickPERC($key, $thick, $xmin, $xmax, $ymin, $ymax){
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when organDose BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then organDose end ORDER BY organDose SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM allmgdata where email= (SELECT email FROM users WHERE keyword= '".$key."') AND round(sliceThickness_cm, 2)='".$thick."' AND organDose is not null";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}

function get_MGEquipmPERC($key, $thick, $equipment, $xmin, $xmax, $ymin, $ymax){
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when organDose BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then organDose end ORDER BY organDose SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM allmgdata where email= (SELECT email FROM users WHERE keyword= '".$key."') AND round(sliceThickness_cm, 2)='".$thick."' AND equipmentmodel='".$equipment."' AND organDose is not null";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}


function get_MGCforcePERC($key, $xmin, $xmax, $ymin, $ymax){
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when cforce_N BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then cforce_N end ORDER BY cforce_N SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM allmgdata where email= (SELECT email FROM users WHERE keyword= '".$key."') AND cforce_N is not null";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}

function get_MGCforceEquipmentPERC($key, $equipment, $xmin, $xmax, $ymin, $ymax){
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when cforce_N BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then cforce_N end ORDER BY cforce_N SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM allmgdata where email= (SELECT email FROM users WHERE keyword= '".$key."') AND equipmentmodel='".$equipment."' AND cforce_N is not null";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}

function get_MGVoltagePERC($key, $xmin, $xmax, $ymin, $ymax){
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when voltage BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then voltage end ORDER BY voltage SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM allmgdata where email= (SELECT email FROM users WHERE keyword= '".$key."')";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}



function get_MGVoltageEquipPERC($key, $equipment, $xmin, $xmax, $ymin, $ymax){
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when voltage BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then voltage end ORDER BY voltage SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM allmgdata where email= (SELECT email FROM users WHERE keyword= '".$key."') AND equipmentmodel='".$equipment."'";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}

function get_MGTimePERC($key, $xmin, $xmax, $ymin, $ymax){
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when exposureTime BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then exposureTime end ORDER BY exposureTime SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM allmgdata where email= (SELECT email FROM users WHERE keyword= '".$key."') AND exposureTime IS NOT NULL";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}


function get_MGtimeEquipPERC($key, $equipment, $xmin, $xmax, $ymin, $ymax){
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when exposureTime BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then exposureTime end ORDER BY exposureTime SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM allmgdata where email= (SELECT email FROM users WHERE keyword= '".$key."') AND equipmentmodel='".$equipment."' AND exposureTime IS NOT NULL";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}
?>