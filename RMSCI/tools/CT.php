<?php

date_default_timezone_set('Europe/Dublin');

function get_CTDIw($key) {
	$query = "SELECT examid, GROUP_CONCAT(DISTINCT bodypart SEPARATOR ','), equipmentmodel from ct_filters where email = (SELECT email FROM users WHERE keyword= '".$key."') group by examid";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		
		$bodyPart = "SELECT date, ctdiw_sums/imagesNumber from ct_sums where examid = '" .$line["examid"]."' AND email = (SELECT email FROM users WHERE keyword= '".$key."');";
		$result1 = mysql_query($bodyPart) or die('Query failed: ' . mysql_error());
		while ($line2 = mysql_fetch_array($result1, MYSQL_ASSOC)) {
			$date = (strtotime($line2["date"]))*1000;
			if (floatval($line2["ctdiw_sums/imagesNumber"])!=0) {
				$final = new CT($date, floatval($line2["ctdiw_sums/imagesNumber"]), $line["GROUP_CONCAT(DISTINCT bodypart SEPARATOR ',')"], $line["equipmentmodel"]);
			
				$array[] = $final;
			}
			
		}
	}



	sort($array);
	$ctdivol_data = json_encode($array);
	echo $ctdivol_data;

}

function get_CTDLP($key) {
	$query = "SELECT examid, GROUP_CONCAT(DISTINCT bodypart SEPARATOR ','), equipmentmodel from ct_filters where email = (SELECT email FROM users WHERE keyword= '".$key."') group by examid";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		
		$bodyPart = "SELECT date, dlp from ct_sums where examid = '" .$line["examid"]."' AND email = (SELECT email FROM users WHERE keyword= '".$key."');";
		$result1 = mysql_query($bodyPart) or die('Query failed: ' . mysql_error());
		while ($line2 = mysql_fetch_array($result1, MYSQL_ASSOC)) {
			$date = (strtotime($line2["date"]))*1000;
			

			
				$final = new CT($date, floatval($line2["dlp"]), $line["GROUP_CONCAT(DISTINCT bodypart SEPARATOR ',')"], $line["equipmentmodel"]);
				$array[] = $final;
			
		}

	}
	
	sort($array);
	$ctdivol_data = json_encode($array);
	echo $ctdivol_data;

}

function get_CTDIwAVG($key, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT sum(ctdiw)/count(*) FROM allCTdata WHERE (unix_timestamp(allCTdata.date) * 1000)>= '".$xmin."' AND (unix_timestamp(allCTdata.date) * 1000) < '".$xmax."' AND ctdiw>= '".$ymin."' AND ctdiw <'".$ymax."' AND allCTdata.email=(SELECT email FROM users WHERE keyword= '".$key."')";
	
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
		
	echo json_encode($line["sum(ctdiw)/count(*)"]);


}

function get_CTDIwBodyPartAVG($key, $bodypart, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT sum(ctdiw)/count(*) FROM `allCTdata` WHERE (unix_timestamp(allCTdata.date) * 1000)>= '".$xmin."' AND (unix_timestamp(allCTdata.date) * 1000) < '".$xmax."' AND ctdiw>= '".$ymin."' AND ctdiw <'".$ymax."' AND allCTdata.bodypart = '".$bodypart."'AND allCTdata.email = (SELECT email FROM users WHERE keyword= '".$key."')";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);

	echo json_encode($line["sum(ctdiw)/count(*)"]);


}

function get_DLPBodyPartAVG($key, $bodypart, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(dlp) FROM `ct_sums` JOIN ct_filters ON ct_filters.examid = ct_sums.examid WHERE (unix_timestamp(ct_sums.date) * 1000)>= '".$xmin."' AND (unix_timestamp(ct_sums.date) * 1000) < '".$xmax."' AND dlp>= '".$ymin."' AND dlp <'".$ymax."' AND ct_filters.bodypart = '".$bodypart."' AND dlp IS NOT NULL AND ct_sums.email=(SELECT email FROM users WHERE keyword= '".$key."')";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);

	echo json_encode($line["avg(dlp)"]);


}

function get_DLPAVG($key, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(dlp) FROM `ct_sums` WHERE dlp IS NOT NULL AND (unix_timestamp(ct_sums.date) * 1000)>= '".$xmin."' AND (unix_timestamp(ct_sums.date) * 1000) < '".$xmax."' AND dlp>= '".$ymin."' AND dlp<'".$ymax."' AND email=(SELECT email FROM users WHERE keyword= '".$key."')";
	
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["avg(dlp)"]);


}



function get_CTDIwPERC($key, $xmin, $xmax, $ymin, $ymax){
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when allCTdata.ctdiw BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(allCTdata.date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then allCTdata.ctdiw end ORDER BY allCTdata.ctdiw SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM allCTdata WHERE email= (SELECT email FROM users WHERE keyword= '".$key."') AND ctdiw IS NOT NULL";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}

function get_dlpPERC($key, $xmin, $xmax, $ymin, $ymax){
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when dlp BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(ct_sums.date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then dlp end ORDER BY dlp SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM ct_sums WHERE email= (SELECT email FROM users WHERE keyword= '".$key."') AND dlp IS NOT NULL";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}

function get_dlpBodyPartPERC($key, $bodypart, $xmin, $xmax, $ymin, $ymax){
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when dlp BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(ct_sums.date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then dlp end ORDER BY dlp SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM ct_sums JOIN ct_filters ON ct_filters.examid = ct_sums.examid WHERE ct_filters.bodypart = '".$bodypart."' AND ct_filters.email=(SELECT email FROM users WHERE keyword= '".$key."') AND dlp IS NOT NULL";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}

function get_CTDIwBodyPartPERC($key, $bodypart, $xmin, $xmax, $ymin, $ymax){
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when allCTdata.ctdiw BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(allCTdata.date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then allCTdata.ctdiw end ORDER BY allCTdata.ctdiw SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM allCTdata WHERE allCTdata.bodypart = '".$bodypart."' AND allCTdata.email=(SELECT email FROM users WHERE keyword= '".$key."') AND ctdiw IS NOT NULL";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}

function get_CTDIwEquipmentAVG($key, $bodypart,$equipment, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT sum(ctdiw)/count(*) FROM allCTdata WHERE (unix_timestamp(allCTdata.date) * 1000)>= '".$xmin."' AND (unix_timestamp(allCTdata.date) * 1000) < '".$xmax."' AND ctdiw>= '".$ymin."' AND ctdiw <'".$ymax."' AND allCTdata.bodypart = '".$bodypart."' AND allCTdata.equipmentmodel ='".$equipment."' AND allCTdata.email=(SELECT email FROM users WHERE keyword= '".$key."')";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);

	echo json_encode($line["sum(ctdiw)/count(*)"]);


}

function get_DLPEquipmentAVG($key, $bodypart, $equipment, $xmin, $xmax,$ymin, $ymax) {
	
	
	$query = "SELECT avg(dlp) FROM `ct_sums` JOIN ct_filters ON ct_filters.examid = ct_sums.examid WHERE (unix_timestamp(ct_sums.date) * 1000)>= '".$xmin."' AND (unix_timestamp(ct_sums.date) * 1000) < '".$xmax."' AND dlp>= '".$ymin."' AND dlp <'".$ymax."' AND ct_filters.bodypart = '".$bodypart."' AND ct_filters.equipmentmodel = '".$equipment."' AND dlp!= 0 AND ct_filters.email=(SELECT email FROM users WHERE keyword= '".$key."')";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);

	echo json_encode($line["avg(dlp)"]);


}

function get_CTDIwEquipmentPERC($key, $bodypart, $equipment, $xmin, $xmax, $ymin, $ymax){
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when allCTdata.ctdiw BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(allCTdata.date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then allCTdata.ctdiw end ORDER BY allCTdata.ctdiw SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM allCTdata WHERE allCTdata.bodypart = '".$bodypart."' AND allCTdata.equipmentmodel = '".$equipment."' AND allCTdata.email=(SELECT email FROM users WHERE keyword= '".$key."') AND ctdiw IS NOT NULL";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}

function get_dlpEquipmentPERC($key, $bodypart, $equipment, $xmin, $xmax, $ymin, $ymax){
	
	$maxi = "SET SESSION group_concat_max_len = 10000000000;";
	$results = mysql_query($maxi) or die('Query failed: ' . mysql_error());
	$query = "SELECT SUBSTRING_INDEX( SUBSTRING_INDEX( GROUP_CONCAT(case when dlp BETWEEN '".$ymin."' and '".$ymax."' AND (unix_timestamp(ct_sums.date) * 1000) BETWEEN '".$xmin."' AND '".$xmax."' then dlp end ORDER BY dlp SEPARATOR ','),',',90/100 * COUNT(*) + 1 ),',',-1 ) `90th Percentile` FROM ct_sums JOIN ct_filters ON ct_filters.examid = ct_sums.examid WHERE ct_filters.bodypart = '".$bodypart."' AND ct_filters.equipmentmodel = '".$equipment."' AND ct_filters.email=(SELECT email FROM users WHERE keyword= '".$key."') AND dlp IS NOT NULL";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	
	echo json_encode($line["90th Percentile"]);
	


}


?>