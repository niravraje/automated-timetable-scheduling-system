<?php
session_start();
if( !isset($_SESSION['username']) ){
	header('Location: login.php');
}
include_once("menu.php");
require_once("mongo_connect.php");
include_once("set-intern-schedule-action.php")
?>

<html>
<head>
	<link rel="stylesheet" href="assets/form-basic.css">
	<link rel="stylesheet" href="assets/jQuery-datetime-picker-style.css">
	<script src="assets/jQuery-Javascript-library1.js"></script>
	<script src="assets/jQuery-Javascript-library2.js"></script>
	<script>
		$( function() {
		  $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
		  var SelectedDate = $( ".selector" ).datepicker( "getDate" );
		  return SelectedDate;

		} );
	</script>
</head>

<body>
<section>
    <div class="main-content">

        <form class="form-basic" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

            <div class="form-title-row">
                <h1>Set Internship Schedule</h1>
            </div> 
			
			<fieldset><br>
			<div class="form-row">
				<label>
					<span>Select Batch</span>
					<select name="batch_select">
						<option value="">-----------------Select-----------------</option>
						<option value="2016">B.Ed 2016 Batch</option>
						<option value="2015">B.Ed 2015 Batch</option>
						<option value="2014">B.Ed 2014 Batch</option>
					</select>
				</label>
			</div><br>

			<div class="form-row">
				<label>
					<span>Program Start Date</span>
					<input type="text" id="datepicker" name="datepicker" placeholder="Select Date">
				</label>
			</div>	

			<!--
			<div class="form-row">
				<label>
					<span>Select Internship Duration</span>
					<select name="duration">
						<option value="">-----------------Select-----------------</option>
						<option value="1">1 Week Program</option>
						<option value="2">2 Week Program</option>
						<option value="3">3 Week Program</option>
						<option value="4">4 Week Program</option>
					</select>
				</label>
			</div>	
			-->	
			
			<div class="form-row">
				<label><span>Select School(s)<br>[As per Permission Granted]</span></label>
				<div class="form-checkbox-buttons">

				<?php
					$school_collection = $db->school;
					$cursor_school = $school_collection->find();
					$cursor_school = $cursor_school->sort(array("school_id" => 1));
					while($cursor_school->hasNext() ){
						$result_school = $cursor_school->getNext();
				?>
			
					<div>
						<label>
							<input type="checkbox" name="schools[]" value="<?php	echo $result_school['school_id'] ?>" > 
							<span>
								<?php	echo $result_school['school_name'];  ?>
							</span>
						</label>
					</div>
					
				<?php } ?>
					
				</div>		
			</div>
			</fieldset><br><br>

			<div class="form-row">
               <input class="submit_button" type="submit" name="confirm" value="SET BATCH SCHEDULE">	
            </div>

        </form>
		<br><br>

    </div>
</section>

</body>

</html>


