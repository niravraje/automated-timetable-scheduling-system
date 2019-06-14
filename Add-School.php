<?php
session_start();
if( !isset($_SESSION['username']) ){
	header('Location: login.php');
}
include_once("menu.php");
include_once("add-school-action.php");
?>

<html>
<head>
	<link rel="stylesheet" href="assets/form-basic.css">
</head>

<body>
<section>
    <div class="main-content">

        <form class="form-basic" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

            <div class="form-title-row">
                <h1>Add School</h1>
            </div>
			<fieldset><br>
			<div class="form-row">
				<label>
					<span>Name of the School</span>
					<input type="text" name="school_name" placeholder="School Name" required>
				</label>
			</div>
			
			<div class="form-row">
				<label>
					<span>City</span>
					<input type="text" name="school_city" placeholder="City" required>
				</label>
			</div>				
			
			<div class="form-row">
				<label>
					<span>Area</span>
					<input type="text" name="school_area" placeholder="Area/Locality" required>
				</label>
			</div>		
			
			<div class="form-row">
				<label>
					<span>Name of the Principal</span>
					<input type="text" name="principal_name" placeholder="Principal Name" required>
				</label>
			</div>
			
			<div class="form-row">
				<label>
					<span>Name of the Co-ordinator<br></span>
					<input type="text" name="co_name" placeholder="Co-ordinator Name" required>
				</label>
			</div>			
			
			<div class="form-row">
				<label>
					<span>Contact Number of Co-ordinator<br></span>
					<input type="text" name="co_contact_no" placeholder="10 Digit Mobile No." required>
				</label>
			</div>	
			
			<div class="form-row">
				<label>
					<span>School Timings</span>
					<input id="timing" type="text" name="start_time" placeholder="HH:MM" required>
					&nbsp;&nbsp;&nbsp;to&nbsp;&nbsp;&nbsp;
					<input id="timing" type="text" name="end_time" placeholder="HH:MM" required>
				</label>
			</div>
			
			<div class="form-row">
				<label>
					<span>Office Contact Number<br></span>
					<input type="text" name="office_contact_no" placeholder="020XXXXXXXX" required>
				</label>
			</div>	
			</fieldset> <br>
			<br>
            <div class="form-row">
               <input class="submit_button" type="submit" name="submit" value="SUBMIT FORM">	
            </div>

        </form>
<br><br>

    </div>
</section>

</body>




</html>


