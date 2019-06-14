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
include_once("edit-student-action.php");	/* As user will be re-directed to the Select page after clicking Submit on Edit-Student-Details page. */
?>

<body>
<section>
    <div class="main-content">

        <form class="form-basic" method="post" action="Edit-Student-Details.php">	<!--	User directed to Edit-Student-Details page	-->

            <div class="form-title-row">
				<h1>Edit Student Details</h1>
            </div>
			
			<fieldset><br>
				<div class="form-row">
					<label>
						<span>Enter PRN of Student : </span>
						<input type="text" name="PRNno_select" placeholder="Permanent Registration Number">
					</label>
				</div>		
			</fieldset>			
			<br><center><b>OR</b></center><br>
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
						<span>Enter Roll Number of student : </span>
						<input type="text" name="rollno_select" placeholder="Roll Number">
					</label>
				</div>
			</fieldset><br><br>
			

			

			
            <div class="form-row">
               <input class="submit_button" type="submit" name="confirm" value="CONFIRM">	
            </div>

        </form>
		
<?php
	if(!isset($_POST['confirm'])){
		echo '<br><br><br><br>';
}
?>

    </div>
</section>

</body>

</html>


