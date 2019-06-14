<?php

/* Select Student Action */
if( isset($_POST['confirm']) ){
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

		$cursor_s_info = $student_info_col->find($select);
		$cursor_s_sub = $student_sub_col->find($select);
		
		$result_s_info = $cursor_s_info->getNext();
		$result_s_sub = $cursor_s_sub->getNext();
	}

?>