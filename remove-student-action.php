<?php
/* Form Handling to Remove Student */

require_once("mongo_connect.php");

if(isset($_POST['confirm'])){
	
		$student_info_col = $db->student_info;
		$student_sub_col = $db->student_sub;

		$PRNno_select = $_POST['PRNno_select'];
		$batch_select = $_POST['batch_select'];
		$rollno_select = $_POST['rollno_select'];
		
		/* Find document  with:  [PRN no. only] or [by selecting batch and roll number] */
		$select = array( '$or' => array( array(  "PRNno" => $PRNno_select ) , 
										 array(  "batch" => $batch_select , "rollno" => $rollno_select ) 
									   )	
						); 
		
		$isRemoved_1 = $student_info_col->remove($select, array("justOne" => true));
		$isRemoved_2 = $student_sub_col->remove($select, array("justOne" => true));

		if($isRemoved_1 && $isRemoved_2){
		?>
		<script>alert('Student Removed');</script>
		<?php
	}
		
}
?>
