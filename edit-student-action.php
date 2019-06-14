<?php

require_once("mongo_connect.php");
$student_info_col = $db->student_info;
$student_sub_col = $db->student_sub;



/* Edit Student Action */
if(isset($_POST['submit'])  ){
	
	//non-required form fields:
	$language = '';
	$subjects = '';	
	$rollno = '';
	$qualification = '';
	$CETscore = '';

	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$gender = $_POST['gender'];
	$language = $_POST['language'];
	$subjects = $_POST['subjects'];
	$batch = $_POST['a_year'];
	$PRNno = $_POST['PRNno'];
	$rollno = $_POST['rollno'];
	$qualification = $_POST['qualification'];
	$CETscore = $_POST['CETscore'];

	$query = 	array( '$or' => array( array(  "PRNno" => $PRNno ) , array(  "batch" => $batch , "rollno" =>$rollno ) )	) ;			   
	$update_info_doc = array(  '$set' => array(	"fname" => $fname,
												"lname" => $lname,
												"gender" => $gender,
												"language" => $language,
												"batch" => $batch,
												"PRNno" => $PRNno,
												"rollno" => $rollno,
												"qualification" => $qualification,
												"CETscore" => $CETscore
											)
						);

	$update_sub_doc = array(  '$set' => array(	"subjects" => $subjects,
												"batch" => $batch,
												"PRNno" => $PRNno,
												"rollno" => $rollno,
											)
							);

	$isUpdated_1 = $student_info_col->update( $query, $update_info_doc);
	$isUpdated_2 = $student_sub_col->update( $query, $update_sub_doc);

	if($isUpdated_1 && $isUpdated_2){
		?>
		<script>alert('Student Updated Successfully');</script>
		<?php
	}
}
?>




