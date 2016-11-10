<!DOCTYPE html>
<?php   
session_start();
include 'connect.php';

$key = $_GET['key'];

$sql = "SELECT keyword FROM users WHERE keyword='$key'";
$result = mysql_query($sql);
$row=mysql_fetch_array($result);

if($row[0]!='') {
	$_SESSION["key"]=$key;
	$query = mysql_query("SELECT email FROM users WHERE keyword='$key'");
	$email = mysql_fetch_array($query, MYSQL_ASSOC);
	$_SESSION["email"]=$email["email"];
	$query1 = mysql_query("SELECT user FROM users WHERE keyword='$key'");
	$user = mysql_fetch_array($query1, MYSQL_ASSOC);
	$_SESSION["user"]=$user["user"];
	

} else {
    echo "<script>window.location='http://rmsci.fc.ul.pt';</script>";
	
}


  ?>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Radiation Monitoring System in Clinical Imaging</title>
     <!--REQUIRED STYLE SHEETS-->
    
     <!-- FONTAWESOME STYLE CSS -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!-- VEGAS STYLE CSS -->
    
       <!-- CUSTOM STYLE CSS -->
    <link href="assets/css/style.css" rel="stylesheet" />
     <!-- GOOGLE FONT -->
     <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
     <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
     	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://code.highcharts.com/stock/highstock.js"></script>
				<script src="https://code.highcharts.com/modules/exporting.js"></script>

	
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	<script src="upload.js"></script>
	<script type="text/javascript">
/**
 * Dark theme for Highcharts JS
 * @author Torstein Honsi
 */

// Load the fonts
Highcharts.createElement('link', {
   href: '//fonts.googleapis.com/css?family=Unica+One',
   rel: 'stylesheet',
   type: 'text/css'
}, null, document.getElementsByTagName('head')[0]);

Highcharts.theme = {
   colors: ["#2b908f", "#90ee7e", "#f45b5b", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee",
      "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],
   chart: {
      backgroundColor: {
         
         
      },
      style: {
         fontFamily: 'Open Sans'
      },
      
   },
   title: {
      style: {
         color: '#E0E0E3',
         textTransform: 'uppercase',
         fontSize: '20px'
      }
   },
   subtitle: {
      style: {
         color: '#E0E0E3',
         textTransform: 'uppercase'
      }
   },
   xAxis: {
      gridLineColor: '#707073',
      labels: {
         style: {
            color: '#E0E0E3'
         }
      },
      lineColor: '#707073',
      minorGridLineColor: '#505053',
      tickColor: '#707073',
      title: {
         style: {
            color: '#A0A0A3'

         }
      }
   },
   yAxis: {
      gridLineColor: '#707073',
      labels: {
         style: {
            color: '#E0E0E3'
         }
      },
      lineColor: '#707073',
      minorGridLineColor: '#505053',
      tickColor: '#707073',
      tickWidth: 1,
      title: {
         style: {
            color: '#A0A0A3'
         }
      }
   },
   tooltip: {
      backgroundColor: 'rgba(0, 0, 0, 0.85)',
      style: {
         color: '#F0F0F0'
      }
   },
   plotOptions: {
      series: {
         dataLabels: {
            color: '#B0B0B3'
         },
         marker: {
            lineColor: '#333'
         }
      },
      boxplot: {
         fillColor: '#505053'
      },
      candlestick: {
         lineColor: 'white'
      },
      errorbar: {
         color: 'white'
      }
   },
   legend: {
      itemStyle: {
         color: '#E0E0E3'
      },
      itemHoverStyle: {
         color: '#FFF'
      },
      itemHiddenStyle: {
         color: '#606063'
      }
   },
   credits: {
      style: {
         color: '#666'
      }
   },
   labels: {
      style: {
         color: '#707073'
      }
   },

   drilldown: {
      activeAxisLabelStyle: {
         color: '#F0F0F3'
      },
      activeDataLabelStyle: {
         color: '#F0F0F3'
      }
   },

   navigation: {
      buttonOptions: {
         symbolStroke: '#DDDDDD',
         theme: {
            fill: '#505053'
         }
      }
   },

   // scroll charts
   rangeSelector: {
      buttonTheme: {
         fill: '#505053',
         stroke: '#000000',
         style: {
            color: '#CCC'
         },
         states: {
            hover: {
               fill: '#707073',
               stroke: '#000000',
               style: {
                  color: 'white'
               }
            },
            select: {
               fill: '#000003',
               stroke: '#000000',
               style: {
                  color: 'white'
               }
            }
         }
      },
      inputBoxBorderColor: '#505053',
      inputStyle: {
         backgroundColor: '#333',
         color: 'silver'
      },
      labelStyle: {
         color: 'silver'
      }
   },

   navigator: {
      handles: {
         backgroundColor: '#666',
         borderColor: '#AAA'
      },
      outlineColor: '#CCC',
      maskFill: 'rgba(255,255,255,0.1)',
      series: {
         color: '#7798BF',
         lineColor: '#A6C7ED'
      },
      xAxis: {
         gridLineColor: '#505053'
      }
   },

   scrollbar: {
      barBackgroundColor: '#808083',
      barBorderColor: '#808083',
      buttonArrowColor: '#CCC',
      buttonBackgroundColor: '#606063',
      buttonBorderColor: '#606063',
      rifleColor: '#FFF',
      trackBackgroundColor: '#404043',
      trackBorderColor: '#404043'
   },

   // special colors for some of the
   legendBackgroundColor: 'grey',
   background2: '#505053',
   dataLabelsColor: '#B0B0B3',
   textColor: '#C0C0C0',
   contrastTextColor: '#F0F0F3',
   maskColor: 'rgba(255,255,255,0.3)'
};

// Apply the theme
Highcharts.setOptions(Highcharts.theme);


// check the user					
var key = location.search.split('key=')[1];
if (key == undefined) {
	var key = 'public';
}
	
var mod = [];
function modalities() {
						
	$.ajax({
		url: "modalities.php", // Url to which the request is send
		type: "GET",             // Type of request to be send, called as method
		cache: false,
		contentType: false, 
		data: new FormData(this),
		processData: false,            // To unable request pages to be cached
		success: function(data)   // A function to be called if request succeeds
		{
			
			
			if ($.inArray(data, mod)==-1) {
				mod = [];
				
				$('#s1').empty().append(data);
				$("#s1").prepend("<option value='mod'>Choose the modality</option>");
			
				selects('s1').selectedIndex=0;
			
				
    			mod.push(data);
			}
			
			
			
			
		
		}
		});
	setTimeout (modalities, 5000);
	
	
}
modalities();

//AJAX DELAY

var CRlength = 0;
var CTlength = 0;
var MGlength = 0;
var counter = 1;

function ajaxDelay() {
	
	$.ajax({
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/CR/IADP',
		success: function (CRdata) {
			
			
			if (CRdata!=null) {
				if (CRdata.length!=CRlength) {
					CRlength = CRdata.length;
					show_select();
				}
			} 
				
			
			if (CRlength=='erro') {
				
				CRlength = CRdata.length;
				show_select();
			}
				
			
			
		},
		error: function(error) {
			
			CRlength = 'erro';
			
		}


	});
	
	$.ajax({
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/CT/DLP',
		success: function (CTdata) {
			
			if (CTdata!=null) {
				if (CTdata.length!=CTlength) {
					CTlength = CTdata.length;
					show_select();
				}
			} 
			if (CTlength=='erro') {
				
				CTlength = CTdata.length;
				show_select();
			}
			
		},
		error: function(error) {
			
			CTlength = 'erro';
		}


	});
	
	$.ajax({
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/MG/OrganDose',
		success: function (MGdata) {

			if (MGdata!=null) {
				if (MGdata.length!=MGlength) {
					MGlength = MGdata.length;
					show_select();
				}
			} 
			if (MGlength=='erro') {
				
				MGlength = MGdata.length;
				show_select();
			}
			
			
		},
		error: function(error) {
			MGlength = 'erro';
		}


	});
	
	setTimeout (ajaxDelay, 5000);


	
}




// GENERAL FUNCTIONS

function getCTEquipment(data) {
	var type1 = $("#s2 option:selected").text();
	var type2 = $("#s4 option:selected").text();
	var indexes = [];

	$.each(data, function(i, p) {
									
		if (p.equipmentModel == type2 && p.bodyPart.indexOf(type1) > -1) {
														
				indexes.push({"x":p.x, "y":p.y, "bodyPart":p.bodyPart, "equipmentModel":p.equipmentModel});
		  
		}
									
	});

						
	return indexes;
}

function getCREquipment(data) {
	var type1 = $("#s2 option:selected").text();
	var type2 = $("#s4 option:selected").text();
	var type5 = $("#s5 option:selected").text();
	var indexes = [];
	$.each(data, function(i, p) {
		if (p.bodyPart.indexOf(type1) > -1 && p.seriesDescription.indexOf(type5) > -1 && p.equipmentModel.indexOf(type2) > -1){
									
			indexes.push({"x":p.x, "y":p.y, "bodyPart":p.bodyPart, "equipmentModel":p.equipmentModel});

		}
	});

	return indexes;
}

function getSeriesDesc (data) {
	var chart = $('#chart').highcharts();
	var type1 = $("#s2 option:selected").text();
	var type5 = $("#s5 option:selected").text();
	var type3 = $("#s3 option:selected").text();
	var indexes = [];
	$.each(data, function(i, p) {
		if (p.bodyPart.indexOf(type1) > -1 && p.seriesDescription.indexOf(type5) > -1){
																		
			indexes.push({"x":p.x, "y":p.y, "bodyPart":p.bodyPart, "equipmentModel":p.equipmentModel});
						  
		}
	});
	chart.yAxis[0].removePlotLine('ref');
	chart.yAxis[0].removePlotBand('ref');
	if (type3=='Radiation Dose (DAP)') {
		
		refs ={'Skull pa':[600,1000], 'Skull ap':[600,1000], 'Skull lat':[500,1000], 'Chest pa':[120,1000], 'Chest lat':[250,1000], 'Thoracic spine ap': [970,2200], 'Thoracic spine lat':[1200,3200], 'Abdomen pa':[2000,8000], 'Abdomen ap':[2000,8000], 'Lumbar spine ap':[1500,10000], 'Lumbar spine lat':[2750,8000], 'Pelvis ap':[1500,7000]}
		if (refs[type5] != undefined) {				
								
			
				chart.yAxis[0].addPlotBand({
					from: refs[type5][0],
					to: refs[type5][1],
					color: 'red',
					id: 'ref',				
					label:{
						text: 'DAP European Guideline: '+refs[type5][0]+'-'+refs[type5][1]+' mGy.cm²',
						style: {
			color: 'white',
			fontWeight: 'bold'
					}}
				});
				
				chart.series[3].setData([{"x":1437001200000,"y":refs[type5][0]}, {"x":1437001200000,"y":refs[type5][1]}]);
		}
	} else if (type3=='Exposure time') {
		refs ={'Skull pa':0.1, 'Skull lat':0.1, 'Chest pa':0.02, 'Chest lat':0.04, 'Lumbar spine ap':0.4, 'Lumbar spine lat':1, 'Pelvis ap':0.4}
		if (refs[type5] != undefined) {					
			
			chart.yAxis[0].addPlotLine({
						value: refs[type5],
						color: 'red',
						id: 'ref',
						width: 3,
						label:{
							text: 'Exposure Time European Guideline: < '+refs[type5]+' secs',
							style: {
				color: 'red',
				fontWeight: 'bold'
						}}
					});
					
			chart.series[3].setData([{"x":1437001200000,"y":refs[type5]}]);
		}
		
	} else if (type3=='Voltage') {

		refs ={'Skull pa':[70,85], 'Skull lat':[70,85], 'Chest pa':125, 'Chest lat':125, 'Lumbar spine ap':[75,90], 'Lumbar spine lat':[80,95], 'Pelvis ap':[75,95]}
		if (refs[type5] != undefined) {					
			if (type5 == 'Chest pa' || type5=='Chest lat') {
				;
					chart.yAxis[0].addPlotLine({
						value: refs[type5],
						color: 'red',
						id: 'ref',
						width: 3,
						label:{
							text: 'Voltage European Guideline: '+refs[type5]+' kV',
							style: {
				color: 'red',
				fontWeight: 'bold'
						}}
					});
					
					chart.series[3].setData([{"x":1437001200000,"y":refs[type5]}]);
			
			} else {
				
					chart.yAxis[0].addPlotBand({
						from: refs[type5][0],
						to: refs[type5][1],
						color: 'red',
						id: 'ref',				
						label:{
							text: 'Voltage European Guideline: '+refs[type5][0]+'-'+refs[type5][1]+'kV',
							style: {
				color: 'white',
				fontWeight: 'bold'
						}}
					});
					
					chart.series[3].setData([{"x":1437001200000,"y":refs[type5][0]}, {"x":1437001200000,"y":refs[type5][1]}]);
			}
		}
	}
	
				
	return indexes;
}
					
function getBodyPart (data) {
	var type1 = $("#s2 option:selected").text();
	var indexes = [];

	$.each(data, function(i, p) {

		if (p.bodyPart.indexOf(type1) > -1) {
														
			indexes.push({"x":p.x, "y":p.y, "bodyPart":p.bodyPart, "equipmentModel":p.equipmentModel});
		  
		}
	});
						
return indexes;
}
					
function getMGEquipment1(data) {
	
	var type1 = $("#s2 option:selected").text();
	var type2 = $("#s4 option:selected").text();
	var type5 = $("#s5 option:selected").text();
	var indexes = [];
	$.each(data, function(i, p) {
		if (p.sliceThickness_cm==type1 && p.equipmentModel==type2){
									
			indexes.push({"x":p.x, "y":p.y, "sliceThickness_cm":p.sliceThickness_cm, "equipmentModel":p.equipmentModel});

		}
	});

	return indexes;
}

function getMGOthersEquipment(data) {
	
	var type2 = $("#s4 option:selected").text();
	
	var indexes = [];
	$.each(data, function(i, p) {
		if (p.equipmentModel == type2){
									
			indexes.push({"x":p.x, "y":p.y,"equipmentModel":p.equipmentModel});

		}
	});

	return indexes;
}

function getMGthickness1(data) {
	var type1 = $("#s2 option:selected").text();
	
	
	var indexes = [];
	$.each(data, function(i, p) {

		if (p.sliceThickness_cm ==type1) {
														
			indexes.push({"x":p.x, "y":p.y, "sliceThickness_cm":p.sliceThickness_cm, "equipmentModel":p.equipmentModel});
		  
		}
	});
	if ([2.1, 3.2, 4.5, 5.3, 6, 7.5, 9].indexOf(parseFloat($("#s2 option:selected").text())) > -1 ) {
		refs ={2.1:1, 3.2:1.5, 4.5:2, 5.3:2.5, 6:3, 7.5:4.5, 9:6.5};
		chart.yAxis[0].removePlotLine('ref');
		chart.yAxis[0].addPlotLine({
						value: refs[parseFloat($("#s2 option:selected").text())],
						color: 'red',
						id: 'ref',
						width: 3,
						label:{
							text: 'Organ Dose European Guideline: < '+refs[parseFloat($("#s2 option:selected").text())]+' mGy',
							style: {
				color: 'red',
				fontWeight: 'bold'
						}}
					});
				
				chart.series[3].setData([{"x":1437001200000,"y":refs[parseFloat($("#s2 option:selected").text())]}]);
	} else {
		if (parseFloat($("#s2 option:selected").text())<7.5) {
			var refr = parseFloat($("#s2 option:selected").text())/2.1;
			chart.yAxis[0].removePlotLine('ref');
			chart.yAxis[0].addPlotLine({
		value: refr,
		color: 'red',
		width: 3,
		id: 'ref',
		label:{
			text: ' Organ Dose European Guideline: < '+refr.toFixed(2)+' mGy',
			style: {
				color: 'red',
				fontWeight: 'bold'
		}
			}
	});
	
	chart.series[3].setData([{"x":1437001200000,"y":refr}]);	
		} else {
			var refr = parseFloat($("#s2 option:selected").text())*6.5/9;

		chart.yAxis[0].removePlotLine('ref');
		chart.yAxis[0].addPlotLine({
		value: refr,
		color: 'red',
		width: 3,
		id: 'ref',
		label:{
			text: ' Organ Dose European Guideline: < '+refr.toFixed(2)+' mGy',
			style: {
				color: 'red',
				fontWeight: 'bold'
		}
			}
	});
	
	chart.series[3].setData([{"x":1437001200000,"y":refr}]);	
			
		}
		
		
	}
	

	
	return indexes;
}

function getMGEquipments(data) {
	var type1 = $("#s2 option:selected").text();
	var type2 = $("#s4 option:selected").text();
	var type5 = $("#s5 option:selected").text();
	var indexes = [];
	$.each(data, function(i, p) {
		if (p.sliceThickness_cm.indexOf(type1) > -1 && p.equipmentModel.indexOf(type2) > -1){
									
			indexes.push({"x":p.x, "y":p.y, "sliceThickness_cm":p.sliceThickness_cm, "equipmentModel":p.equipmentModel});

		}
	});
		
	return indexes;
}



				




// CR FUNCTIONS


function getCR(par) {
$.ajax({
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/CR/' + par,
		success: function (CR) {
			
			chart = $('#chart').highcharts();
			chart.yAxis[0].removePlotLine('ref');
			chart.yAxis[0].removePlotBand('ref');
			chart.series[3].setData([]);
			chart.series[1].setData(CR);
			chart.series[1].show();
			AvgPer();	
		},
		timeout: 5000
	});
}

function getCRStats(par, stats) {
	var chart = $('#chart').highcharts();
$.ajax({
		
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/CR/' + par + '/' + stats + '/' + Math.round(chart.xAxis[0].getExtremes().min) +
                '/' + Math.round(chart.xAxis[0].getExtremes().max) +'/' + chart.yAxis[0].getExtremes().min +'/' + chart.yAxis[0].getExtremes().max,
		success: function (DAPStats) {
			if (selects('avg').checked && stats =='AVG') {
				switch (par) {
					case 'IADP':
						chart.yAxis[0].removePlotLine('DAPavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(DAPStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPavg',
											
						label:{
								text: 'DAP Average: '  + parseFloat(DAPStats).toFixed(2) + ' mGy.cm²',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'TIME':
						chart.yAxis[0].removePlotLine('DAPtimeavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(DAPStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPtimeavg',
											
						label:{
								text: 'Exposure Time Average: '  + parseFloat(DAPStats).toFixed(2) + ' secs',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'VOLTAGE':
						chart.yAxis[0].removePlotLine('DAPvoltageavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(DAPStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPvoltageavg',
											
						label:{
								text: 'Voltage Average: '  + parseFloat(DAPStats).toFixed(2) + ' kV',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
												});
						break;
				}
			
			} else if (selects('percentile').checked && stats =='PER') {
				switch (par) {
					case 'IADP':
						chart.yAxis[0].removePlotLine('DAPper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(DAPStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPper',
						dashStyle: 'shortdash',				
						label:{
								text: 'IADP 90th Percentile: '  + parseFloat(DAPStats).toFixed(2) + ' mGy.cm²',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'TIME':
						chart.yAxis[0].removePlotLine('DAPtimeper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(DAPStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPtimeper',
						dashStyle: 'shortdash',				
						label:{
								text: 'Exposure Time 90th Percentile: '  + parseFloat(DAPStats).toFixed(2) + ' secs',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'VOLTAGE':
						chart.yAxis[0].removePlotLine('DAPvoltageper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(DAPStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPvoltageper',
						dashStyle: 'shortdash',				
						label:{
								text: 'Voltage 90th Percentile: '  + parseFloat(DAPStats).toFixed(2) + ' kV',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
			
						break;
				}
				
			}
			
		},
		timeout: 5000
	});
}

function getCRBodypartStats(par, stats) {
	var chart = $('#chart').highcharts();
$.ajax({
		
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key +'/CR/' + par + '/' + selects('s2').value + '/' + stats + '/' + Math.round(chart.xAxis[0].getExtremes().min) +
                '/' + Math.round(chart.xAxis[0].getExtremes().max) +'/' + chart.yAxis[0].getExtremes().min +'/' + chart.yAxis[0].getExtremes().max,
		success: function (CRBodyStats) {
			if (selects('avg').checked && stats == 'AVG') {
				switch (par) {
					case 'IADP':
						chart.yAxis[0].removePlotLine('DAPBodyavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CRBodyStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPBodyavg',
											
						label:{
								text: 'DAP Average: '  + parseFloat(CRBodyStats).toFixed(2) + ' mGy.cm²',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
												});
												
						break;
						
					
					case 'TIME':
						chart.yAxis[0].removePlotLine('DAPtimeBodypavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CRBodyStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPtimeBodypavg',
											
						label:{
								text: 'Exposure Time Average: '  + parseFloat(CRBodyStats).toFixed(3) + ' secs',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
												});
						break;
						
					case 'VOLTAGE':
						chart.yAxis[0].removePlotLine('DAPvoltageBodypartavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CRBodyStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPvoltageBodypartavg',
											
						label:{
								text: 'Voltage Average: '  + parseFloat(CRBodyStats).toFixed(2) + ' kV',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
						break;
					
				}
			
			} else if (selects('percentile').checked && stats == 'PER') {
				switch (par) {
					case 'IADP':
						chart.yAxis[0].removePlotLine('DAPBodypartper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CRBodyStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPBodypartper',
						dashStyle: 'shortdash',				
						label:{
								text: 'DAP 90th Percentile: '  + parseFloat(CRBodyStats).toFixed(2) + ' mGy.cm²',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
												
						break;
						
					
					case 'TIME':
						chart.yAxis[0].removePlotLine('DAPtimeBodyper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CRBodyStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPtimeBodyper',
						dashStyle: 'shortdash',				
						label:{
								text: 'Exposure Time 90th Percentile: '  + parseFloat(CRBodyStats).toFixed(3) + ' secs',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'VOLTAGE':
						chart.yAxis[0].removePlotLine('DAPvoltageBodypartper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CRBodyStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPvoltageBodypartper',
						dashStyle: 'shortdash',				
						label:{
								text: 'Voltage 90th Percentile: '  + parseFloat(CRBodyStats).toFixed(2) + ' kV',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
						break;
					
				}
			
				
				
			}
			
		},
		timeout: 5000
	});
}

function CRSeriesStats(par, stats) {
	var chart = $('#chart').highcharts();
$.ajax({
		
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/CR/' + par + '/' + selects('s2').value + '/' + selects('s5').value + '/' + stats + '/' + Math.round(chart.xAxis[0].getExtremes().min) +
                '/' + Math.round(chart.xAxis[0].getExtremes().max) +'/' + chart.yAxis[0].getExtremes().min +'/' + chart.yAxis[0].getExtremes().max,
		success: function (CRSeriesStats) {
			if (selects('avg').checked && stats == 'AVG') {
				switch (par) {
					case 'IADP':
						chart.yAxis[0].removePlotLine('DAPSeriesavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CRSeriesStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPSeriesavg',
											
						label:{
								text: 'DAP Average: '  + parseFloat(CRSeriesStats).toFixed(2) + ' mGy.cm²',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'TIME':
						chart.yAxis[0].removePlotLine('DAPtimeSeriesavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CRSeriesStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPtimeSeriesavg',
											
						label:{
								text: 'Exposure Time Average: '  + parseFloat(CRSeriesStats).toFixed(3) + ' secs',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'VOLTAGE':
						chart.yAxis[0].removePlotLine('DAPvoltageSeriesavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CRSeriesStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPvoltageSeriesavg',
											
						label:{
								text: 'Voltage Average: '  + parseFloat(CRSeriesStats).toFixed(2) + ' kV',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
						break;
					
				}

			} else if (selects('percentile').checked && stats == 'PER') {
				switch (par) {
					case 'IADP':
						chart.yAxis[0].removePlotLine('DAPSeriesper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CRSeriesStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPSeriesper',
						dashStyle: 'shortdash',				
						label:{
								text: 'DAP 90th Percentile: '  + parseFloat(CRSeriesStats).toFixed(2) + ' mGy.cm²',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'TIME':
						chart.yAxis[0].removePlotLine('DAPTIMESeriesper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CRSeriesStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPTIMESeriesper',
						dashStyle: 'shortdash',						
						label:{
								text: 'Exposure Time 90th Percentile: '  + parseFloat(CRSeriesStats).toFixed(2) + ' secs',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'VOLTAGE':
						chart.yAxis[0].removePlotLine('DAPvoltageSeriesper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CRSeriesStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPvoltageSeriesper',
						dashStyle: 'shortdash',				
						label:{
								text: 'Voltage 90th Percentile: '  + parseFloat(CRSeriesStats).toFixed(2) + ' kV',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
						
						break;
					
				}
			}	
			
		},
		timeout: 5000
	});
	
}

function CREquipmentStats(par, stats) {
	var chart = $('#chart').highcharts();
$.ajax({
		
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/CR/' + par + '/' + selects('s2').value + '/' + selects('s5').value + '/' + selects('s4').value + '/' + stats + '/' + Math.round(chart.xAxis[0].getExtremes().min) +
                '/' + Math.round(chart.xAxis[0].getExtremes().max) +'/' + chart.yAxis[0].getExtremes().min +'/' + chart.yAxis[0].getExtremes().max,
		success: function (CREquipmentStats) {
			if (selects('avg').checked && stats =='AVG') {
				switch (par) {
					case 'IADP':
						chart.yAxis[0].removePlotLine('DAPEquipmentavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CREquipmentStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPEquipmentavg',
											
						label:{
								text: 'DAP Average: '  + parseFloat(CREquipmentStats).toFixed(2) + ' mGy.cm²',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
						break;
					
					case 'TIME':
						chart.yAxis[0].removePlotLine('DAPtimeEquipavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CREquipmentStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPtimeEquipavg',
											
						label:{
								text: 'Exposure Time Average: '  + parseFloat(CREquipmentStats).toFixed(3) + ' secs',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'VOLTAGE':
						chart.yAxis[0].removePlotLine('DAPvoltageEquipmentavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CREquipmentStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPvoltageEquipmentavg',
											
						label:{
								text: 'Voltage Average: '  + parseFloat(CREquipmentStats).toFixed(2) + ' kV',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
						break;
				}
				
			
			} else if (selects('percentile').checked && stats =='PER') {
				switch (par) {
					case 'IADP':
						chart.yAxis[0].removePlotLine('DAPEquipmentper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CREquipmentStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPEquipmentper',
						dashStyle: 'shortdash',				
						label:{
								text: 'DAP 90th Percentile: '  + parseFloat(CREquipmentStats).toFixed(2) + ' mGy.cm²',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
						break;
					
					case 'TIME':
						chart.yAxis[0].removePlotLine('DAPTIMEequipper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CREquipmentStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPTIMEequipper',
						dashStyle: 'shortdash',						
						label:{
								text: 'Exposure Time 90th Percentile: '  + parseFloat(CREquipmentStats).toFixed(2) + ' secs',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'VOLTAGE':
						chart.yAxis[0].removePlotLine('DAPvoltageEquipmentper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CREquipmentStats),
						color: 'blue',
						width: 2,
						zIndex:2,
						id: 'DAPvoltageEquipmentper',
						dashStyle: 'shortdash',				
						label:{
								text: 'Voltage 90th Percentile: '  + parseFloat(CREquipmentStats).toFixed(2) + ' kV',
								style: {
									color: 'blue',
									fontWeight: 'bold'
									}}
						});
						break;
				}
				
			}
			
		},
		timeout: 5000
	});
	
}

function getCRBodypart(par) {
	return $.ajax({
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/CR/' + par,
		success: function (CRBodypart) {
			chart.series[3].setData([]);
			chart.yAxis[0].removePlotLine('ref');
			chart.yAxis[0].removePlotBand('ref');
			chart.series[1].setData(getBodyPart(CRBodypart));
			AvgPer();
		},
		timeout: 5000

	});
}

function getCRSeries(par) {
	var chart = $('#chart').highcharts();
	$.ajax({
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/CR/' + par,
		success: function (CRSeries) {
			chart.series[3].setData([]);
			chart.series[1].setData(getSeriesDesc(CRSeries));
			AvgPer();	
		},
		timeout: 5000

	});
}

function getCREquipments(par) {
	var chart = $('#chart').highcharts();
	$.ajax({
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/CR/' + par,
		success: function (CREquipment) {
			
			chart.series[1].setData(getCREquipment(CREquipment));
			AvgPer();
		},
		timeout: 5000

	});
}







// CT FUNCTIONS

function getCT(par) {
	$.ajax({
		
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/CT/' + par,
		success: function (CT) {
			chart = $('#chart').highcharts();
			
			
			chart.series[3].setData([]);
			chart.yAxis[0].removePlotLine('ref');
			chart.yAxis[0].removePlotBand('ref');
			chart.series[2].setData(CT);
			chart.series[2].show();
			AvgPer();	
			
			
		},
		
		
		timeout: 5000

	});
}

function getCTStats(par, stats) {
	var chart = $('#chart').highcharts();
$.ajax({
		
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/CT/' + par + '/' + stats + '/' + Math.round(chart.xAxis[0].getExtremes().min) +
                '/' + Math.round(chart.xAxis[0].getExtremes().max) +'/' + chart.yAxis[0].getExtremes().min +'/' + chart.yAxis[0].getExtremes().max,
		success: function (getCTStats) {
			if (selects('avg').checked && stats == 'AVG') {
				switch (par) {
					case 'DLP':
						chart.yAxis[0].removePlotLine('getDLPavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(getCTStats),
						color: 'yellow',
						width: 2,
						zIndex:2,
						id: 'getDLPavg',
											
						label:{
								text: 'DLP Average: '  + parseFloat(getCTStats).toFixed(2) + ' mGy.cm',
								style: {
									color: 'yellow',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'CTDIw':
						chart.yAxis[0].removePlotLine('CTDIwavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(getCTStats),
						color: 'yellow',
						width: 2,
						zIndex:2,
						id: 'CTDIwavg',
											
						label:{
								text: 'CTDIw Average: '  + parseFloat(getCTStats).toFixed(2)+ ' mGy',
								style: {
									color: 'yellow',
									fontWeight: 'bold'
									}}
						});
						break;
				}
				
			
			} else if (selects('percentile').checked && stats == 'PER') {
				switch (par) {
					case 'DLP':
						chart.yAxis[0].removePlotLine('DLPper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(getCTStats),
						color: 'yellow',
						width: 2,
						zIndex:2,
						id: 'DLPper',
						dashStyle: 'shortdash',					
						label:{
								text: 'DLP 90th Percentile: '  + parseFloat(getCTStats).toFixed(2) + ' mGy.cm',
								style: {
									color: 'yellow',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'CTDIw':
						chart.yAxis[0].removePlotLine('CTDIwper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(getCTStats),
						color: 'yellow',
						width: 2,
						zIndex:2,
						id: 'CTDIwper',
						dashStyle: 'shortdash',					
						label:{
								text: 'CTDIw 90th Percentile: '  + parseFloat(getCTStats).toFixed(2) + ' mGy',
								style: {
									color: 'yellow',
									fontWeight: 'bold'
									}}
						});
						break;
				}
				
			}
			
		},
		timeout: 5000
	});
}

function getCTBodypart(par) {
	$.ajax({
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/CT/' + par,
		success: function (CTBodypart) {
			chart.yAxis[0].removePlotLine('ref');
			chart.series[3].setData([]);
			var type1 = $("#s2 option:selected").text();
			switch (par) {
				case 'DLP':
					
					chart.series[2].setData(getBodyPart(CTBodypart));
					
					refs = {"ABDOMEN":780, "CHEST":650, "HEAD":1050, "PELVIS":570, "SPINE":780, "NECK": 1050}
					if (refs[type1] != undefined) {
						chart.yAxis[0].removePlotLine('ref');
						chart.yAxis[0].addPlotLine({
							value: refs[type1],
							color: 'red',
							width: 3,
							id: 'ref',				
							label:{
								text: 'DLP European Guideline: '+refs[type1]+' mGy.cm',
								style: {
									color: 'red',
									fontWeight: 'bold'
										}
								}
							});
						chart.series[3].setData([{"x":1445295600000,"y":refs[type1]}]);
					
						
					}
					break;
					
				case 'CTDIw':
					
					chart.series[2].setData(getBodyPart(CTBodypart));
					
					refs = {"ABDOMEN":35, "CHEST":30, "HEAD":60, "PELVIS":35, "SPINE":35, "NECK":60}
					if (refs[type1] != undefined) {
						chart.yAxis[0].removePlotLine('ref');
							chart.yAxis[0].addPlotLine({
								value: refs[type1],
								color: 'red',
								width: 3,
								id: 'ref',				
								label:{
									text: 'CTDIw European Guideline: '+refs[type1]+' mGy',
									style: {
										color: 'red',
										fontWeight: 'bold'
											}
									}
								});
							chart.series[3].setData([{"x":1445295600000,"y":refs[type1]}]);
					}
					break;
			
				
			}
			AvgPer();
		},
		timeout: 5000

	});
	
}

function getCTEquipments(par) {
	$.ajax({
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/CT/'+ par,
		success: function (CTEquipment) {
			switch (par) {
				case 'DLP':
					chart.series[2].setData(getCTEquipment(CTEquipment));
					break;
					
				case 'CTDIw':
					chart.series[2].setData(getCTEquipment(CTEquipment));
					break;
			
			}
			
			
			AvgPer();
			
		},
		timeout: 5000

	});
}

function getCTBodyPartStats(par, stats) {
	var chart = $('#chart').highcharts();
	$.ajax({
		
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key +'/CT/' + par + '/' + selects('s2').value + '/' + stats + '/' + Math.round(chart.xAxis[0].getExtremes().min) +
                '/' + Math.round(chart.xAxis[0].getExtremes().max) +'/' + chart.yAxis[0].getExtremes().min +'/' + chart.yAxis[0].getExtremes().max,
		success: function (CTBodyPartStats) {
			if (selects('avg').checked && stats == 'AVG') {
				switch (par) {
					case 'CTDIw':
						chart.yAxis[0].removePlotLine('CTDIwBodypartAVG');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CTBodyPartStats),
						color: 'yellow',
						width: 2,
						zIndex:2,
						id: 'CTDIwBodypartAVG',					
						label:{
								text: 'CTDIw Average: '  + parseFloat(CTBodyPartStats).toFixed(2) + ' mGy',
								style: {
									color: 'yellow',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'DLP':
						chart.yAxis[0].removePlotLine('DLPBodypartAVG');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CTBodyPartStats),
						color: 'yellow',
						width: 2,
						zIndex:2,
						id: 'DLPBodypartAVG',					
						label:{
								text: 'DLP Average: '  + parseFloat(CTBodyPartStats).toFixed(2) + ' mGy.cm',
								style: {
									color: 'yellow',
									fontWeight: 'bold'
									}}
						});
						break;
				}
				
			
			
			} else if (selects('percentile').checked && stats == 'PER'){
				switch (par) {
					case 'CTDIw':
						chart.yAxis[0].removePlotLine('CTDIwBodypartper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CTBodyPartStats),
						color: 'yellow',
						width: 2,
						zIndex:2,
						id: 'CTDIwBodypartper',
						dashStyle: 'shortdash',					
						label:{
								text: 'CTDIw 90th Percentile: '  + parseFloat(CTBodyPartStats).toFixed(2) + ' mGy',
								style: {
									color: 'yellow',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'DLP':
						chart.yAxis[0].removePlotLine('DLPBodypartper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CTBodyPartStats),
						color: 'yellow',
						width: 2,
						zIndex:2,
						id: 'DLPBodypartper',
						dashStyle: 'shortdash',					
						label:{
								text: 'DLP 90th Percentile: '  + parseFloat(CTBodyPartStats).toFixed(2) + ' mGy.cm',
								style: {
									color: 'yellow',
									fontWeight: 'bold'
									}}
						});
						break;
				}
			}	
			
		},
		timeout: 5000
	});
	
	
	
}

function getCTEquipmentStats(par, stats) {
	var chart = $('#chart').highcharts();
	
$.ajax({
		
		type: 'GET',
		url:'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/CT/' + par + '/' + selects('s2').value + '/' + selects('s4').value + '/' + stats+ '/'+ Math.round(chart.xAxis[0].getExtremes().min) +
                '/' + Math.round(chart.xAxis[0].getExtremes().max) +'/' + chart.yAxis[0].getExtremes().min +'/' + chart.yAxis[0].getExtremes().max,
		success: function (CTEquipmentStats) {
			
			if (selects('avg').checked && stats=='AVG') {
				switch (par) {
					case 'CTDIw':
						chart.yAxis[0].removePlotLine('CTDIwEquipAVG');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CTEquipmentStats),
						color: 'yellow',
						width: 2,
						zIndex:2,
						id: 'CTDIwEquipAVG',			
						label:{
								text: 'CTDIw Average: '  + parseFloat(CTEquipmentStats).toFixed(2) + ' mGy',
								style: {
									color: 'yellow',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'DLP':
						chart.yAxis[0].removePlotLine('DLPEquipAVG');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CTEquipmentStats),
						color: 'yellow',
						width: 2,
						zIndex:2,
						id: 'DLPEquipAVG',			
						label:{
								text: 'DLP Average: '  + parseFloat(CTEquipmentStats).toFixed(2) + ' mGy.cm',
								style: {
									color: 'yellow',
									fontWeight: 'bold'
									}}
						});
						break;
				}
				
			
			
			} else if (selects('percentile').checked && stats=='PER') {
				switch (par) {
					case 'CTDIw':
						chart.yAxis[0].removePlotLine('CtdiwEquipmper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CTEquipmentStats),
						color: 'yellow',
						width: 2,
						zIndex:2,
						id: 'CtdiwEquipmper',
						dashStyle: 'shortdash',					
						label:{
								text: 'CTDIw 90th Percentile: '  + parseFloat(CTEquipmentStats).toFixed(2) + ' mGy',
								style: {
									color: 'yellow',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'DLP':
						chart.yAxis[0].removePlotLine('DLPEquipmper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(CTEquipmentStats),
						color: 'yellow',
						width: 2,
						zIndex:2,
						id: 'DLPEquipmper',
						dashStyle: 'shortdash',					
						label:{
								text: 'DLP 90th Percentile: '  + parseFloat(CTEquipmentStats).toFixed(2) + ' mGy.cm',
								style: {
									color: 'yellow',
									fontWeight: 'bold'
									}}
						});
						break;
				}
				
			}	
			
		},
		timeout: 5000
	});
	
}








// MG FUNCTIONS

function getMGEquipment(par) {
$.ajax({
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key +'/MG/' + par,
		success: function (MGEquipment) {
			
			switch (par) {
				case 'OrganDose':
				
					chart.series[0].setData(getMGEquipment1(MGEquipment));
					break;
					
				case 'COMPFORCE':
					chart.series[0].setData(getMGOthersEquipment(MGEquipment));
					break;
					
				case 'VOLTAGE':
					chart.series[0].setData(getMGOthersEquipment(MGEquipment));
					break;
					
				case 'TIME':
					chart.series[0].setData(getMGOthersEquipment(MGEquipment));
					break;
				
			}
			
			AvgPer();	
		},
		timeout: 5000
	});
}

function getMGBodyThick() {
$.ajax({
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/MG/OrganDose',
		success: function (MG) {
			chart = $('#chart').highcharts();
			chart.series[3].setData([]);
			chart.series[0].setData(getMGthickness1(MG));
			AvgPer();
			
		},
		timeout: 5000
	});
}

function getMG(par) {
$.ajax({
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/MG/'+ par,
		success: function (MG) {
			var chart = $('#chart').highcharts();
			
			
			chart.yAxis[0].removePlotLine('ref');
			chart.yAxis[0].removePlotBand('ref');
			chart.series[3].setData([]);
			chart.series[0].setData(MG);
			chart.series[0].show();
			
			switch (par) {
				case 'TIME':
					chart.yAxis[0].addPlotLine({
					value: 2,
					color: 'red',
					id: 'ref',
					width: 3,
					label:{
						text: 'Exposure Time European Guideline: < 2 secs',
						style: {
			color: 'red',
			fontWeight: 'bold'
					}}
				});
				
				chart.series[3].setData([{"x":1437001200000,"y":2}]);
				break;
				
									
				case 'COMPFORCE':
					chart.yAxis[0].addPlotBand({
				from: 130,
				to: 200,
				color: 'red',
				id: 'ref',				
				label:{
					text: 'Compression Force European Guideline: 130-200 N',
					style: {
		color: 'white',
		fontWeight: 'bold'
				}}
			});
			
			chart.series[3].setData([{"x":1437001200000,"y":130}, {"x":1437001200000,"y":130}]);
					break;
			
			}
			AvgPer();
			
		},
		timeout: 5000
	});
}

function getMGStats(par, stats) {
	var chart = $('#chart').highcharts();
	
	
$.ajax({
		
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/MG/' + par + '/' + stats + '/' + Math.round(chart.xAxis[0].getExtremes().min) +
                '/' + Math.round(chart.xAxis[0].getExtremes().max) +'/' + chart.yAxis[0].getExtremes().min +'/' + chart.yAxis[0].getExtremes().max,
		success: function (MGStats) {
			if (selects('avg').checked && stats == 'AVG') {
				switch (par){
					case 'OrganDose':
						chart.yAxis[0].removePlotLine('MGavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(MGStats),
						color: 'green',
						width: 2,
						zIndex:2,
						id: 'MGavg',
											
						label:{
								text: 'Organ Dose Average: '  + parseFloat(MGStats).toFixed(2) + ' mGy',
								style: {
									color: 'green',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'COMPFORCE':
						chart.yAxis[0].removePlotLine('MGcforceavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(MGStats),
						color: 'green',
						width: 2,
						zIndex:2,
						id: 'MGcforceavg',
											
						label:{
								text: 'Compression Force Average: '  + parseFloat(MGStats).toFixed(2) + ' N',
								style: {
									color: 'green',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'TIME':
						chart.yAxis[0].removePlotLine('MGtimeavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(MGStats),
						color: 'green',
						width: 2,
						zIndex:2,
						id: 'MGtimeavg',
											
						label:{
								text: 'Exposure Time Average: '  + parseFloat(MGStats).toFixed(2) + ' secs',
								style: {
									color: 'green',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'VOLTAGE':
						chart.yAxis[0].removePlotLine('MGvoltageavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(MGStats),
						color: 'green',
						width: 2,
						zIndex:2,
						id: 'MGvoltageavg',
											
						label:{
								text: 'Voltage Average: '  + parseFloat(MGStats).toFixed(2) + ' kV',
								style: {
									color: 'green',
									fontWeight: 'bold'
									}}
						});
						break;
					
					
				}
			
			
			} else if (selects('percentile').checked && stats == 'PER') {
				switch (par){
					case 'OrganDose':
						chart.yAxis[0].removePlotLine('MGper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(MGStats),
						color: 'green',
						width: 2,
						zIndex:2,
						id: 'MGper',
						dashStyle: 'shortdash',					
						label:{
								text: 'Organ Dose 90th Percentile: '  + parseFloat(MGStats).toFixed(2) + ' mGy',
								style: {
									color: 'green',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'COMPFORCE':
						chart.yAxis[0].removePlotLine('MGcforceper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(MGStats),
						color: 'green',
						width: 2,
						zIndex:2,
						id: 'MGcforceper',
						dashStyle: 'shortdash',					
						label:{
								text: 'Compression Force 90th Percentile: '  + parseFloat(MGStats).toFixed(2) + ' N',
								style: {
									color: 'green',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'TIME':
						chart.yAxis[0].removePlotLine('MGtimeper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(MGStats),
						color: 'green',
						width: 2,
						zIndex:2,
						id: 'MGtimeper',
						dashStyle: 'shortdash',					
						label:{
								text: 'Exposure Time 90th Percentile: '  + parseFloat(MGStats).toFixed(2) + ' secs',
								style: {
									color: 'green',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'VOLTAGE':
						chart.yAxis[0].removePlotLine('MGvoltageper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(MGStats),
						color: 'green',
						width: 2,
						zIndex:2,
						id: 'MGvoltageper',
						dashStyle: 'shortdash',					
						label:{
								text: 'Voltage 90th Percentile: '  + parseFloat(MGStats).toFixed(2) + ' kV',
								style: {
									color: 'green',
									fontWeight: 'bold'
									}}
						});
						break;
					
					
				}
				
			}
							
			
		},
		timeout: 5000
	});
}

function getMGThickavg() {
	var chart = $('#chart').highcharts();
	
$.ajax({
		
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/MG/OrganDose/' + selects('s2').value + '/AVG/' + Math.round(chart.xAxis[0].getExtremes().min) +
                '/' + Math.round(chart.xAxis[0].getExtremes().max) +'/' + chart.yAxis[0].getExtremes().min +'/' + chart.yAxis[0].getExtremes().max,
		success: function (MGThickavg) {
			if (selects('avg').checked) {
			chart.yAxis[0].removePlotLine('MGThickavg');
			chart.yAxis[0].addPlotLine({
			value: parseFloat(MGThickavg),
			color: 'green',
			width: 2,
			zIndex:2,
			id: 'MGThickavg',
								
			label:{
					text: 'Organ Dose Average: '  + parseFloat(MGThickavg).toFixed(2) + ' mGy',
					style: {
color: 'green',
fontWeight: 'bold'
}}
			});
			
			}
							
			
		},
		timeout: 5000
	});
}

function getMGThcikper() {
	var chart = $('#chart').highcharts();
$.ajax({
		
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/MG/OrganDose/' + selects('s2').value + '/PER/' + Math.round(chart.xAxis[0].getExtremes().min) +
                '/' + Math.round(chart.xAxis[0].getExtremes().max) +'/' + chart.yAxis[0].getExtremes().min +'/' + chart.yAxis[0].getExtremes().max,
		success: function (MGThickper) {
			if (selects('percentile').checked) {
			chart.yAxis[0].removePlotLine('MGThickper');
			chart.yAxis[0].addPlotLine({
			value: parseFloat(MGThickper),
			color: 'green',
			width: 2,
			zIndex:2,
			id: 'MGThickper',
			dashStyle: 'shortdash',					
			label:{
					text: 'Organ Dose 90th Percentile: '  + parseFloat(MGThickper).toFixed(2) + ' mGy',
					style: {
color: 'green',
fontWeight: 'bold'
}}
			});
			
			}
			
		},
		timeout: 5000
	});
}

function getMGEquipmentStats(par, stats) {
	var chart = $('#chart').highcharts();
$.ajax({
		
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/MG/' + par + '/' + selects('s2').value + '/' + selects('s4').value + '/' + stats + '/' + Math.round(chart.xAxis[0].getExtremes().min) +
                '/' + Math.round(chart.xAxis[0].getExtremes().max) +'/' + chart.yAxis[0].getExtremes().min +'/' + chart.yAxis[0].getExtremes().max,
		success: function (MGEquipmentStats) {
			if (selects('avg').checked && stats =='AVG') {
				switch (par){
					case 'OrganDose':
						chart.yAxis[0].removePlotLine('MGEquipmentavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(MGEquipmentStats),
						color: 'green',
						width: 2,
						zIndex:2,
						id: 'MGEquipmentavg',
											
						label:{
								text: 'Organ Dose Average: '  + parseFloat(MGEquipmentStats).toFixed(2) + ' mGy',
								style: {
									color: 'green',
									fontWeight: 'bold'
									}}
						});
						break;
						
					
				}
			
			
			} else if (selects('percentile').checked && stats =='PER') {
				switch (par){
					case 'OrganDose':
						chart.yAxis[0].removePlotLine('MGEquipmper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(MGEquipmentStats),
						color: 'green',
						width: 2,
						zIndex:2,
						id: 'MGEquipmper',
						dashStyle: 'shortdash',					
						label:{
								text: 'Organ Dose 90th Percentile: '  + parseFloat(MGEquipmentStats).toFixed(2) + ' mGy',
								style: {
									color: 'green',
									fontWeight: 'bold'
									}}
						});
						break;
						
					
				}
				
			}
							
			
		},
		timeout: 5000
	});
}

function getMGEquipmentStats1(par, stats) {
	var chart = $('#chart').highcharts();
$.ajax({
		
		type: 'GET',
		url: 'http://rmsci.fc.ul.pt/tools/webservice.php/' + key + '/MG/' + par + '/' + selects('s4').value + '/' + stats + '/' + Math.round(chart.xAxis[0].getExtremes().min) +
                '/' + Math.round(chart.xAxis[0].getExtremes().max) +'/' + chart.yAxis[0].getExtremes().min +'/' + chart.yAxis[0].getExtremes().max,
		success: function (MGEquipmentStats) {
			if (selects('avg').checked && stats =='AVG') {
				switch (par){
					case 'OrganDose':
						chart.yAxis[0].removePlotLine('MGEquipmentavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(MGEquipmentStats),
						color: 'green',
						width: 2,
						zIndex:2,
						id: 'MGEquipmentavg',
											
						label:{
								text: 'Organ Dose Average: '  + parseFloat(MGEquipmentStats).toFixed(2) + ' mGy',
								style: {
									color: 'green',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'COMPFORCE':
						
						chart.yAxis[0].removePlotLine('MGcforceEquipavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(MGEquipmentStats),
						color: 'green',
						width: 2,
						zIndex:2,
						id: 'MGcforceEquipavg',
											
						label:{
								text: 'Compression Force Average: '  + parseFloat(MGEquipmentStats).toFixed(2) + ' N',
								style: {
									color: 'green',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'TIME':
						chart.yAxis[0].removePlotLine('MGtimeEquipavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(MGEquipmentStats),
						color: 'green',
						width: 2,
						zIndex:2,
						id: 'MGtimeEquipavg',
											
						label:{
								text: 'Compression Force Average: '  + parseFloat(MGEquipmentStats).toFixed(2) + ' N',
								style: {
									color: 'green',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'VOLTAGE':
						chart.yAxis[0].removePlotLine('MGvoltageEquipavg');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(MGEquipmentStats),
						color: 'green',
						width: 2,
						zIndex:2,
						id: 'MGvoltageEquipavg',
											
						label:{
								text: 'Voltage Average: '  + parseFloat(MGEquipmentStats).toFixed(2) + ' kV',
								style: {
									color: 'green',
									fontWeight: 'bold'
									}}
						});
						break;

						
					
				}
			
			
			} else if (selects('percentile').checked && stats =='PER') {
				switch (par){
					case 'OrganDose':
						chart.yAxis[0].removePlotLine('MGEquipmper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(MGEquipmentStats),
						color: 'green',
						width: 2,
						zIndex:2,
						id: 'MGEquipmper',
						dashStyle: 'shortdash',					
						label:{
								text: 'Organ Dose 90th Percentile: '  + parseFloat(MGEquipmentStats).toFixed(2) + ' mGy',
								style: {
									color: 'green',
									fontWeight: 'bold'
									}}
						});
						break;
					
					case 'COMPFORCE':
						chart.yAxis[0].removePlotLine('MGcforceEquipper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(MGEquipmentStats),
						color: 'green',
						width: 2,
						zIndex:2,
						id: 'MGcforceEquipper',
						dashStyle: 'shortdash',					
						label:{
								text: 'Compression Force 90th Percentile: '  + parseFloat(MGEquipmentStats).toFixed(2) + ' N',
								style: {
									color: 'green',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'TIME':
						chart.yAxis[0].removePlotLine('MGtimeEquipper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(MGEquipmentStats),
						color: 'green',
						width: 2,
						zIndex:2,
						id: 'MGtimeEquipper',
						dashStyle: 'shortdash',					
						label:{
								text: 'Exposure Time 90th Percentile: '  + parseFloat(MGEquipmentStats).toFixed(2) + ' secs',
								style: {
									color: 'green',
									fontWeight: 'bold'
									}}
						});
						break;
						
					case 'VOLTAGE':
						chart.yAxis[0].removePlotLine('MGvoltageEquipper');
						chart.yAxis[0].addPlotLine({
						value: parseFloat(MGEquipmentStats),
						color: 'green',
						width: 2,
						zIndex:2,
						id: 'MGvoltageEquipper',
						dashStyle: 'shortdash',					
						label:{
								text: 'Voltage 90th Percentile: '  + parseFloat(MGEquipmentStats).toFixed(2) + ' kV',
								style: {
									color: 'green',
									fontWeight: 'bold'
									}}
						});
						break;
						
					
				}
				
			}
			
							
			
		},
		timeout: 5000
	});
}




	
	
	
// ACCESS DOM ELEMENTS

function selects(select) {
	switch (select) {
		case 's1':
			select_1 = document.getElementById("s1");
			return select_1;
			break;
		
		case 's2':
			select_2 = document.getElementById("s2");
			return select_2;
			break;
		
		case 's3':
			select_3= document.getElementById("s3");
			return select_3;
			break;
			
		case 's4':
			select_4 = document.getElementById("s4");
			return select_4;
			break;
			
		case 's5':
			select_5 = document.getElementById("s5");
			return select_5;
			break;
			
		case 'dosetype':
			dosetype = document.getElementById("dosetype");
			return dosetype;
			break;
			
		case 'CTDIw':
			CTDIw = document.getElementById("CTDIw");
			return CTDIw;
			break;
			
		case 'DLP':
			DLP = document.getElementById("DLP");
			return DLP;
			break;
			
		case 'ctdiw':
			ctdivol = document.getElementById("ctdiw");
			
			return ctdivol;
			break;
			
		case 'dlp':
			dlp = document.getElementById("dlp");
			return dlp;
			break;
			
		case 'rad':
			rad = document.getElementById("rad");
			return rad;
			break;
			
		case 'compforce':
			compforce = document.getElementById("compforce");
			return compforce;
			break;
			
		case 'other':
			other = document.getElementById("other");
			return other;
			break;
			
		case 'body':
			body = document.getElementById("body");
			return body;
			break;
			
		case 'avg':
			avg = document.getElementById("avg");
			return avg;
			break;
			
		case 'percentile':
			percentile = document.getElementById("percentile");
			return percentile;
			break;
			
		case 'uploadBtn':
			uploadBtn = document.getElementById("uploadBtn");
			return uploadBtn;
			break;
			
		case 'uploadFile':
			uploadFile = document.getElementById("uploadFile");
			return uploadFile;
			break;

		
	}
	
}


// DROPDOWN SELECT MENUS VISUAL ASPECTS 

function show_select () {
	
	
	var chart = $('#chart').highcharts();

	s1 = selects('s1').options[selects('s1').selectedIndex].value;
	s3 = selects('s3').options[selects('s3').selectedIndex].value;



	switch(s1) 
	{
		case 'MG':
				chart.setTitle({text: ""});
				deletePlotLines();
				selects('other').text = 'Compression Force';
				if (selects('s3').style.visibility =='hidden' && selects('s3').selectedIndex==0) {
				
				selects('dosetype').style.visibility ='hidden';
				selects('CTDIw').style.visibility ='hidden';
				selects('ctdiw').style.visibility ='hidden';
				selects('DLP').style.visibility ='hidden';
				selects('dlp').style.visibility ='hidden';
				selects('s2').style.visibility ='hidden';
				selects('s4').style.visibility ='hidden';
				selects('s3').style.visibility ='visible';
				chart.series[0].hide();
				chart.series[1].hide();
				chart.series[2].hide();
				chart.series[3].setData([]);
				chart.yAxis[0].setTitle({ text: "" });
				selects('rad').text = 'Organ Dose';
				
				selects('avg').disabled = true;
				selects('percentile').disabled = true;
				selects('s3').style.marginTop="-100px";
				
			} else if (selects('s3').style.visibility =='visible' && selects('s3').selectedIndex==0){
				chart.yAxis[0].removePlotBand('ref');
				chart.yAxis[0].removePlotLine('ref');
				chart.series[0].hide();
				chart.series[1].hide();
				chart.series[2].hide();
				chart.series[3].setData([]);
				chart.yAxis[0].setTitle({ text: "" }); 
				selects('rad').text = 'Organ Dose';
				
				selects('s2').style.visibility ='hidden';
				selects('avg').disabled = true;
				selects('percentile').disabled = true;
			
			
			} else if (selects('s3').style.visibility =='visible' && selects('s3').selectedIndex!=0){
						selects('avg').disabled = false;
						selects('percentile').disabled = false;
						
				switch (s3) {
					case 'dap':
						chart.setTitle({text: "Radiation Monitoring"});
						selects('s4').style.marginTop="-180px";
						selects('s2').style.marginTop="-90px";
						if (selects('s2').selectedIndex == 0 && selects('s4').selectedIndex==0) {
				
							getMG('OrganDose');
							selects('s5').style.visibility ='hidden';
							selects('s2').style.visibility ='visible';
							chart.yAxis[0].setTitle({ text: "Organ Dose [mGy]" });
							
							
							
						} else if (selects('s2').selectedIndex != 0 && selects('s4').selectedIndex==0) {
							
							getMGBodyThick();
							
							selects('s4').style.visibility ='visible';
						} else if (selects('s2').selectedIndex != 0 && selects('s4').selectedIndex!=0) {

							getMGEquipment('OrganDose');
							
						} 

						break;
					case 'other':
						chart.setTitle({text: "Compression Force Monitoring"});
						selects('s4').style.marginTop="-250px";
						if (selects('s3').selectedIndex != 0 && selects('s4').selectedIndex==0) {
							selects('s2').style.visibility ='hidden';
							selects('s2').value = 'body';
							
							getMG('COMPFORCE');
							selects('s5').style.visibility ='hidden';
							selects('s4').style.visibility ='visible';
							chart.yAxis[0].setTitle({ text: "Compression Force [N]" });
							
						} else if (selects('s3').selectedIndex != 0 && selects('s4').selectedIndex!=0) {
							
							getMGEquipment('COMPFORCE');
						}
						break;
					
					case 'time':
					chart.setTitle({text: "Exposure Time Monitoring"});
						selects('s4').style.marginTop="-250px";
						if (selects('s3').selectedIndex != 0 && selects('s4').selectedIndex==0) {
							selects('s2').style.visibility ='hidden';
							getMG('TIME');
							selects('s5').style.visibility ='hidden';
							
							selects('s4').style.visibility ='visible';
							chart.yAxis[0].setTitle({ text: "Exposure Time [secs]" });
							
						} else if (selects('s3').selectedIndex != 0 && selects('s4').selectedIndex!=0) {
							getMGEquipment('TIME');
						}
						break;
					
										
					case '':
						chart.setTitle({text: ""});
						chart.yAxis[0].removePlotBand('ref');
						chart.yAxis[0].removePlotLine('ref');
						chart.series[0].hide();
						chart.series[3].setData([]);
						chart.yAxis[0].setTitle({ text: "" });
						break;
					
					
					
				}
				
				
			}
			break;
			
			
		
		case 'CT':
			chart.setTitle({text: "Radiation Monitoring"});
			
			deletePlotLines();
			if (selects('dosetype').style.visibility =='hidden') {
					
				chart.yAxis[0].removePlotBand('ref');
				chart.yAxis[0].removePlotLine('ref');
				chart.series[3].setData([]);
				selects('DLP').style.visibility ='visible';
				selects('dosetype').style.visibility ='visible';
				selects('CTDIw').style.visibility ='visible';
				selects('ctdiw').style.visibility ='visible';
				selects('dlp').style.visibility ='visible';
				selects('s3').style.visibility ='hidden';
				selects('s2').style.visibility ='hidden';
				selects('s4').style.visibility ='hidden';
				chart.series[0].hide();
				chart.series[1].hide();
				chart.series[2].hide();
				chart.series[3].setData([]);
				chart.yAxis[0].setTitle({ text: "Radiation Dose" });
				selects('DLP').checked = false;
				selects('CTDIw').checked = false;
				selects('avg').disabled = true;
				selects('percentile').disabled = true;
				selects('s2').style.marginTop="-60px";
				selects('s4').style.marginTop="-100px";
				
			} else {
				
					var type1 = $("#s2 option:selected").text();
					selects('s2').style.visibility ='visible';
					selects('s2').style.marginTop="-60px";
					selects('s4').style.marginTop="-100px";
					if (selects('DLP').checked && selects('s2').selectedIndex == 0 && selects('s4').selectedIndex==0) {
						
						selects('avg').disabled = false;
						selects('percentile').disabled = false;
						
						getCT('DLP');
						selects('s5').style.visibility ='hidden';
						selects('s4').style.visibility ='hidden';
						chart.yAxis[0].setTitle({ text: "DLP [mGy.cm]" });
						
					} else if (selects('DLP').checked && selects('s2').selectedIndex != 0 && selects('s4').selectedIndex==0) {
						
						getCTBodypart('DLP');
						
						selects('s4').style.visibility ='visible';
						
					} else if (selects('DLP').checked && selects('s2').selectedIndex != 0 && selects('s4').selectedIndex!=0) {

						getCTEquipments('DLP');
						

					} 
												
					
						
				
					
					var type1 = $("#s2 option:selected").text();
					selects('s2').style.visibility ='visible';
					if (selects('CTDIw').checked && selects('s2').selectedIndex == 0 && selects('s4').selectedIndex==0) {
						
						selects('avg').disabled = false;
						selects('percentile').disabled = false;
						chart.yAxis[0].removePlotLine('ref');
						getCT('CTDIw');
						selects('s5').style.visibility ='hidden';
						selects('s4').style.visibility ='hidden';
					chart.yAxis[0].setTitle({ text: "CTDIw [mGy]" });

					} else if (selects('CTDIw').checked && selects('s2').selectedIndex != 0 && selects('s4').selectedIndex==0) {
						

						getCTBodypart('CTDIw');
						selects('s4').style.visibility ='visible';
						} else if (selects('CTDIw').checked && selects('s2').selectedIndex != 0 && selects('s4').selectedIndex!=0) {

							getCTEquipments('CTDIw');

						} else if (selects('CTDIw').checked==false && selects('DLP').checked==false) {
							chart.yAxis[0].removePlotLine('ref');
							chart.series[3].setData([]);
							chart.series[2].hide();
							selects('s2').style.visibility ='hidden';
							chart.yAxis[0].setTitle({ text: "Radiation Dose" });

						
						}

				
			}
			break;
		
		case 'CR':
			chart.setTitle({text: ""});
			deletePlotLines();
			selects('other').text = 'Voltage';
			if (selects('s3').style.visibility =='hidden' && selects('s3').selectedIndex==0) {
				selects('rad').text = 'Radiation Dose (DAP)';
				
				selects('dosetype').style.visibility ='hidden';
				selects('CTDIw').style.visibility ='hidden';
				selects('ctdiw').style.visibility ='hidden';
				selects('DLP').style.visibility ='hidden';
				selects('dlp').style.visibility ='hidden';
				selects('s2').style.visibility ='hidden';
				selects('s4').style.visibility ='hidden';
				selects('s3').style.visibility ='visible';
				chart.series[0].hide();
				chart.series[1].hide();
				chart.series[2].hide();
				chart.series[3].setData([]);
				chart.yAxis[0].setTitle({ text: "" });
				selects('avg').disabled = true;
				selects('percentile').disabled = true;
				selects('s3').style.marginTop="-100px";
				selects('s2').style.marginTop="-100px";
				selects('s5').style.marginTop="-100px";
				selects('s4').style.marginTop="-100px";
			} else if (selects('s3').style.visibility =='visible' && selects('s3').selectedIndex==0){
				chart.yAxis[0].removePlotBand('ref');
				chart.yAxis[0].removePlotLine('ref');
				chart.series[3].setData([]);
				chart.series[0].hide();
				chart.series[1].hide();
				chart.series[2].hide();
				chart.yAxis[0].setTitle({ text: "" });
				selects('rad').text = 'Radiation Dose (DAP)';
				
				selects('avg').disabled = true;
				selects('percentile').disabled = true;
				selects('s3').style.marginTop="-100px";
				selects('s2').style.marginTop="-100px";
				selects('s5').style.marginTop="-100px";
				selects('s4').style.marginTop="-100px";


				selects('s2').style.visibility ='hidden';
				
			} else if (selects('s3').style.visibility =='visible' && selects('s3').selectedIndex!=0){
				
				selects('avg').disabled = false;
				selects('percentile').disabled = false;
				switch (s3){
					case 'dap':
						chart.setTitle({text: "Radiation Monitoring"});
						if (selects('s2').selectedIndex == 0 && selects('s5').selectedIndex==0 && selects('s4').selectedIndex==0) {
							
							getCR('IADP');
							selects('s5').style.visibility ='hidden';
							chart.yAxis[0].setTitle({ text: "DAP [mGy.cm²]" });
							
						} else if (selects('s2').selectedIndex != 0 && selects('s5').selectedIndex==0 && selects('s4').selectedIndex==0) {
							
							
							getCRBodypart('IADP');
							
							selects('s5').style.visibility ='visible';
							selects('s4').style.visibility ='hidden';
						} else if (selects('s2').selectedIndex != 0 && selects('s5').selectedIndex!=0 && selects('s4').selectedIndex==0) {
							
							
							getCRSeries('IADP');
							selects('s4').style.visibility ='visible';
						} else if (selects('s2').selectedIndex != 0 && selects('s5').selectedIndex!=0 && selects('s4').selectedIndex!=0) {
							getCREquipments('IADP');
										
						}

						break;
					
					case 'time':
						chart.setTitle({text: "Exposure Time Monitoring"});
						if (selects('s2').selectedIndex == 0 && selects('s5').selectedIndex==0 && selects('s4').selectedIndex==0) {
							
							getCR('EXPOSURE');
							selects('s5').style.visibility ='hidden';
							chart.yAxis[0].setTitle({ text: "Exposure Time [secs]" });
						} else if (selects('s2').selectedIndex != 0 && selects('s5').selectedIndex==0 && selects('s4').selectedIndex==0) {
							getCRBodypart('EXPOSURE');
							
							selects('s5').style.visibility ='visible';
							selects('s4').style.visibility ='hidden';
						} else if (selects('s2').selectedIndex != 0 && selects('s5').selectedIndex!=0 && selects('s4').selectedIndex==0) {
							
							getCRSeries('EXPOSURE');
							selects('s4').style.visibility ='visible';
						} else if (selects('s2').selectedIndex != 0 && selects('s5').selectedIndex!=0 && selects('s4').selectedIndex!=0) {
							getCREquipments('EXPOSURE');

						}

						break;
						
					case 'other':
							chart.setTitle({text: "Voltage Monitoring"});
						if (selects('s2').selectedIndex == 0 && selects('s5').selectedIndex==0 && selects('s4').selectedIndex==0) {
							
							getCR('VOLTAGE');
							selects('s5').style.visibility ='hidden';
							chart.yAxis[0].setTitle({ text: "Voltage [kV]" });
						} else if (selects('s2').selectedIndex != 0 && selects('s5').selectedIndex==0 && selects('s4').selectedIndex==0) {
							
							getCRBodypart('VOLTAGE');
							selects('s5').style.visibility ='visible';
							selects('s4').style.visibility ='hidden';
						} else if (selects('s2').selectedIndex != 0 && selects('s5').selectedIndex!=0 && selects('s4').selectedIndex==0) {
							
							getCRSeries('VOLTAGE');
							selects('s4').style.visibility ='visible';
						} else if (selects('s2').selectedIndex != 0 && selects('s5').selectedIndex!=0 && selects('s4').selectedIndex!=0) {

							getCREquipments('VOLTAGE');

						}
						
						break;
						
					case '':

						chart.series[1].hide();
						chart.series[3].setData([]);
						chart.yAxis[0].setTitle({ text: "" });
						chart.yAxis[0].removePlotBand('ref');
						chart.Axis[0].removePlotLine('ref');
						selects('s2').style.visibility ='hidden';
						chart.setTitle({text: "Radiation Monitoring"});

						break;
		
				}
				selects('s2').style.visibility ='visible';
				
			}
			
			break;
		
		case 'mod':
			
			
			getMG('OrganDose');
			getCR('IADP');
			getCT('CTDIw');
			chart.yAxis[0].setTitle({ text: "Radiation Dose" });
			selects('dosetype').style.visibility ='hidden';
			selects('CTDIw').style.visibility ='hidden';
			selects('ctdiw').style.visibility ='hidden';
			selects('DLP').style.visibility ='hidden';
			selects('dlp').style.visibility ='hidden';
			selects('s2').style.visibility ='hidden';
			selects('s3').style.visibility ='hidden';
			selects('s4').style.visibility ='hidden';
			selects('s5').style.visibility ='hidden';
			selects('avg').disabled = false;
			selects('percentile').disabled = false;
			
			break;
			
			
	}	


}
	
function deletePlotLines() {
	var chart = $('#chart').highcharts();
	chart.yAxis[0].removePlotLine('CTDIwavg');
	chart.yAxis[0].removePlotLine('MGavg');
	chart.yAxis[0].removePlotLine('DAPavg');
	chart.yAxis[0].removePlotLine('DAPper');
	chart.yAxis[0].removePlotLine('MGtimeavg');
	chart.yAxis[0].removePlotLine('MGvoltageavg');
	chart.yAxis[0].removePlotLine('DAPvoltageavg');
	chart.yAxis[0].removePlotLine('DAPtimeavg');
	chart.yAxis[0].removePlotLine('MGcforceavg');
	chart.yAxis[0].removePlotLine('DAPtimeper');
	chart.yAxis[0].removePlotLine('DAPvoltageper');
	chart.yAxis[0].removePlotLine('MGper');
	chart.yAxis[0].removePlotLine('MGtimeper');
	chart.yAxis[0].removePlotLine('MGvoltageper');
	chart.yAxis[0].removePlotLine('MGcforceper');
	chart.yAxis[0].removePlotLine('CTDIwper');
	chart.yAxis[0].removePlotLine('DLPper');
	chart.yAxis[0].removePlotLine('getDLPavg');
	chart.yAxis[0].removePlotLine('DLPBodypartAVG');
	chart.yAxis[0].removePlotLine('CTDIwBodypartAVG');
	chart.yAxis[0].removePlotLine('DLPBodypartper');
	chart.yAxis[0].removePlotLine('CTDIwBodypartper');
	chart.yAxis[0].removePlotLine('CTDIwEquipAVG');
	chart.yAxis[0].removePlotLine('DLPEquipAVG');
	chart.yAxis[0].removePlotLine('CtdiwEquipmper');
	chart.yAxis[0].removePlotLine('DLPEquipmper');
	chart.yAxis[0].removePlotLine('DAPBodyavg');
	chart.yAxis[0].removePlotLine('DAPSeriesavg');
	chart.yAxis[0].removePlotLine('DAPEquipmentavg');
	chart.yAxis[0].removePlotLine('DAPBodypartper');
	chart.yAxis[0].removePlotLine('DAPSeriesper');
	chart.yAxis[0].removePlotLine('DAPEquipmentper');
	chart.yAxis[0].removePlotLine('DAPtimeBodypavg');
	chart.yAxis[0].removePlotLine('DAPtimeSeriesavg');
	chart.yAxis[0].removePlotLine('DAPtimeEquipavg');
	chart.yAxis[0].removePlotLine('DAPtimeBodyper');
	chart.yAxis[0].removePlotLine('DAPTIMESeriesper');
	chart.yAxis[0].removePlotLine('DAPTIMEequipper');
	chart.yAxis[0].removePlotLine('DAPvoltageBodypartavg');
	chart.yAxis[0].removePlotLine('DAPvoltageSeriesavg');
	chart.yAxis[0].removePlotLine('DAPvoltageEquipmentavg');
	chart.yAxis[0].removePlotLine('DAPvoltageBodypartper');
	chart.yAxis[0].removePlotLine('DAPvoltageSeriesper');
	chart.yAxis[0].removePlotLine('DAPvoltageEquipmentper');
	chart.yAxis[0].removePlotLine('MGThickavg');
	chart.yAxis[0].removePlotLine('MGEquipmentavg');
	chart.yAxis[0].removePlotLine('MGThickper');
	chart.yAxis[0].removePlotLine('MGEquipmper');
	chart.yAxis[0].removePlotLine('MGcforceEquipper');
	chart.yAxis[0].removePlotLine('MGcforceEquipavg');
	chart.yAxis[0].removePlotLine('MGtimeEquipavg');
	chart.yAxis[0].removePlotLine('MGtimeEquipper');
	chart.yAxis[0].removePlotLine('MGvoltageEquipavg');
	chart.yAxis[0].removePlotLine('MGvoltageEquipper');

} 

// Deals ONLY with averages and percentiles
function AvgPer() {
	var chart = $('#chart').highcharts();
	s1 = selects('s1').value;
	s3 = selects('s3').value;
	per = selects('percentile');
	avg = selects('avg');
	ctdiw = selects('CTDIw');
	dlp = selects('DLP');
	
	switch (s1) {
		
		case 'mod':
			deletePlotLines();
			if (avg.checked == false && percentile.checked==true) {
					getCRStats('IADP', 'PER');
					getMGStats('OrganDose', 'PER');
					getCTStats('CTDIw', 'PER');
					
			} else if (avg.checked == true && percentile.checked==false) {
					getCTStats('CTDIw', 'AVG');
					getMGStats('OrganDose', 'AVG');
					getCRStats('IADP', 'AVG');
				
			} else if (avg.checked == false && percentile.checked==false) {
				
			} else {
					getCTStats('CTDIw', 'AVG');
					getMGStats('OrganDose', 'AVG');
					getCRStats('IADP', 'AVG');
					getCRStats('IADP', 'PER');
					getMGStats('OrganDose', 'PER');
					getCTStats('CTDIw', 'PER');
			}
			break;
		case 'CR':
			switch (s3) {
				case 'dap':
					deletePlotLines();
					if (avg.checked == false && percentile.checked==true) {
						if (selects('s2').value == 'body') {
							
							getCRStats('IADP', 'PER');
						} else if (selects('s2').value != 'body' && selects('s5').value=='view' && selects('s4').value =='equipment') {
							
							getCRBodypartStats('IADP', 'PER');
						} else if (selects('s2').value != 'body' && selects('s5').value!='view' && selects('s4').value =='equipment') {
							
							CRSeriesStats('IADP', 'PER');
						} else if (selects('s2').value != 'body' && selects('s5').value!='view' && selects('s4').value !='equipment') {
							
							CREquipmentStats('IADP', 'PER');
						}
					} else if (avg.checked == true && percentile.checked==false) {
						if (selects('s2').value == 'body') {
							
							getCRStats('IADP', 'AVG');
						} else if (selects('s2').value != 'body' && selects('s5').value=='view' && selects('s4').value =='equipment') {
							
							getCRBodypartStats('IADP', 'AVG');
						} else if (selects('s2').value != 'body' && selects('s5').value!='view' && selects('s4').value =='equipment') {
							CRSeriesStats('IADP', 'AVG');
							
						} else if (selects('s2').value != 'body' && selects('s5').value!='view' && selects('s4').value !='equipment') {
							CREquipmentStats('IADP', 'AVG');
							
						}
						
					} else if (avg.checked == true && percentile.checked==true) {
						if (selects('s2').value == 'body') {
							getCRStats('IADP', 'PER');
							getCRStats('IADP', 'AVG');
						} else if (selects('s2').value != 'body' && selects('s5').value=='view' && selects('s4').value =='equipment') {
							getCRBodypartStats('IADP', 'AVG');
							getCRBodypartStats('IADP', 'PER');
						} else if (selects('s2').value != 'body' && selects('s5').value!='view' && selects('s4').value =='equipment') {
							CRSeriesStats('IADP', 'AVG');
							CRSeriesStats('IADP', 'PER');
						} else if (selects('s2').value != 'body' && selects('s5').value!='view' && selects('s4').value !='equipment') {
							CREquipmentStats('IADP', 'AVG');
							CREquipmentStats('IADP', 'PER');
						}
					}
					break;
				case 'time':
					deletePlotLines();
					if (avg.checked == false && percentile.checked==true) {
						if (selects('s2').value == 'body') {
							
							getCRStats('TIME', 'PER');
							
						} else if (selects('s2').value != 'body' && selects('s5').value=='view' && selects('s4').value =='equipment') {
							
							getCRBodypartStats('TIME', 'PER');
						} else if (selects('s2').value != 'body' && selects('s5').value!='view' && selects('s4').value =='equipment') {
							
							CRSeriesStats('TIME', 'PER');
						} else if (selects('s2').value != 'body' && selects('s5').value!='view' && selects('s4').value !='equipment') {
							
							CREquipmentStats('TIME', 'PER');
						}
					} else if (avg.checked == true && percentile.checked==false) {
						if (selects('s2').value == 'body') {
							
							getCRStats('TIME', 'AVG');
						} else if (selects('s2').value != 'body' && selects('s5').value=='view' && selects('s4').value =='equipment') {
							getCRBodypartStats('TIME', 'AVG');
							
						} else if (selects('s2').value != 'body' && selects('s5').value!='view' && selects('s4').value =='equipment') {
							CRSeriesStats('TIME', 'AVG');
							
						} else if (selects('s2').value != 'body' && selects('s5').value!='view' && selects('s4').value !='equipment') {
							CREquipmentStats('TIME', 'AVG');
							
						}
					} else if (avg.checked == true && percentile.checked==true) {
						if (selects('s2').value == 'body') {
							getCRStats('TIME', 'PER');
							getCRStats('TIME', 'AVG');
						} else if (selects('s2').value != 'body' && selects('s5').value=='view' && selects('s4').value =='equipment') {
							getCRBodypartStats('TIME', 'AVG');
							getCRBodypartStats('TIME', 'PER');
						} else if (selects('s2').value != 'body' && selects('s5').value!='view' && selects('s4').value =='equipment') {
							CRSeriesStats('TIME', 'AVG');
							CRSeriesStats('TIME', 'PER');
						} else if (selects('s2').value != 'body' && selects('s5').value!='view' && selects('s4').value !='equipment') {
							CREquipmentStats('TIME', 'AVG');
							CREquipmentStats('TIME', 'PER');
						}
					}
					break;
				case 'other':
					deletePlotLines();
					if (avg.checked == false && percentile.checked==true) {
						if (selects('s2').value == 'body') {
							
							getCRStats('VOLTAGE', 'PER');
						} else if (selects('s2').value != 'body' && selects('s5').value=='view' && selects('s4').value =='equipment') {
							
							getCRBodypartStats('VOLTAGE', 'PER');
						} else if (selects('s2').value != 'body' && selects('s5').value!='view' && selects('s4').value =='equipment') {
							
							CRSeriesStats('VOLTAGE', 'PER');
						} else if (selects('s2').value != 'body' && selects('s5').value!='view' && selects('s4').value !='equipment') {
							
							CREquipmentStats('VOLTAGE', 'PER');
						}
					} else if (avg.checked == true && percentile.checked==false) {
						if (selects('s2').value == 'body') {
							
							getCRStats('VOLTAGE', 'AVG');
							
						} else if (selects('s2').value != 'body' && selects('s5').value=='view' && selects('s4').value =='equipment') {
							getCRBodypartStats('VOLTAGE', 'AVG');
						
						} else if (selects('s2').value != 'body' && selects('s5').value!='view' && selects('s4').value =='equipment') {
							CRSeriesStats('VOLTAGE', 'AVG');
							
						} else if (selects('s2').value != 'body' && selects('s5').value!='view' && selects('s4').value !='equipment') {
							CREquipmentStats('VOLTAGE', 'AVG');
							
						}
					} else if (avg.checked == true && percentile.checked==true) {
						if (selects('s2').value == 'body') {
							getCRStats('VOLTAGE', 'PER');
							getCRStats('VOLTAGE', 'AVG');
						} else if (selects('s2').value != 'body' && selects('s5').value=='view' && selects('s4').value =='equipment') {
							getCRBodypartStats('VOLTAGE', 'AVG');
							getCRBodypartStats('VOLTAGE', 'PER');
						} else if (selects('s2').value != 'body' && selects('s5').value!='view' && selects('s4').value =='equipment') {
							CRSeriesStats('VOLTAGE', 'AVG');
							CRSeriesStats('VOLTAGE', 'PER');
						} else if (selects('s2').value != 'body' && selects('s5').value!='view' && selects('s4').value !='equipment') {
							CREquipmentStats('VOLTAGE', 'AVG');
							CREquipmentStats('VOLTAGE', 'PER');
						}
						
					}
					break;
				
				
			}
			break;
			
		case 'CT':
			
			if (dlp.checked) {
				deletePlotLines();
				if (avg.checked == false && percentile.checked==true) {
					if (selects('s2').value == 'body') {
					
					getCTStats('DLP', 'PER');
					} else if (selects('s2').value != 'body' && selects('s4').value=='equipment') {
						
						getCTBodyPartStats('DLP', 'PER');
					} else if (selects('s2').value != 'body' && selects('s4').value!='equipment') {
						
						getCTEquipmentStats('DLP', 'PER');
					}
				} else if (avg.checked == true && percentile.checked==false) {
					if (selects('s2').value == 'body') {
					
					getCTStats('DLP', 'AVG');
					} else if (selects('s2').value != 'body' && selects('s4').value=='equipment') {
						getCTBodyPartStats('DLP', 'AVG');
						
					} else if (selects('s2').value != 'body' && selects('s4').value!='equipment') {
						getCTEquipmentStats('DLP', 'AVG');
						
					}
				} else if (avg.checked == true && percentile.checked==true) {
					if (selects('s2').value == 'body') {
						getCTStats('DLP', 'AVG');
						getCTStats('DLP', 'PER');
					} else if (selects('s2').value != 'body' && selects('s4').value=='equipment') {
						getCTBodyPartStats('DLP', 'AVG');
						getCTBodyPartStats('DLP', 'PER');
					} else if (selects('s2').value != 'body' && selects('s4').value!='equipment') {
						getCTEquipmentStats('DLP', 'AVG');
						getCTEquipmentStats('DLP', 'PER');
					}
				} 
				
				
			} else if (ctdiw.checked){
				deletePlotLines();
				if (avg.checked == false && percentile.checked==true) {
					if (selects('s2').value == 'body') {
						
						getCTStats('CTDIw', 'PER');
					} else if (selects('s2').value != 'body' && selects('s4').value=='equipment') {
						
						getCTBodyPartStats('CTDIw', 'PER');
						
					} else if (selects('s2').value != 'body' && selects('s4').value!='equipment') {
						
						getCTEquipmentStats('CTDIw', 'PER');
						
					}
				} else if (avg.checked == true && percentile.checked==false) {
					if (selects('s2').value == 'body') {
					
						getCTStats('CTDIw', 'AVG');
					} else if (selects('s2').value != 'body' && selects('s4').value=='equipment') {
						
						getCTBodyPartStats('CTDIw', 'AVG');
						
					} else if (selects('s2').value != 'body' && selects('s4').value!='equipment') {
						
						getCTEquipmentStats('CTDIw', 'AVG');
						
					}
				} else if (avg.checked == true && percentile.checked==true) {
					if (selects('s2').value == 'body') {
						
						getCTStats('CTDIw', 'AVG');
						getCTStats('CTDIw', 'PER');
					} else if (selects('s2').value != 'body' && selects('s4').value=='equipment') {
						
						getCTBodyPartStats('CTDIw', 'AVG');
						getCTBodyPartStats('CTDIw', 'PER');
					} else if (selects('s2').value != 'body' && selects('s4').value!='equipment') {
						
						getCTEquipmentStats('CTDIw', 'AVG');
						getCTEquipmentStats('CTDIw', 'PER');
					}
				} 
				
			}
			
			break;
			
		case 'MG':
			deletePlotLines();
			switch (s3) {
				case 'dap':
				
					if (avg.checked == false && percentile.checked==true) {
						if (selects('s2').value == 'body') {
							
							getMGStats('OrganDose', 'PER');
						} else if (selects('s2').value != 'body' && selects('s4').value =='equipment') {
							
							getMGThcikper();
						} else if (selects('s2').value != 'body' && selects('s4').value !='equipment') {
							
							getMGEquipmentStats('OrganDose', 'PER');
						}
					} else if (avg.checked == true && percentile.checked==false) {
						if (selects('s2').value == 'body') {
							
							getMGStats('OrganDose', 'AVG');
						} else if (selects('s2').value != 'body' && selects('s4').value =='equipment') {
							getMGThickavg();
							
						} else if (selects('s2').value != 'body' && selects('s4').value !='equipment') {
							getMGEquipmentStats('OrganDose', 'AVG');
							
						}
					} else if (avg.checked == true && percentile.checked==true) {
						if (selects('s2').value == 'body') {
							getMGStats('OrganDose', 'AVG');
							getMGStats('OrganDose', 'PER');
						} else if (selects('s2').value != 'body' && selects('s4').value =='equipment') {
							getMGThickavg();
							getMGThcikper();
						} else if (selects('s2').value != 'body' && selects('s4').value !='equipment') {
							getMGEquipmentStats('OrganDose', 'PER');
							getMGEquipmentStats('OrganDose', 'AVG');
						}
					}
					break;
				
				case 'other':
					if (avg.checked == false && percentile.checked==true) {
						if (selects('s4').value == 'equipment') {
							
							getMGStats('COMPFORCE', 'PER');
						} else {
							getMGEquipmentStats1('COMPFORCE', 'PER');
							
							
						}
					} else if (avg.checked == true && percentile.checked==false) {
						if (selects('s4').value == 'equipment') {
							
							getMGStats('COMPFORCE', 'AVG');
						} else {
							
							getMGEquipmentStats1('COMPFORCE', 'AVG');
						}
					} else if (avg.checked == true && percentile.checked==true) {
						if (selects('s4').value == 'equipment') {
							getMGStats('COMPFORCE', 'AVG');
							getMGStats('COMPFORCE', 'PER');
						} else {
							getMGEquipmentStats1('COMPFORCE', 'AVG');
							getMGEquipmentStats1('COMPFORCE', 'PER');
						}
					}
					break;
				
				case 'time':
					if (avg.checked == false && percentile.checked==true) {
						if (selects('s4').value == 'equipment') {
							
							getMGStats('TIME', 'PER');
						} else {
							
							getMGEquipmentStats1('TIME', 'PER');
						}
					} else if (avg.checked == true && percentile.checked==false) {
						if (selects('s4').value == 'equipment') {
							
							getMGStats('TIME', 'AVG');
						} else {
							getMGEquipmentStats1('TIME', 'AVG');
							
						}
					} else if (avg.checked == true && percentile.checked==true) {
						if (selects('s4').value == 'equipment') {
							getMGStats('TIME', 'AVG');
							getMGStats('TIME', 'PER');
						} else {
							getMGEquipmentStats1('TIME', 'PER');
							getMGEquipmentStats1('TIME', 'AVG');
						}
					}
					break;
					
								
			}
			break;
			
		
		
	}
	
}
	
	
$(function () {

   $('#chart').highcharts({
   
    chart: {
		
		
		backgroundColor: 'black',
		zoomType: 'xy',
    
	  
    
    },
    title: {
      text: 'Radiation Monitoring'
    },
	
    subtitle: {
      text: ' '
    },
    xAxis: {
	
      type: 'datetime',
	  events: { // Deals with zoom 
		afterSetExtremes : function () {
			AvgPer();
			
			
			
		},
	  dateTimeLabelFormats: {
	                millisecond: '%H:%M:%S.%L',
	                second: '%H:%M:%S',
	                minute: '%H:%M',
	                hour: '%H:%M',
	                day: '%e. %b',
	                week: '%e. %b',
	                month: '%b \'%y',
	                year: '%Y'
                },
	
      title: {
        enabled: true,
        text: 'Date'
      },
      startOnTick: true,
      endOnTick: true,
      showLastLabel: true,
	  


	
	 },
	  
    yAxis: {
      title: {
        text: 'Radiation Dose'
      },
	  
	  
		
		
	},
	  
    },
	
	tooltip: {
				
                headerFormat: '<b>{series.name}</b><br>',
				pointFormat: 'x: {point.x:%b %e, %Y}<br>y: {point.y}'
            },
    legend: {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      floating: false,
      backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
      borderWidth: 1
    },
    plotOptions: {
      scatter: {
		
		turboThreshold: 200000,
        marker: {
          radius: 5,
          states: {
            hover: {
              enabled: true,
              lineColor: 'rgb(100,100,100)'
            }
          }
        },
		events: {
            legendItemClick: function () {
                return false; 
            }
        },
        states: {
          hover: {
            marker: {
              enabled: false
            }
          }
        },
                             tooltip: {
                        headerFormat: '<b>{series.name}</b><br>'
                    }
      }
	 },
    
    series: [{
      name: 'MG',
      color: 'green',
      data: getMG('OrganDose'),
	  type: "scatter"

    }, {
      name: 'CR',
      color: 'blue',
      data: getCR('IADP'),
	  type: "scatter",

	  
    }, {
		name: 'CT',
		color: 'yellow',
		data: getCT('CTDIw'),
		type: 'scatter'


	}, {
     name: 'Goal',
     type: 'scatter',
     marker: {
          enabled: false,
		  states: {
                    hover: {
                        enabled: false   
					} ,
		  }
     },
	 enableMouseTracking: false,
	 color: 'red',
	 showInLegend: false, 
     data: []
}]

  });
  

});

ajaxDelay();



</script>

<script type="text/javascript">

function ajaxFunction(choice)
{

var httpxml;
try
  {
  // Firefox, Opera 8.0+, Safari
  httpxml=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    httpxml=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      httpxml=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
function stateChanged() 
    {
    if(httpxml.readyState==4)
      {
//alert(httpxml.responseText);
var myObject = JSON.parse(httpxml.responseText);


for(j=document.myForm.state.options.length-1;j>=0;j--)
{
document.myForm.state.remove(j);
}

var state1=myObject.value.state1;
var country=myForm.country.value;

if (country!= 'MG'){

	var optn = document.createElement("OPTION");
	optn.text = 'Choose the Body Part';
	optn.value = 'body';
	optn.id = 'body';
	document.myForm.state.options.add(optn);
	
} else {
	var optn = document.createElement("OPTION");
	optn.text = 'Choose the breast thickness';
	optn.value = 'body';
	optn.id = 'body';
	document.myForm.state.options.add(optn);
	
}


for (i=0;i<myObject.state.length;i++)
{
var optn = document.createElement("OPTION");
optn.text = myObject.state[i];
optn.value = myObject.state[i];
document.myForm.state.options.add(optn);

if(optn.value==state1){
	
var k= i+1;
document.myForm.state.options[k].selected=true;
}
} 

//////////////////////////
for(j=document.myForm.serie.options.length-1;j>=0;j--)
{
document.myForm.serie.remove(j);
}
var serie1=myObject.value.serie1;

var optn = document.createElement("OPTION");
optn.text = 'Choose the view position';
optn.value = 'view';
document.myForm.serie.options.add(optn);


if (myObject.serie!= null){
for (i=0;i<myObject.serie.length;i++)
{
var optn = document.createElement("OPTION");
optn.text = myObject.serie[i];
optn.value = myObject.serie[i];
document.myForm.serie.options.add(optn);

if(optn.value==serie1){
	
var k= i+1;
document.myForm.serie.options[k].selected=true;
}
} 
}

for(j=document.myForm.city.options.length-1;j>=0;j--)
{
document.myForm.city.remove(j);
}

var city1=myObject.value.city1;

var optn = document.createElement("OPTION");
optn.text = 'Choose Equipment Model';
optn.value = 'equipment';
document.myForm.city.options.add(optn);

//alert(city1);
if (myObject.city!= null){
for (i=0;i<myObject.city.length;i++)
{
var optn = document.createElement("OPTION");
optn.text = myObject.city[i];
optn.value = myObject.city[i];
document.myForm.city.options.add(optn);

if(optn.value==city1){
	var k= i+1;
document.myForm.city.options[k].selected=true;
}
}
}


///////////////////////////
document.getElementById("txtHint").style.background='#00f040';
document.getElementById("txtHint").innerHTML='done';
//setTimeout("document.getElementById('txtHint').style.display='none'",5000)
    }
    }

var url="ajax-dd3ck.php";
var country=myForm.country.value;
if(choice != 's1'){
var state=myForm.state.value;
var city=myForm.city.value;
var serie=myForm.serie.value;
}else{
var state='';
var city='';
var serie='';
}
url=url+"?country="+country;
url=url+"&state="+state;
url=url+"&city="+city;
url=url+"&serie="+serie;
url=url+"&key="+key;
url=url+"&id="+Math.random();
myForm.st.value=state;
//alert(url);
 document.getElementById("txtHint2").innerHTML=url;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
 document.getElementById("txtHint").innerHTML="Please Wait....";
document.getElementById("txtHint").style.background='#f1f1f1';
}
</script>

</head>
<body>
   

    <!--Header section  -->
    <div class="container" id="home">
        <div class="row text-center">
      <div class="col-md-12" >
          <!--<h1 class="head-main">  RADIATION MONITORING SYSTEM IN CLINICAL IMAGING</h1>
           <h2 class="head-sub-main"> Dosage Monitoring</h2>
          <h3 class="head-last"> FCUL/IPO Lisboa</h3>-->
          
          </div>


            </div>
      </div>
    <!--End Header section  -->

     <!-- Navigation -->
      <nav class="navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                
            </div>
            <!-- Collect the nav links for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#home">HOME</a>
                    </li>
                     <li><a href="#about">ABOUT</a>
                    </li>
				<li><a href="#upload">UPLOAD DATA</a>
                    </li> 					
                    <li><a href="#about-team">TEAM</a>
                    </li>
                
                        </li>
                     <li><a href="#contact-sec">CONTACTS</a>
                        </li>
						
					<li style="padding-left:400px;" ><a  style="display:''" id='log'>LOGGED WITH: <?php echo $_SESSION["user"];?></a>
                        </li>
						
					<li ><span id='logout' style="margin-top:8px;"class="btn btn-primary btn-file">Logout</span>
                        </li>
					
                         
                </ul>
            </div>
			
			<form id="login-form" action="check.php" method= "post">
                    <input id="text" class="text" type="text" placeholder="Type your key">&nbsp;<span class="btn btn-primary btn-file"><span class="fileupload-new">Go</span><input id="go" style="display:inline-block;" value="Go"></span>
                    
          
            </form>
			
			<script>
				
			
			
			$("#logout").click(function(){
				
				 window.location = "http://rmsci.fc.ul.pt";
					
					
			});

			
			</script>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav> 

	

     <!-- System Section -->
	<section class="for-full-back color-dark" id="system-sec" align="center">
	
	<div id="ack"></div>
   <div class="container">
   
   
          <div class="row text-center" >
		        <h1 style="color:white"><strong>RADIATION MONITORING SYSTEM IN CLINICAL IMAGING</h1></strong>
				<b><font color="white">Upload your sql file to analyse your data!</font></b>
				</br>
				</br>
				
				<form id="uploadsql" action="upload.js" method="post" enctype="multipart/form-data">
					<input id="uploadFile" type="text" disabled="disabled" placeholder="No file chosen" />
					
						<span class="btn btn-primary btn-file"><span class="fileupload-new">Select file</span>
							<input id="uploadBtn" name="file" type="file" /></span>

						<input class="fileUpload btn btn-primary" type = "submit" id="submit" value = "Submit"/>
						
				</form>
				
				</br>
				<label id= 'loading'><img  id= 'spinner' style= 'display:none;'src= "25.gif">&nbsp;&nbsp;Loading...</label>
				
				<div id="message"></div>
				</div>
				<script type="text/javascript">  
				document.getElementById("uploadBtn").onchange = function () {
					
					document.getElementById("uploadFile").value = this.value;
				};
				</script>  


				
				<div id="txtHint" style="width : 100px;background-color: #cccc33;display:none;">Message area</div>
				<div id="txtHint2" style="display:none;"></div>
				</br>
				<div class="col-md-5 contact-cls">
				
				<form name="myForm"  method='get'>
				
				<input type=hidden name=st value=0>
				<select style = 'float:left;margin-top:-2px;'class='soflow' name=country id='s1' onchange="selects('s3').selectedIndex=0; selects('s4').style.visibility ='hidden'; selects('s5').style.visibility ='hidden';selects('s2').style.visibility ='hidden';show_select();ajaxFunction('s1');">
					<option value='mod'>Choose the modality</option>
					
				</select>
				</br>
				</br>
				</br>
				
				<!--<label><p style="color: white;"><strong> Note: CT dose data is expressed by CTDIvol. You can switch to DLP.</strong></label>-->
				<p id="dosetype" style = "font-weight: bold;color:yellow;font-size:50%;visibility:hidden;float:left;margin-top:-33px;">&nbsp;&nbsp;&nbsp;Choose the dosage type you want to see:</p>
				
				</br>
				<p id ="ctdiw" style="font-weight: bold;color:yellow; font-size:70%;visibility:hidden;float:left;margin-top:-30px;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="check" id ="CTDIw"  type="checkbox" name="DLPctdi" value="CTDIw" onclick="s2.selectedIndex=0;s4.style.visibility='hidden';s4.selectedIndex=0;$('input[name=DLPctdi]').not(this).prop('checked', false);show_select();">CTDIw</p>
				<p id ="dlp" style='font-weight: bold;color:yellow; font-size:70%;visibility:hidden;margin-top:-30px;float:left;'>&nbsp;&nbsp;&nbsp;&nbsp;<input class="check" id ="DLP" type="checkbox" name="DLPctdi" value="DLP" onclick="s2.selectedIndex=0;s4.style.visibility='hidden';s4.selectedIndex=0;$('input[name=DLPctdi]').not(this).prop('checked', false);show_select();">DLP</p>

				</br>
				<select class='soflow' id="s3" style='float:left;visibility:hidden; margin-left: 20px;margin-top:-70px;' onchange = "selects('s4').selectedIndex=0;selects('s5').selectedIndex=0;selects('s2').selectedIndex=0;selects('s5').style.visibility='hidden';selects('s4').style.visibility='hidden';show_select();ajaxFunction('s3');">
  
					<option value=''>Choose the parameter</option>
					<option value='dap' id = 'rad'>Radiation Dose (DAP)</option>
					
					<option value='time'>Exposure time</option>
					<option value='other' id='other'>Voltage</option>

				</select>

				</br>
				</br>
				
				<select class='soflow' id="s2" style='float:left;visibility:hidden; margin-left: 20px;margin-top:-40px;' name=state  onchange="selects('s4').selectedIndex=0; selects('s5').selectedIndex=0;selects('s4').style.visibility='hidden';show_select();ajaxFunction('s2');">
  
					<option value='body' id='body'>Choose the Body Part</option>

					
				</select>
				</br>
				</br>
				
				<select class='soflow' name=serie id="s5" style='float:left;visibility:hidden;margin-left: 20px;margin-top:-40px;'  onchange="selects('s4').selectedIndex=0;show_select();ajaxFunction('s5');">
  
					<option value='view'>Choose the view position</option>

					
				</select>
				</br>
				</br>

				
				<select  class='soflow' name=city id="s4" style='float:left;visibility:hidden;margin-left: 20px;margin-top:-40px;' onchange="show_select();ajaxFunction('s4');">
 
					<option value='equipment'>Choose the equipment</option>

					
				</select>
				
				</form>
				
				
				</div>
				
				<div class="col-md-7">
				<div id="chart" style="width:850px;margin-left: -250px;margin-top: -1px;margin-bottom:30px;"></div>
				<label style="margin-left:300px;"><input class="check" id ="avg"  type="checkbox" name="avgper" value="avg" checked  onclick="AvgPer();"><strong><font color="white" size=2>Average</font></strong>
				<label><input class="check" id ="percentile" type="checkbox" name="avgper" value="percentile" checked onclick="AvgPer();"><strong><font color="white" size=2>90th Percentile</strong></font></p>
				
				</div>
				<p style="color:white;margin-left: 200px;"><u><b>Note:</b></u> If you already uploaded data and the chart is blank it means your data doesn't have radiation dosage information.</p>

     </section>
     

  <!--End System Section -->
   <section class="for-full-back color-white " id="about"  >
   <div class="container" >
      
            <div class="row text-center" >
                <div class="col-md-8 col-md-offset-2 ">
                    <h1>The Problem</h1>
                    <h4>
                        <strong>
                       Radiation doses administered to the patients are used improperly?
                            </strong>
                    </h4>
                </div>
                
            </div>
        
        <div class="row text-center g-pad-bottom" >
                <div class="col-md-12">
                    
                    <p>
                       
                        The diagnosis and therapy resources with imaging equipment are constantly increasing these days. Many of these devices make use of ionizing radiation which, inappropriately used may produce undesirable effects. In this way, we intend to develop a platform capable of extracting, from existing systems, the information of the ionizing radiation dose used in each radiological examination, in order to statistically analyze, monitor, detect and investigate accidental situations, control equipment and many other information of interest that result from requirement imposed by law.
						The collection of this data and the appropriate processing by the application developed, will provide a wide range of information that can be used by those responsible for the institution and for a selective group of employees in order to control, at various levels, the quality of services provided to the user, the efficiency of their diagnosis methods and the rational use of ionizing radiation. The evaluation of the practice will be accessible regarding the use of doses as well as the comparison with the international reference levels. The production of a set of configurable statistics and graphs will also control the radiation equipment producers and, in anticipation, the resolution of issues that could eventually lead to extended delays and respective low productivity.
                    </p>
                </div>
                
            </div>
      </div>
</section>

<section class="for-full-back color-light " id="upload"  >
   <div class="container" >
      
            <div class="row text-center" >
                <div class="col-md-8 col-md-offset-2 ">
                    <h1>How to upload data?</h1>
                    <h4>
                        
                    </h4>
                </div>
                
            </div>
        
         
               <div style="float:left;">
                    
					<p><b>
                    1. If you don't have Python installed, install it from <a href="https://www.python.org/ftp/python/2.7.11/python-2.7.11.msi">here</a>
	                </p></b>
                    <p><b>
                    2. Download python script <a href="download.php">here</a>
	                </p></b>
					<p><b>
                    3. Click F5 to run the script
                    </p></b>
					<p><b>
					4. Upload the SQL file generated
                    </p></b>
					
					
                
                
          </div>
		   <div style="float:right;margin-bottom:30px;">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/BSYxV1dCiko" frameborder="0" allowfullscreen></iframe>
		  
		  </div>
		  
      </div>
</section>
 <!-- About Team Section -->
	
       <section class="for-full-back color-white" id="about-team"  >
   <div class="container" >
      
            <div class="row text-center" >
                <div class="col-md-8 col-md-offset-2 ">
                    <h1>Who We Are ?</h1>
                    <h4>
                        <strong>
                       <p>Faculdade de Ciências da Universidade de Lisboa</p>
					   <p>Instituto Português de Oncologia de Lisboa</p>
                            </strong>
                    </h4>
                </div>
                
            </div>
        <div class="row text-center" >
            <div class="col-md-12 g-pad-bottom" >
                <div class="col-md-3 col-sm-3 col-xs-6">
						<div style="margin-left: 150px;" class="team-member">
							<img src="assets/img/team.jpg" alt="">
                            <h3> <strong> RITA FLORÊNCIO </strong>
                                <br /><br />
						MSc Student</h3>
						</div>
					</div>
                 <div style="margin-left: 150px;" class="col-md-3 col-sm-3 col-xs-6">
						<div class="team-member">
							<img src="assets/img/NunoMatela.png" alt="">
                            <h3> <strong> NUNO MATELA</strong>
                                <br /><br />
						Visiting Professor at FCUL</h3>
						</div>
					</div>
                 <div class="col-md-3 col-sm-3 col-xs-6">
						<div class="team-member">
							<img src="assets/img/fcouto.jpg" alt="">
                            <h3> <strong> FRANCISCO COUTO </strong>
                                <br /><br />
						Associate Professor at FCUL</h3>
						</div>
					</div>
                 
					
					
					
					
					
            </div>
        </div>
        
      </div>
</section>
<!--End About Team Section -->
    <!-- Contact Section -->  
     <section class="for-full-back color-light " id="contact-sec"  >
   <div class="container" >      
            <div class="row text-center" >
                <div class="col-md-8 col-md-offset-2 ">
                    <h1>Queries ? Ask Us Now.</h1>
                    </br>
					</br>
                </div>
                
            </div
        
        <div class="row" >
            <div class="col-md-5 contact-cls" >
                <h3>Our Contact Details</h3>
					<div >
						<span><i class="fa fa-home"> </i> Address: Faculdade de Ciências da Universidade de Lisboa
																	Edíficio C6, Piso 3
																	Campo Grande
																	1749-016 Lisboa </span>
                        <br />
						<span><i class="fa fa-phone"> </i> Phone: 217500253</span>
                        <br />
						<span><i class="fa fa-envelope-o"> </i>E-Mail: rflorencio@lasige.di.fc.ul.pt</span>
                        <br />
					</div>
					<br />
					<div id="social-icon">
						<!--<a href="#"><i class="fa fa-facebook fa-2x"></i></a>
						<a href="#"><i class="fa fa-twitter fa-2x"></i></a>
						<a href="#"><i class="fa fa-linkedin fa-2x"></i></a>
						<a href="#"><i class="fa fa-google-plus fa-2x"></i></a>
						<a href="#"><i class="fa fa-pinterest fa-2x"></i></a>-->					
					</div>
            </div>
                <div class="col-md-7">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2200.082966705055!2d-9.158206731622032!3d38.75482299891611!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd1932e2c31f9d3d%3A0xc9fda6389cac55b0!2sDepartamento+de+Inform%C3%A1tica%2C+Faculdade+de+Ci%C3%AAncias%2C+Universidade+de+Lisboa!5e0!3m2!1sen!2spt!4v1461172515916" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                
            </div>
      </div>
</section>
<!--End Contact Section -->
    <!--footer Section -->
     <div  class="for-full-back "  id="footer" >
               
         <a href="https://ciencias.ulisboa.pt" target="_blank"><img src="assets/img/fcul.png" alt=""></a>
		 
          2016. All Rights Reserved.
         
            </div>
    <!--End footer Section -->
     <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
     <!-- CORE JQUERY  -->
   
     <!-- BOOTSTRAP CORE SCRIPT   -->
    <script src="assets/plugins/bootstrap.js"></script>
    <!-- VEGAS SLIDESHOW SCRIPTS -->
    <script src="assets/plugins/vegas/jquery.vegas.min.js"></script>
     <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
     
</body>
</html>
