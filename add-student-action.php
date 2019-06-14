<?php
/* Form Handling of Added Student */


require_once("mongo_connect.php");
$student_info_col = $db->student_info;
$student_sub_col = $db->student_sub;

if(isset($_POST['submit'])){

	//non-required form fields:
	$language = '';
	$subjects = '';	
	$rollno = '';
	$qualification = '';
	$CETscore = '';
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$gender = $_POST['gender'];
	$DOB = $_POST['DOB'];			//note
	$language = $_POST['language'];
	$curr_a_year = $_POST['a_year'];
	$batch = $curr_a_year;			//note
	$PRNno = $_POST['PRNno'];
	$rollno = $_POST['rollno'];
	$qualification = $_POST['qualification'];
	$CETscore = $_POST['CETscore'];
	$subjects = $_POST['subjects'];
	

	$info_doc = array(	"fname" => $fname,
						"lname" => $lname,
						"gender" => $gender,
						"DOB" => $DOB,			
						"language" => $language,
						"curr_a_year" => $curr_a_year,
						"PRNno" => $PRNno,
						"rollno" => $rollno,
						"batch" => $batch,				
						"qualification" => $qualification,
						"CETscore" => $CETscore,
						"subjects" => $subjects
					 );
						

	$sub_doc = array(	"rollno" => $rollno,
						"batch" => $batch,	
						"PRNno" => $PRNno,			
						"subjects" => $subjects
					);
								   
	$isInserted_1 = $student_info_col->insert($info_doc);
	$isInserted_2 = $student_sub_col->insert($sub_doc);

	if($isInserted_1 && $isInserted_2){
		?>
		<script>alert('Student Added Successfully');</script>
		<?php
	}
}
?>

