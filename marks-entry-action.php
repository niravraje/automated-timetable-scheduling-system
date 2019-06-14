<?php 
if( isset($_POST['submit']) ){
	
	$batch = $_POST['batch'];
	$rollnos = $_POST['rollno'];
	$semester = $_POST['semester'];
	$sub1marks = $_POST['sub1marks'];
	$sub2marks = $_POST['sub2marks'];

	$student_info_col = $db->student_info;
	$getStudents = array( "batch" => $batch );
	$cursor_s_info = $student_info_col->find($getStudents);
	$studentcount = $cursor_s_info->count();

	for($i=0; $i<$studentcount; $i++){

		$marks_sub1 = $sub1marks[$i];
		$marks_sub2 = $sub2marks[$i];
		$rollno = $rollnos[$i];


		$insertMarks = array( "batch" => $batch,
							  "semester" => $semester,
							  "rollno" => $rollno,
							  "sub1marks" => $marks_sub1,
							  "sub2marks" => $marks_sub2
						 );

		error_reporting(0);
		$marks_col = $db->marks;
		$marks_col->insert($insertMarks);

	}
}

 ?>