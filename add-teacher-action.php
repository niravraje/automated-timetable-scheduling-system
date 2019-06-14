<?php
/* Form Handling of Added Teacher */


require_once("mongo_connect.php");
$teacher_collection = $db->teacher;

if(isset($_POST['submit'])){
	
	//non-required form fields:

	//form fetch
	$teacher_name = $_POST['teacher_name'];
	$teacher_PRNno = $_POST['teacher_PRNno'];

	$teacher_subjects = $_POST['teacher_subjects'];
	

	$document = array(  "teacher_name" => $teacher_name,
						"teacher_PRNno" => $teacher_PRNno,
						"subjects" => $teacher_subjects							
				   );
								   
	$isInserted = $teacher_collection->insert($document);		

	if($isInserted){
		?>
		<script>alert('Teacher Added Successfully');</script>
		<?php
	}

}
?>