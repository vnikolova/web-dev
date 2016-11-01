<!--
Mandatory Assignment 1
for Web Development and Databases
by Viktoriya Nikolova
11/03/2016
-->

<!DOCTYPE html>
<html>
<head>
	<title>Drone System</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles/stylesheet.css">
</head>
<body>
	<div id="userPanel">
		<h1>sDrone</h1>
		<input type="text" id="numOfDronesInput" placeholder="number of drones" required />
		<button id="createDrones">Create Drones</button>
		<button id="deleteDrone">Delete Drone</button>
		<button id="flyDrone">Fly Drone</button>
		<div id="statistics">
			<span data-toggle="tooltip" title="Total Number of Drones">D</span>
				<label id="totalDroneslbl">0</label>
			<i data-toggle="tooltip" title="Eliminated Accidents" class="fa fa-ban"></i>
				<label id="eliminatedAccidents">0</label>
		</div>
	</div>

<?php

	//create random accidents
	$randomNum = rand(5,13);
	define("NumOfAccidents", $randomNum);
	$accidents = array();

	for ($i = 0; $i < NumOfAccidents; $i++) {
    $yCord = rand(0, 800);
    $xCord = rand(0, 500);
    $accidents[$i] = '<i class="fa fa-exclamation-triangle fa-lg accident" id="accident'.$i.'" style="top:'.$xCord.'px; left:'.$yCord.'px;"></i>';
}

?>

<?php for ($i = 0; $i < count($accidents); $i++) { ?>
    <div class="accident"><?php echo $accidents[$i]; ?></div>
<?php } ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
	//bootstrap tooltip
	$(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip();
	});

	var droneId;
	var accidentId;
	var numOfDrones =0;
	var newTotal;
	var beginFrom = 0;
	var counterAccidents = 0;
	var screenWidth = $(window).width();
	var screenHeight = $(window).height();
	var userpanelwidth = (20/100) * screenWidth;

	$(document).on("click", "#createDrones", function() {
		//create drones
		var inputNum = $("#numOfDronesInput").val(); //new value
		numOfDrones = Number(inputNum);
		if(numOfDrones != "" && numOfDrones != null && !isNaN(numOfDrones))
		{
			newTotal = numOfDrones + beginFrom;

			for(i=beginFrom; i<newTotal;i++){
				//generate random positions
				var xCord = Math.round((Math.random() * screenHeight));
				var yCord = Math.round((Math.random() * screenWidth - userpanelwidth));
					//populate with drones
				$("body").append('<div class="drone" style="top:'+xCord+'px; left:'+yCord+'px;" id="drone'+i+'"><i class="fa fa-lg"><h3>D</h3></i></div>');
			}
			beginFrom += numOfDrones;
			$("#numOfDronesInput").val(''); //clear input field

				//create statistics
					/*how many times the drone has been used to attend an accident.
						how many drones you have in total*/
			$("#totalDroneslbl").text(newTotal);
		}
	});

		//select a drone
		$(document).on("click", ".drone", function(){
			droneId = $(this).attr('id');

			$('.drone').each(function() {
    		if ($(this).hasClass("selectedDrone")) {
        	$(this).removeClass("selectedDrone fa-spin");
    		}
			});

			$(this).addClass("selectedDrone fa-spin");
		});
		//select an accident
		$(document).on("click", ".accident", function(){
			accidentId = $(this).find("i").attr('id');

			$('.accident').each(function() {
				if ($(this).hasClass("selectedAccident")) {
					$(this).removeClass("selectedAccident");
				}
			});
				$(this).addClass("selectedAccident");

		});

		//fly selected drone to an accident
		$(document).on("click", "#flyDrone", function(){
			var xCord = $('#'+accidentId).css("top");
			var yCord = $('#'+accidentId).css("left");
			var exists = document.getElementById(accidentId);
			//check if the id exists
			if(exists != null){
				$('#'+ droneId).animate({
						top: xCord,
						left: yCord
					}, 1000, function() {
							$('#'+accidentId).remove();
							//update eliminated accidents number
							counterAccidents++;
							$("#eliminatedAccidents").text(counterAccidents);
					});
			}
		});

	//delete selected drone
	$(document).on("click", "#deleteDrone", function(){
		var exists = document.getElementById(droneId);
		//check if the id exists
		if(exists != null)
		{
			$('#'+droneId).remove();
			beginFrom--;
			newTotal--;
			$("#totalDroneslbl").text(newTotal);
		}

	});

</script>

</body>
</html>
