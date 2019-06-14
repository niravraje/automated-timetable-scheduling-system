<?php

require_once("mongo_connect.php");
$school_collection = $db->school;

if(isset($_POST['submit'])){
	
	//non-required form fields:
	
	
	$school_name = $_POST['school_name'];

	
	
	$document = array("school_name" => $school_name,
								   );
						   
	$isInserted = $school_collection->insert($document);		
	
	if($isInserted){
		?>
		<script>alert('School Added Successfully');</script>
		<?php
	}

}
?>