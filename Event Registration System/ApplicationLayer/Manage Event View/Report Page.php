<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"].'/Event Registration System/BusinessServiceLayer/Controller/Event Controller.php';

// $event_organizer_id  = $_SESSION['event_organizer_id '];
// $account_type = $_SESSION['account_type'];
// $event_id = $_SESSION['event_id'];

//Prevent Access Without Log In
// $account_type = $_SESSION['account_type'];
// if($account_type=="None"){
//   $message = "Please Log In!.";
//   echo "<script type='text/javascript'>alert('$message');</script>";
//   header("Location:../../ApplicationLayer/Manage Login and Registration View/Login.php");
// }

//Test Data
$admin_id = "1";
$event_organizer_id  = "1";
$participant_id = "1";
$account_type = "participant";
//$account_type = "admin" , "organizer", "participant";
$event_id = "2";
$report_catergory = '1';

$viewEventAvailable =  new eventController();

//Retrieve all event list
$data = $viewEventAvailable->viewEventAvailable();

if(isset($_POST['save'])){
	$event_qr_code	 = $_POST['event_qr_code'];
	$updateQRCODE = new eventController();  
	$updateQRCODE->updateQRCODE($event_id, $event_qr_code);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>REPORT PAGE</title>
    <?php include '../../includes/EventOrganizerTopNaviBar.php';?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />

<style>

#table{
	text-align: center;
	width:100%;
	margin-left: auto; 
  	margin-right: auto;
}

#table2{
	border: 1px solid black;
	text-align: center;
	width: 95%;
	margin-left: auto; 
  	margin-right: auto;
	background-color: #B4CFEC;
}

#line{
	border: 1px solid black;
}

/* button */

#btn{
	font-weight: normal;
	color: #fff;
	background: #337ab7;
	padding: 5px 20px;
	border: none;
	border-radius: 4px;
	cursor: pointer;
}

</style>

</head>
<body>
	<form action="" method="POST">
		<h2 style="text-align: center;">REPORT PAGE</h2>
		<table id="table">
			<tr>
				<th style="text-align: center;">
					<label for="report_catergory">SELECT REPORT:</label>
						<select name="report_catergory" id="report_catergory">
							<option value="1">Participated </option>
							<option value="2">Conferences</option>
							<option value="3">Expos</option>
							<option value="4">Festival</option>
							<option value="5">Science</option>
							<option value="6">Arts</option>
							<option value="7">Community</option>
							<option value="8">Other</option>
						</select>
				</th>
			</tr>
			<tr>
				<th style="text-align: center;">
					<label for="event_name">SELECT EVENT:</label>
						<select name="event_name" id="event_name">
							<?php
								foreach ($data as $row) {
							?>
							<option value="<?=$row['event_name']?>"><?=$row['event_name']?></option>
							<?php
								}
							?>
						</select>
				</th>
			</tr>
		</table>
		<table id="table">
		<tr>
		<th style="text-align: center;"><input type="submit" id="btn" name="report" value="REPORT" /></th>
		</tr>
		</table>
	</form>
	<div>

		<?php
			//Load Participated Report 
			if($report_catergory == '1'){
				//Delete this after chapter 4
				$viewAllParticipant =  new eventController();
				//Retrieve all Participant list
				$participated = $viewAllParticipant->viewAllParticipant();
				
		?>
			<table id="table2" class="center">
				<tr id="line">
				<th style="text-align: center;"><label>PARTICIPANT NAME</label></th>
				<th style="text-align: center;"><label>PARTICIPANT MATRIC ID</label></th>
				<th><label></label></th></tr>									
			<?php
				foreach ($participated as $row) {
			?>
				<tr>
				<td id="line" style="text-align: left;"><label><?=$row['participant_name']?></label></td>
				<td id="line" style="text-align: center;"><label><?=$row['participant_matric_id']?></label></td>
				<td id="line" style="text-align: center;">
                <input id="btn" type="button" class="primary" onclick="location.href='../../ApplicationLayer/Manage Event View/Information Page.php?event_id=<?=$row['event_id']?>'"  value="INFORMATION">&nbsp</li>
				</td></tr>
			<?php	}	?></td>									
			</table>				
		<?php	}?>
	</div>
</body>
  
</html>