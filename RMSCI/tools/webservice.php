<?php
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");

include '../connect.php';
include 'classes.php';

include 'CT.php';
include 'CR.php';
include 'MG.php';

ini_set('max_execution_time', 300);

$path = $_SERVER["PATH_INFO"];
if ($path != null) {
	$path_params = spliti ("/", $path);
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	

	if  (sizeof($path_params)==4) {
		if ($path_params[2] == "CR") {
			if ($path_params[3] == "IADP"){
				get_IADP($path_params[1]);
			} elseif ($path_params[3] == "VOLTAGE") {
				get_CRVOLTAGE($path_params[1]);
			} else {
				get_CR_EXPOSURETIME($path_params[1]);
			}
		}
		elseif ($path_params[2] == "MG") {
			if ($path_params[3] == "OrganDose"){
				get_OrganDose($path_params[1]);
			} elseif ($path_params[3] == "VOLTAGE") {
				get_MGVOLTAGE($path_params[1]);
			} elseif ($path_params[3] == "TIME") {
				get_MGTIME($path_params[1]);
			} else {
				get_MGCOMP($path_params[1]);
			}
		}
		elseif ($path_params[2] == "CT") {
			if ($path_params[3] == "CTDIw") {
				get_CTDIw($path_params[1]);
				
			} elseif ($path_params[3] == "DLP") {
				get_CTDLP($path_params[1]);
			}
		}
	}
		
	
	elseif (sizeof($path_params)==9) {
		if ($path_params[2] == "CT") {
			if ($path_params[4] == "PER") {
				if ($path_params[3] == "CTDIw") {
					get_CTDIwPERC($path_params[1], $path_params[5], $path_params[6], $path_params[7], $path_params[8]);
				} else {
					get_dlpPERC($path_params[1], $path_params[5], $path_params[6], $path_params[7], $path_params[8]);
				}
			} else{
				if ($path_params[3] == "CTDIw"){

					get_CTDIwAVG($path_params[1], $path_params[5], $path_params[6], $path_params[7], $path_params[8]);
				} else if ($path_params[3] == "DLP") {
					get_DLPAVG($path_params[1], $path_params[5], $path_params[6], $path_params[7], $path_params[8]);
				}
				
			} 
			
		} else if ($path_params[2] == "CR"){
			if ($path_params[4] == "PER") {
				if ($path_params[3] == "IADP"){
					get_DAPPERC($path_params[1], $path_params[5], $path_params[6], $path_params[7], $path_params[8]);
				} else if ($path_params[3] == "TIME") {
					get_DAPTimePERC($path_params[1], $path_params[5], $path_params[6], $path_params[7], $path_params[8]);
				}else if ($path_params[3] == "VOLTAGE") {
					get_DAPVoltagePERC($path_params[1], $path_params[5], $path_params[6], $path_params[7], $path_params[8]);
				}
				
			} else if ($path_params[4] == "AVG"){
				if ($path_params[3] == "IADP") {
					get_CRAVG($path_params[1], $path_params[5], $path_params[6], $path_params[7], $path_params[8]);	
				} else if ($path_params[3] == "TIME") {
					get_CRTIMEAVG($path_params[1], $path_params[5], $path_params[6], $path_params[7], $path_params[8]);	
				} else if ($path_params[3] == "VOLTAGE") {
					get_CRVOLTAGEAVG($path_params[1], $path_params[5], $path_params[6], $path_params[7], $path_params[8]);
				}
				
			}
		} else {
			if ($path_params[4] == "PER") {
				if ($path_params[3] == "OrganDose") {
					get_MGPERC($path_params[1], $path_params[5], $path_params[6], $path_params[7], $path_params[8]);
				} else if ($path_params[3] == "COMPFORCE") {
					get_MGCforcePERC($path_params[1], $path_params[5], $path_params[6], $path_params[7], $path_params[8]);
				} else if ($path_params[3] == "VOLTAGE") {
					get_MGVoltagePERC($path_params[1], $path_params[5], $path_params[6], $path_params[7], $path_params[8]);
				} else if ($path_params[3] == "TIME") {
					get_MGTimePERC($path_params[1], $path_params[5], $path_params[6], $path_params[7], $path_params[8]);
				}
				
			} else if ($path_params[4] == "AVG"){
				if ($path_params[3] == "OrganDose") {
					get_mgAVG($path_params[1], $path_params[5], $path_params[6], $path_params[7], $path_params[8]);
				} else if ($path_params[3] == "TIME") {
					get_mgTIMEAVG($path_params[1], $path_params[5], $path_params[6], $path_params[7], $path_params[8]);
				} else if ($path_params[3] == "VOLTAGE") {
					get_mgVOLTAGEAVG($path_params[1], $path_params[5], $path_params[6], $path_params[7], $path_params[8]);
				} else if ($path_params[3] == "COMPFORCE") {
					get_mgCOMPFORCEAVG($path_params[1], $path_params[5], $path_params[6], $path_params[7], $path_params[8]);
				}
				
			}
		}
	
	} elseif (sizeof($path_params)==10) {
		if ($path_params[5]=='AVG') {
			if ($path_params[3] == "CTDIw" && $path_params[2] == "CT" ) {
				get_CTDIwBodyPartAVG($path_params[1], $path_params[4], $path_params[6], $path_params[7], $path_params[8], $path_params[9]);
			} else if ($path_params[3] == "DLP" && $path_params[2] == "CT") {
				get_DLPBodyPartAVG($path_params[1], $path_params[4], $path_params[6], $path_params[7], $path_params[8], $path_params[9]);
			} else if ($path_params[3] == "IADP" && $path_params[2] == "CR" ) {
				get_CRBodypartAVG($path_params[1], $path_params[4], $path_params[6], $path_params[7], $path_params[8], $path_params[9]);
				
			} else if ($path_params[3] == "TIME" && $path_params[2] == "CR") {
				get_CRTIMEBodypartAVG($path_params[1], $path_params[4], $path_params[6], $path_params[7], $path_params[8], $path_params[9]);
			} else if ($path_params[3] == "VOLTAGE" && $path_params[2] == "CR") {
				get_CRVOLTAGEbodypartAVG($path_params[1], $path_params[4], $path_params[6], $path_params[7], $path_params[8], $path_params[9]);
			} else if ($path_params[3] == "OrganDose" && $path_params[2] == "MG") {
				get_mgThicknessAVG($path_params[1], $path_params[4], $path_params[6], $path_params[7], $path_params[8], $path_params[9]);
			} else if ($path_params[3] == "COMPFORCE" && $path_params[2] == "MG") {
				get_mgCOMPFORCEquipEAVG($path_params[1], $path_params[4], $path_params[6], $path_params[7], $path_params[8], $path_params[9]);
			} else if ($path_params[3] == "TIME" && $path_params[2] == "MG") {
				get_mgTIMEEquipAVG($path_params[1], $path_params[4], $path_params[6], $path_params[7], $path_params[8], $path_params[9]);
			} else if ($path_params[3] == "VOLTAGE" && $path_params[2] == "MG") {
				get_mgVOLTAGEEquipAVG($path_params[1], $path_params[4], $path_params[6], $path_params[7], $path_params[8], $path_params[9]);
			}
		} else if ($path_params[5]=='PER') {
			if ($path_params[3] == "DLP" && $path_params[2] == "CT"){
				get_dlpBodyPartPERC($path_params[1], $path_params[4], $path_params[6], $path_params[7], $path_params[8], $path_params[9]);
			} else if ($path_params[3] == "CTDIw" && $path_params[2] == "CT") {
				get_CTDIwBodyPartPERC($path_params[1], $path_params[4], $path_params[6], $path_params[7], $path_params[8], $path_params[9]);
			} else if ($path_params[3] == "IADP" && $path_params[2] == "CR") {
				get_DAPBodypartPERC($path_params[1], $path_params[4], $path_params[6], $path_params[7], $path_params[8], $path_params[9]);
			} else if ($path_params[3] == "TIME" && $path_params[2] == "CR") {
				get_DAPTimeBodypartPERC($path_params[1], $path_params[4], $path_params[6], $path_params[7], $path_params[8], $path_params[9]);
			} else if ($path_params[3] == "VOLTAGE" && $path_params[2] == "CR") {
				get_DAPVoltageBodypartPERC($path_params[1], $path_params[4], $path_params[6], $path_params[7], $path_params[8], $path_params[9]);
			} else if ($path_params[3] == "OrganDose" && $path_params[2] == "MG") {
				get_MGThickPERC($path_params[1], $path_params[4], $path_params[6], $path_params[7], $path_params[8], $path_params[9]);
			} else if ($path_params[3] == "COMPFORCE" && $path_params[2] == "MG") {
				get_MGCforceEquipmentPERC($path_params[1], $path_params[4], $path_params[6], $path_params[7], $path_params[8], $path_params[9]);
				
			} else if ($path_params[3] == "TIME" && $path_params[2] == "MG") {
				get_MGtimeEquipPERC($path_params[1], $path_params[4], $path_params[6], $path_params[7], $path_params[8], $path_params[9]);
			} else if ($path_params[3] == "VOLTAGE" && $path_params[2] == "MG") {
				get_MGVoltageEquipPERC($path_params[1], $path_params[4], $path_params[6], $path_params[7], $path_params[8], $path_params[9]);
			}
				
		
		}
	} else if (sizeof($path_params)==11) {
		if ($path_params[6]=='AVG') {
			if ($path_params[3] == "CTDIw" && $path_params[2] == "CT" ) {
				get_CTDIwEquipmentAVG($path_params[1], $path_params[4], $path_params[5], $path_params[7], $path_params[8], $path_params[9], $path_params[10]);
			} else if ($path_params[3] == "DLP" && $path_params[2] == "CT" ) {
				get_DLPEquipmentAVG($path_params[1], $path_params[4], $path_params[5], $path_params[7], $path_params[8], $path_params[9], $path_params[10]);
				
			} else if ($path_params[3] == "IADP" && $path_params[2] == "CR" ) {
				get_CRSeriesAVG($path_params[1], $path_params[4], $path_params[5], $path_params[7], $path_params[8], $path_params[9], $path_params[10]);
				
			} else if ($path_params[3] == "TIME" && $path_params[2] == "CR") {
				get_CRTIMESeriesAVG($path_params[1], $path_params[4], $path_params[5], $path_params[7], $path_params[8], $path_params[9], $path_params[10]);
			} else if ($path_params[3] == "VOLTAGE" && $path_params[2] == "CR") {
				get_CRVOLTAGEseriesAVG($path_params[1], $path_params[4], $path_params[5], $path_params[7], $path_params[8], $path_params[9], $path_params[10]);
			} else if ($path_params[3] == "OrganDose" && $path_params[2] == "MG") {
				get_mgEquipAVG($path_params[1], $path_params[4], $path_params[5], $path_params[7], $path_params[8], $path_params[9], $path_params[10]);
			}
		} else if ($path_params[6]=='PER') {
			if ($path_params[3] == "CTDIw" && $path_params[2] == "CT" ) {
				get_CTDIwEquipmentPERC($path_params[1], $path_params[4], $path_params[5], $path_params[7], $path_params[8], $path_params[9], $path_params[10]);
			} else if ($path_params[3] == "DLP" && $path_params[2] == "CT" ) {
				get_dlpEquipmentPERC($path_params[1], $path_params[4], $path_params[5], $path_params[7], $path_params[8], $path_params[9], $path_params[10]);
				
			} else if ($path_params[3] == "IADP" && $path_params[2] == "CR") {
				get_DAPSeriesPERC($path_params[1], $path_params[4], $path_params[5], $path_params[7], $path_params[8], $path_params[9], $path_params[10]);
			}  else if ($path_params[3] == "TIME" && $path_params[2] == "CR") {
				get_CRTIMESeriesPER($path_params[1], $path_params[4], $path_params[5], $path_params[7], $path_params[8], $path_params[9], $path_params[10]);
			}  else if ($path_params[3] == "VOLTAGE" && $path_params[2] == "CR") {
				get_DAPVoltageSEriesPERC($path_params[1], $path_params[4], $path_params[5], $path_params[7], $path_params[8], $path_params[9], $path_params[10]);
			} else if ($path_params[3] == "OrganDose" && $path_params[2] == "MG") {
				get_MGEquipmPERC($path_params[1], $path_params[4], $path_params[5], $path_params[7], $path_params[8], $path_params[9], $path_params[10]);
			}
			
		}
		
	} else if (sizeof($path_params)==12) {
		if ($path_params[7]=='AVG') {
			if ($path_params[3] == "IADP") {
				get_CREquipmentAVG($path_params[1], $path_params[4], $path_params[5], $path_params[6], $path_params[8], $path_params[9], $path_params[10], $path_params[11]);
			} else if ($path_params[3] == "TIME") {
				get_CRTIMEEquipmentAVG($path_params[1], $path_params[4], $path_params[5], $path_params[6], $path_params[8], $path_params[9], $path_params[10], $path_params[11]);
			} else if ($path_params[3] == "VOLTAGE") {
				get_CRVOLTAGEequipmentAVG($path_params[1], $path_params[4], $path_params[5], $path_params[6], $path_params[8], $path_params[9], $path_params[10], $path_params[11]);
			}
		} else if ($path_params[7]=='PER') {
			if ($path_params[3] == "IADP") {
				
				get_DAPEquipmentPERC($path_params[1], $path_params[4], $path_params[5], $path_params[6], $path_params[8], $path_params[9], $path_params[10], $path_params[11]);
			} else if ($path_params[3] == "TIME"){
				get_CRTIMEEquipmentPER($path_params[1], $path_params[4], $path_params[5], $path_params[6], $path_params[8], $path_params[9], $path_params[10], $path_params[11]);
			} else if ($path_params[3] == "VOLTAGE"){
				get_DAPVoltageEquipmentPERC($path_params[1], $path_params[4], $path_params[5], $path_params[6], $path_params[8], $path_params[9], $path_params[10], $path_params[11]);
			}
		}
	}
}


?>
