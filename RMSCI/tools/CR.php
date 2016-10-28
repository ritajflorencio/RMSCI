<?php
mysql_set_charset("utf8");
date_default_timezone_set('Europe/Dublin');

function get_IADP($key) {
	$query = "SELECT examid, date, IADP, bodypart, series, equipmentmodel from allcrdata WHERE email=(SELECT email FROM users WHERE keyword= '".$key."') AND IADP is not null";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		
		
		$date = (strtotime($line["date"]))*1000;
			
	
		$final = new CR($date, floatval($line["IADP"]), $line["bodypart"], $line["series"], $line["equipmentmodel"]);
		$array[] = $final;
		

	}
	
	sort($array);
	$iadp_data = json_encode($array);
	echo $iadp_data;

}


function get_CRVOLTAGE($key) {
	$query = "SELECT examid, voltage, date, bodypart, series, equipmentmodel from allcrdata WHERE email=(SELECT email FROM users WHERE keyword= '".$key."') and voltage is not null group by examid, voltage";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		
		
			$date = (strtotime($line["date"]))*1000;
		
			$final = new CR($date, floatval($line["voltage"]), $line["bodypart"], $line["series"], $line["equipmentmodel"]);
			$array[] = $final;
		

	}
	
	
	$iadp_data = json_encode($array);
	echo $iadp_data;

}

function get_CR_EXPOSURETIME($key) {
	$query = "SELECT examid, exposureTime, date, GROUP_CONCAT(DISTINCT bodypart SEPARATOR ','),  GROUP_CONCAT(DISTINCT series SEPARATOR ','), equipmentmodel from allcrdata WHERE email=(SELECT email FROM users WHERE keyword= '".$key."') and exposureTime is not null group by examid, exposureTime";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		
		
			$date = (strtotime($line["date"]))*1000;
			
			$final = new CR($date, floatval($line["exposureTime"]), $line["GROUP_CONCAT(DISTINCT bodypart SEPARATOR ',')"], $line["GROUP_CONCAT(DISTINCT series SEPARATOR ',')"], $line["equipmentmodel"]);
			$array[] = $final;
		

	}
	
	
	$iadp_data = json_encode($array);
	echo $iadp_data;

}

function get_CRAVG($key, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(IADP) FROM `allcrdata` WHERE (unix_timestamp(date) * 1000)>= '".$xmin."' AND (unix_timestamp(date) * 1000) < '".$xmax."' AND IADP>= '".$ymin."' AND IADP <'".$ymax."' AND email= (SELECT email FROM users WHERE keyword= '".$key."') AND IADP IS NOT NULL";
	
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(IADP)"]);


}

function get_CRBodypartAVG($key, $bodypart, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(IADP) FROM `allcrdata` WHERE (unix_timestamp(date) * 1000)>= '".$xmin."' AND (unix_timestamp(date) * 1000) < '".$xmax."' AND IADP>= '".$ymin."' AND IADP <'".$ymax."' AND bodypart = '".$bodypart."' AND email=(SELECT email FROM users WHERE keyword= '".$key."') AND IADP IS NOT NULL";
	
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(IADP)"]);


}

function get_CREquipmentAVG($key, $bodypart, $series, $equipment, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(IADP) FROM `allcrdata` WHERE (unix_timestamp(date) * 1000)>= '".$xmin."' AND (unix_timestamp(date) * 1000) < '".$xmax."' AND IADP>= '".$ymin."' AND IADP <'".$ymax."' AND bodypart = '".$bodypart."' AND series = '".$series."' AND equipmentmodel = '".$equipment."' AND email=(SELECT email FROM users WHERE keyword= '".$key."') AND IADP IS NOT NULL";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(IADP)"]);


}

function get_CRSeriesAVG($key, $bodypart, $series, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(IADP) FROM `allcrdata` WHERE (unix_timestamp(date) * 1000)>= '".$xmin."' AND (unix_timestamp(date) * 1000) < '".$xmax."' AND IADP>= '".$ymin."' AND IADP <'".$ymax."' AND bodypart = '".$bodypart."' AND series = '".$series."' AND email=(SELECT email FROM users WHERE keyword= '".$key."') AND IADP IS NOT NULL";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(IADP)"]);


}



function get_CRTIMEAVG($key, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(exposureTime) FROM `allcrdata` WHERE (unix_timestamp(date) * 1000)>= '".$xmin."' AND (unix_timestamp(date) * 1000) < '".$xmax."' AND exposureTime>= '".$ymin."' AND exposureTime <'".$ymax."' AND email=(SELECT email FROM users WHERE keyword= '".$key."') and exposureTime is not null";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(exposureTime)"]);


}

function get_CRTIMEBodypartAVG($key, $bodypart, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(exposureTime) FROM `allcrdata` WHERE (unix_timestamp(date) * 1000)>= '".$xmin."' AND (unix_timestamp(date) * 1000) < '".$xmax."' AND exposureTime>= '".$ymin."' AND exposureTime <'".$ymax."' AND bodypart = '".$bodypart."' AND email=(SELECT email FROM users WHERE keyword= '".$key."') and exposureTime is not null";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(exposureTime)"]);


}

function get_CRTIMESeriesAVG($key, $bodypart, $series, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(exposureTime) FROM `allcrdata` WHERE (unix_timestamp(date) * 1000)>= '".$xmin."' AND (unix_timestamp(date) * 1000) < '".$xmax."' AND exposureTime>= '".$ymin."' AND exposureTime <'".$ymax."' AND bodypart = '".$bodypart."' AND series='".$series."' AND email=(SELECT email FROM users WHERE keyword= '".$key."') and exposureTime is not null";
	
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(exposureTime)"]);


}

function get_CRTIMESeriesPER($key, $bodypart, $series, $xmin, $xmax,$ymin, $ymax) {
	
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when exposureTime BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then exposureTime end ORDER BY exposureTime SEPARATOR ','),',',90/100 * COUNT(*) + 1),',',-1) '90th Percentile' FROM allcrdata WHERE bodypart = '".$bodypart."'AND series='".$series."' AND email=(SELECT email FROM users WHERE keyword= '".$key."') AND exposureTime is not null;";
	
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);


}

function get_CRTIMEEquipmentPER($key, $bodypart, $series, $equipment, $xmin, $xmax,$ymin, $ymax) {
	
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when exposureTime BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then exposureTime end ORDER BY exposureTime SEPARATOR ','),',',90/100 * COUNT(*) + 1),',',-1) '90th Percentile' FROM allcrdata WHERE bodypart = '".$bodypart."'AND series='".$series."' AND equipmentmodel='".$equipment."' AND email=(SELECT email FROM users WHERE keyword= '".$key."') AND exposureTime is not null;";
	
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);


}
function get_CRTIMEEquipmentAVG($key, $bodypart, $series, $equipment, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(exposureTime) FROM allcrdata WHERE (unix_timestamp(date) * 1000)>= '".$xmin."' AND (unix_timestamp(date) * 1000) < '".$xmax."' AND exposureTime>= '".$ymin."' AND exposureTime <'".$ymax."' AND bodypart = '".$bodypart."' AND series='".$series."' AND equipmentmodel='".$equipment."' AND email=(SELECT email FROM users WHERE keyword= '".$key."') and exposureTime is not null";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(exposureTime)"]);


}

function get_CRVOLTAGEAVG($key, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(voltage) FROM allcrdata WHERE (unix_timestamp(allcrdata.date) * 1000)>= '".$xmin."' AND (unix_timestamp(allcrdata.date) * 1000) < '".$xmax."' AND allcrdata.voltage>= '".$ymin."' AND allcrdata.voltage <'".$ymax."' AND allcrdata.email=(SELECT email FROM users WHERE keyword= '".$key."') and exposureTime is not null";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(voltage)"]);


}

function get_CRVOLTAGEbodypartAVG($key, $bodypart, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(voltage) FROM allcrdata WHERE (unix_timestamp(allcrdata.date) * 1000)>= '".$xmin."' AND (unix_timestamp(allcrdata.date) * 1000) < '".$xmax."' AND allcrdata.voltage>= '".$ymin."' AND allcrdata.voltage <'".$ymax."' AND allcrdata.email=(SELECT email FROM users WHERE keyword= '".$key."') AND allcrdata.bodypart='".$bodypart."' and exposureTime is not null";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(voltage)"]);


}

function get_CRVOLTAGEseriesAVG($key, $bodypart, $series, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(voltage) FROM allcrdata WHERE (unix_timestamp(allcrdata.date) * 1000)>= '".$xmin."' AND (unix_timestamp(allcrdata.date) * 1000) < '".$xmax."' AND allcrdata.voltage>= '".$ymin."' AND allcrdata.voltage <'".$ymax."' AND allcrdata.email=(SELECT email FROM users WHERE keyword= '".$key."') AND allcrdata.bodypart='".$bodypart."' AND allcrdata.series='".$series."' and exposureTime is not null";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(voltage)"]);


}

function get_CRVOLTAGEequipmentAVG($key, $bodypart, $series, $equipment, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(voltage) FROM allcrdata WHERE (unix_timestamp(allcrdata.date) * 1000)>= '".$xmin."' AND (unix_timestamp(allcrdata.date) * 1000) < '".$xmax."' AND allcrdata.voltage>= '".$ymin."' AND allcrdata.voltage <'".$ymax."' AND allcrdata.email=(SELECT email FROM users WHERE keyword= '".$key."') AND allcrdata.bodypart='".$bodypart."' AND allcrdata.series='".$series."' AND allcrdata.equipmentmodel='".$equipment."' and exposureTime is not null";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["avg(voltage)"]);


}




function get_DAPPERC($key, $xmin, $xmax, $ymin, $ymax){
	
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when IADP BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then IADP end ORDER BY IADP SEPARATOR ','),',',90/100 * COUNT(*) + 1),',',-1) '90th Percentile' FROM allcrdata WHERE email=(SELECT email FROM users WHERE keyword= '".$key."') AND IADP is not null;";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}


function get_DAPBodypartPERC($key, $bodypart, $xmin, $xmax, $ymin, $ymax){
	
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when IADP BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then IADP end ORDER BY IADP SEPARATOR ','),',',90/100 * COUNT(*) + 1),',',-1) '90th Percentile' FROM allcrdata WHERE bodypart = '".$bodypart."' AND email=(SELECT email FROM users WHERE keyword= '".$key."') AND IADP is not null;";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}

function get_DAPSeriesPERC($key, $bodypart, $series, $xmin, $xmax, $ymin, $ymax){
	
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when IADP BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then IADP end ORDER BY IADP SEPARATOR ','),',',90/100 * COUNT(*) + 1),',',-1) '90th Percentile' FROM allcrdata where bodypart = '".$bodypart."' AND series='".$series."' AND email=(SELECT email FROM users WHERE keyword= '".$key."') AND IADP is not null;";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}

function get_DAPEquipmentPERC($key, $bodypart, $series, $equipment, $xmin, $xmax, $ymin, $ymax){
	
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when IADP BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then IADP end ORDER BY IADP SEPARATOR ','),',',90/100 * COUNT(*) + 1),',',-1) '90th Percentile' FROM allcrdata WHERE bodypart = '".$bodypart."'AND series='".$series."' AND equipmentmodel='".$equipment."' AND email=(SELECT email FROM users WHERE keyword= '".$key."') AND IADP is not null;";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}

function get_DAPTimePERC($key, $xmin, $xmax, $ymin, $ymax){
	
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when exposureTime BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then exposureTime end ORDER BY exposureTime SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM allcrdata where email =(SELECT email FROM users WHERE keyword= '".$key."') AND exposureTime is not null";
	
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}

function get_DAPTimeBodypartPERC($key, $bodypart, $xmin, $xmax, $ymin, $ymax){
	
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when exposureTime BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then exposureTime end ORDER BY exposureTime SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM allcrdata WHERE bodypart = '".$bodypart."' AND email=(SELECT email FROM users WHERE keyword= '".$key."') AND exposureTime is not null";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}




function get_DAPVoltagePERC($key, $xmin, $xmax, $ymin, $ymax){
	
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when voltage BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then voltage end ORDER BY voltage SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM allcrdata where email=(SELECT email FROM users WHERE keyword= '".$key."') AND voltage is not null";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}

function get_DAPVoltageBodypartPERC($key, $bodypart, $xmin, $xmax, $ymin, $ymax){
	
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when voltage BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then voltage end ORDER BY voltage SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM allcrdata where email=(SELECT email FROM users WHERE keyword= '".$key."') AND bodypart='".$bodypart."' AND voltage is not null";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}

function get_DAPVoltageSEriesPERC($key, $bodypart, $series, $xmin, $xmax, $ymin, $ymax){
	
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when voltage BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then voltage end ORDER BY voltage SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM allcrdata where allcrdata.email=(SELECT email FROM users WHERE keyword= '".$key."') AND allcrdata.bodypart='".$bodypart."' AND allcrdata.series='".$series."' AND voltage is not null";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}

function get_DAPVoltageEquipmentPERC($key, $bodypart, $series, $equipment, $xmin, $xmax, $ymin, $ymax){
	
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when voltage BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then voltage end ORDER BY voltage SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM allcrdata where allcrdata.email=(SELECT email FROM users WHERE keyword= '".$key."') AND allcrdata.bodypart='".$bodypart."' AND allcrdata.series='".$series."' AND allcrdata.equipmentmodel='".$equipment."' AND voltage is not null";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}

?>