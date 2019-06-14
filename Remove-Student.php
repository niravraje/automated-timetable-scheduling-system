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
include_once("remove-student-action.php");
?>

<body>
<section>
    <div class="main-content">

        <form class="form-basic" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

            <div class="form-title-row">
				<h1>Remove Student</h1>
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
			
			<p>NOTE: This action is IRREVERSIBLE.</p>
			
            <div class="form-row">
               <input class="submit_button" type="submit" name="confirm" value="CONFIRM">	
            </div>

        </form>
		
		<br><br><br><br>

    </div>
</section>

</body>

</html>


