<html>
<head>
	<link rel="stylesheet" href="assets/table-style1.css">
	<link rel="stylesheet" href="assets/view-schedule-style.css">
</head>

<?php
session_start();
if( !isset($_SESSION['username']) ){
	header('Location: login.php');
}
include_once("menu.php");
require_once("mongo_connect.php");
?>

<body>

<?php 
$teacher_col = $db->teacher;
$teacher_cursor = $teacher_col->find();
$school_col = $db->school;
$school_cursor = $school_col->find();

$schoolcount = $school_cursor->count();

//session_start();		//note
//$schoolcount = $_SESSION['selectedschools'];
 ?>



<section>
<div class="main-content">

    <form class="form-basic">

        <div class="form-title-row">
            <h1>B.Ed. Teachers Timetable as Internship Mentors</h1>
        </div> 

		<table class="table-fill">
			<thead>
				<tr>
					<th>Teacher Name</th>
					<th>Date</th>
					<th>Batch</th>
					<th>School</th>
					<th>School Timing</th>
					<th>Co-ordinator Name</th>
					<th>Co-ordinator Contact Number</th>
					<th>School Office Number</th>
				</tr>
			</thead>

			<tbody class="table-hover">
				
				<?php 
					while($school_cursor->hasNext()){			//note display depends on schoolcount
						$school_result = $school_cursor->getNext();
						$teacher_result = $teacher_cursor->getNext();
				 ?>

				<tr>
					<td><?php echo $teacher_result['teacher_name']; ?></td>
					<td>25 OCT 2016</td>	
					<td>2016</td>	
					<td><?php echo $school_result['school_name']; ?></td>	
					<td><?php echo $school_result['start_time']; ?> to <?php echo $school_result['end_time']; ?></td>
					<td><?php echo $school_result['co_name']; ?></td>	
					<td><?php echo $school_result['co_contact_no']; ?></td>	
					<td><?php echo $school_result['office_contact_no']; ?></td>	
				</tr>

				<?php } ?>
			</tbody>
		</table>
	</form>
</div>
</section>

<br><br><br><br>

</body>

</html>


