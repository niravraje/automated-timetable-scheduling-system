<?php
/* Form Handling of Added Student */


require_once("mongo_connect.php");
$school_col = $db->school;

if(isset($_POST['submit'])){
	
	//non-required form fields:
	
	$school_id = $_POST['school_id'];
	$school_name = $_POST['school_name'];
	$school_city = $_POST['school_city'];
	$school_area = $_POST['school_area'];
	$principal_name = $_POST['principal_name'];
	$co_name = $_POST['co_name'];
	$co_contact_no = $_POST['co_contact_no'];
	$start_time = $_POST['start_time'];
	$end_time = $_POST['end_time'];
	$office_contact_no = $_POST['office_contact_no'];
	
	
	$document = array("school_id" => $school_id,
									"school_name" => $school_name,
									"school_city" => $school_city,
									"school_area" => $school_area,
									"principal_name" => $principal_name,
									"co_name" => $co_name,
									"co_contact_no" => $co_contact_no,
									"start_time" => $start_time,
									"end_time" => $end_time,
									"office_contact_no" => $office_contact_no	
								   );
						   
	$isInserted = $school_col->insert($document);		
	
	if($isInserted){
		?>
		<script>alert('School Added Successfully');</script>
		<?php
	}

}
?>