<html>
<head>
	<link rel="stylesheet" href="assets/form-basic.css">
</head>

<?php
session_start();
if( !isset($_SESSION['username']) ){
	header('Location: login.php');
}
include_once("menu.php");
require_once("mongo_connect.php");
include_once("marks-entry-action.php");
?>

<body>
<section>
    <div class="main-content">

        <form class="form-basic" method="post" action="Marks-Entry.php" >

            <div class="form-title-row">
				<h1>Select the Batch and the Semester<br>to Enter Marks</h1>
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
				</div>

				<div class="form-row">
					<label>
						<span>Select Semester</span>
						<select name="sem_select">
							<option value="">-----------------Select-----------------</option>

<!-- POPULATE SELECT SEMESTER AS PER BATCH SELECTED ----- PENDING! -->

							<option value="1">Semester 1</option>
							<option value="2">Semester 2</option>
							<option value="3">Semester 3</option>
							<option value="4">Semester 4</option>
						</select>
					</label>
				</div>
				

			</fieldset><br><br>
			
            <div class="form-row">
               <input class="submit_button" type="submit" name="confirm" value="CONFIRM">	
            </div>

        </form>
		
		<br><br><br><br>

    </div>
</section>

</body>

</html>


