<?php
session_start();
if( !isset($_SESSION['username']) ){
	header('Location: login.php');
}
include_once("menu.php");
require_once("mongo_connect.php");
//include_once("add-timetable-action.php");
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
                <h1>Add Timetable</h1>
            </div>
					
	

			<fieldset>
			<legend>SPECIFICATIONS REQUIRED</legend><br>
				<div class="form-row">
					<label>
						<span>Select School</span>
						<select name="language">
							<option value=""><center>-----------------Select-----------------</center></option>
							<?php
							$school_collection = $db->school;
							$cursor = $school_collection->find();
							$cursor = $cursor->sort(array("school_id" => 1));
							while($cursor->hasNext()){
								$result = $cursor->getNext();
							?>	
								<option value="<?php	echo $result['school_name'];	?>">
									<?php	echo $result['school_name'];	?>
								</option>
							<?php	}	?>
						</select>
					</label>
				</div>
				
				
				<div class="form-row">
					<label>
						<span>Class/Standard</span>
						<input type="text" name="school_area" placeholder="Example: 7 " required>
					</label>
				</div>			
				
				<div class="form-row">
					<label>
						<span>Select Day of the Week</span>
						<select name="language">
							<option value="">-----------------Select-----------------</option>
							<option value="Tuesday">Tuesday</option>
							<option value="Thursday">Thursday</option>
						</select>
					</label>
				</div>
				
			</fieldset><br>

			
			<fieldset>
			<legend>PERIOD-WISE TIMETABLE ENTRY</legend><br>
			
			<?php
			for($i=1; $i<=10; $i++){
			?>
				<div class="form-row">
					<label>
						<span>Period <?php echo $i; ?></span>
						<select name="<?php echo 'period'.$i; ?>">
							<option value="">-----------------Select-----------------</option>
						<?php
							$subject_collection = $db->subject;
							$cursor =	$subject_collection->find();
							$cursor = $cursor->sort(array("sub_id" => 1));
							while($cursor->hasNext()){
								$result = $cursor->getNext();
						?>

							<option value="<?php	echo $result['sub_name'];	?>">
								<?php	echo $result['sub_name'];	?>
							</option>
							<?php	}	?>	

						</select>
					</label>
				</div>
			<?php	}	?>
			
			</fieldset>

			<br>
            <div class="form-row">
               <input class="submit_button" type="submit" name="submit" value="SUBMIT TIMETABLE">	
            </div>

        </form>
<br><br>

    </div>
</section>

</body>




</html>


