<?php
session_start();
if( !isset($_SESSION['username']) ){
	header('Location: login.php');
}
include_once("menu.php");
require_once("mongo_connect.php");
include_once("select-student-action.php");
?>

<html>
<head>
	<link rel="stylesheet" href="assets/profile-style.css">
</head>



<body>
<section>
    <div class="main-content">

        <form class="form-basic" method="post" action="Edit-Student-Details.php">

            <div class="form-title-row">
				<h1>Student Profile</h1>
            </div>
			
			<fieldset>
			<legend>PERSONAL DETAILS</legend><br>
				<div class="form-row">
					<label>
						<span>Name</span>
						<span id="info"><?php	echo $result_s_info['fname'].' '.$result_s_info['lname'];	?></span>
					</label>
					<label>
						<span>Gender</span>
						<span id="info"><?php	echo $result_s_info['gender'];	?></span>
					</label>
					<label>
						<span>Date of Birth</span>
						<span id="info"><?php	echo $result_s_info['DOB'];	?></span>
					</label>
					<label>
						<span>Language of Medium</span>
						<span id="info"><?php	echo $result_s_info['language'];	?></span>
					</label>
				</div>		
			</fieldset><br>
			
			<fieldset>
			<legend>ACADEMIC DETAILS</legend><br>
				<div class="form-row">
					<label>
						<span>PRN</span>
						<span id="info"><?php	echo $result_s_info['PRNno'];	?></span>
					</label>
					<label>
						<span>Roll Number</span>
						<span id="info"><?php	echo $result_s_info['rollno'];	?></span>
					</label>
					<label>
						<span>Admission Year</span>
						<span id="info"><?php	echo $result_s_info['batch'];	?></span>
					</label>
					<label>
						<span>Qualification</span>
						<span id="info"><?php	echo $result_s_info['qualification'];	?></span>
					</label>
					<label>
						<span>B.Ed. CET Score<br>Out of 100</span>
						<span id="info"><?php	echo $result_s_info['CETscore'];	?></span>
					</label>
					<label>
						<span>Methodology Courses</span>
						<span id="info">

						<?php  
							$sub = $result_s_sub['subjects'];
							$sub1 = getSubName( trim($sub[0]) );		//NOTE: Pass after trimming ONLY!
							$sub2 = getSubName( trim($sub[1]) );
						?>

							1. <?php	echo $sub1;	?><br>
							2. <?php	echo $sub2;	?>

						</span>
					</label>
				</div>		
			</fieldset><br>

			<fieldset>
				<legend>SEMESTER PROGRESS</legend><br>
				<div>
					<?php include("analysis-graph.php"); ?>
				</div>

			</fieldset>

        </form>
		<br><br><br><br><br><br><br>

    </div>
</section>
</body>

</html>


<?php 

	function getSubName($subID){
		
		$connect = new MongoClient();
		$db = $connect->internship;

		$query = array( "sub_id" => $subID );

		$subject_collection = $db->subject;
		$cursor_sub = $subject_collection->find($query);
		$result_sub = $cursor_sub->getNext();
		$subName = $result_sub['sub_name'];
		return $subName;
	}
 ?>