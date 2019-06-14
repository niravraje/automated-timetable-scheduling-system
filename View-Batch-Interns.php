<?php
session_start();
if( !isset($_SESSION['username']) ){
	header('Location: login.php');
}
include_once("menu.php");
require_once("mongo_connect.php");
?>

<html>
<head>
	<link rel="stylesheet" href="assets/table-style2.css">
	<link rel="stylesheet" href="assets/view-schedule-style.css">
</head>

<?php 
	$batch_select = 0;
	switch(1){
		case (isset($_POST['confirm2016'])): $batch_select = "2016";
											 break;
		case (isset($_POST['confirm2015'])): $batch_select = "2015";
											 break;
		case (isset($_POST['confirm2014'])): $batch_select = "2014";
											 break;
	}



	/* ------------- Selecting collections ---------- */
	$intern_schedule_col = $db->intern_schedule;
	$student_sub_col = $db->student_info;
	$school_col = $db->school;
	$subject_col = $db->subject;
	$schoolteacher_col = $db->schoolteacher;
	/*----------------------------------------------- */

	$query1 = array("batch_set" => $batch_select, "day_set" => "1");
	$cursor1 = $intern_schedule_col->find($query1);

	$query2 = array("batch_set" => $batch_select, "day_set" => "2");
	$cursor2 = $intern_schedule_col->find($query2);

	$sort_query = array("rollno_set" => 1);
	$cursor1 = $cursor1->sort($sort_query);
	$cursor2 = $cursor2->sort($sort_query);

	$count1 = $cursor1->count();
	$count2 = $cursor2->count();

/*	$schoolcount = $school_col->count();	
	$studentcount = $student_sub_col->count();	//12
	$groupcount = ceil($studentcount/$schoolcount);		// for mentor; mentor is to a group;
*/

 ?>

<body>
<section>
	<form class="form-basic">
        <div class="form-title-row">
            <h1>B.Ed. <?php echo $batch_select; ?> Batch Internship Schedule</h1>
        </div> 	

<!-- *********************** TABLE 1 **************************************-->
        <?php 
        	$result1 = $cursor1->getNext();
			$date1 = $result1['date_set'];
			$date1pretty = date('d F Y l', $date1->sec);

			

        	if($count1 != 0){
         ?>

        <div class="table-title">
			<h3>
				<?php 
					echo $date1pretty; 
				?>
			</h3>
		</div>

        <table class="table-fill">
			<thead>
				<tr>
					<th>Roll No</th>
					<th>Student Name</th>
					<th>School</th>
					<th>Lesson</th>
					<th>Class</th>
					<th>Period</th>
					<th>Subject</th>
					<th>Time</th>
					<th>Observer</th>
				</tr>
			</thead>

			<tbody class="table-hover">
			<?php 
					
				while($cursor1->hasNext()){
					//get student name
					$rollno_set = $result1['rollno_set'];
					$findStudent = array("rollno" => $rollno_set);
					$student_result = $student_sub_col->findOne($findStudent);

					//get school name
					$school_set = $result1['school_set'];
					$findSchool = array("school_id" => $school_set);
					$school_result = $school_col->findOne($findSchool);

					//get subject name
					$subject_set = $result1['subject_set'];
					$findSubject = array("sub_id" => $subject_set);
					$subject_result = $subject_col->findOne($findSubject);

					//get school teacher name
					$schoolteacher = array("school_id" => $school_set, "sub_id" => $subject_set);
					$schoolteacher_result = $schoolteacher_col->findOne($schoolteacher);

			 ?>
				<tr>
					<td rowspan="2"><?php echo $result1['rollno_set']; ?></td>
					<td rowspan="2"><?php echo $student_result['fname']." ".$student_result['lname']; ?></td>	
					<td rowspan="2"><?php echo $school_result['school_name']; ?></td>	
					<td><?php echo $result1['lessonNo']; ?></td>
					<td><?php echo $result1['class_set']; ?></td>	
					<td><?php echo $result1['period_set']; ?></td>	
					<td><?php echo $subject_result['sub_name']; ?></td>	
					<td><?php echo $result1['time_set']; ?></td>
					<td><?php echo $schoolteacher_result['s_teacher']; ?></td>	
				</tr>
				<tr>
					<?php $result1 = $cursor1->getNext(); ?>
					<td><?php echo $result1['lessonNo']; ?></td>
					<td><?php echo $result1['class_set']; ?></td>
					<td><?php echo $result1['period_set']; ?></td>
					<td><?php echo $subject_result['sub_name']; ?></td>
					<td><?php echo $result1['time_set']; ?></td>
					<td><?php echo $schoolteacher_result['s_teacher']; ?></td>
				</tr>
			<?php
				$result1 = $cursor1->getNext();
				}
			 ?>

			</tbody>

		<?php 
			}
			else{
				echo "<center><h1> NO DATA FOR DAY 1 <h1><center>";
			}

		 ?>
		</table>

<!-- ********************** TABLE 2 ***********************8 -->
        <?php 
        	$result2 = $cursor2->getNext();
			$date2 = $result2['date_set'];
			$date2pretty = date('d F Y l', $date2->sec);
        	if($count2 != 0){
         ?>

        <div class="table-title">
			<h3>
				<?php 
					echo $date2pretty; 
				?>
			</h3>
		</div>

        <table class="table-fill">
			<thead>
				<tr>
					<th>Roll No</th>
					<th>Student Name</th>
					<th>School</th>
					<th>Lesson</th>
					<th>Class</th>
					<th>Period</th>
					<th>Subject</th>
					<th>Time</th>
					<th>Observer</th>
				</tr>
			</thead>

			<tbody class="table-hover">
			<?php 
					
				while($cursor2->hasNext()){
					//get student name
					$rollno_set = $result2['rollno_set'];
					$findStudent = array("rollno" => $rollno_set);
					$student_result = $student_sub_col->findOne($findStudent);

					//get school name
					$school_set = $result2['school_set'];
					$findSchool = array("school_id" => $school_set);
					$school_result = $school_col->findOne($findSchool);

					//get subject name
					$subject_set = $result2['subject_set'];
					$findSubject = array("sub_id" => $subject_set);
					$subject_result = $subject_col->findOne($findSubject);

					//get school teacher name
					$schoolteacher = array("school_id" => $school_set, "sub_id" => $subject_set);
					$schoolteacher_result = $schoolteacher_col->findOne($schoolteacher);					

			 ?>
				<tr>
					<td rowspan="2"><?php echo $result2['rollno_set']; ?></td>
					<td rowspan="2"><?php echo $student_result['fname']." ".$student_result['lname']; ?></td>	
					<td rowspan="2"><?php echo $school_result['school_name']; ?></td>	
					<td><?php echo $result2['lessonNo']; ?></td>
					<td><?php echo $result2['class_set']; ?></td>	
					<td><?php echo $result2['period_set']; ?></td>	
					<td><?php echo $subject_result['sub_name']; ?></td>	
					<td><?php echo $result2['time_set']; ?></td>
					<td><?php echo $schoolteacher_result['s_teacher']; ?></td>	
				</tr>
				<tr>
					<?php $result2 = $cursor2->getNext(); ?>
					<td><?php echo $result2['lessonNo']; ?></td>
					<td><?php echo $result2['class_set']; ?></td>
					<td><?php echo $result2['period_set']; ?></td>
					<td><?php echo $subject_result['sub_name']; ?></td>
					<td><?php echo $result2['time_set']; ?></td>
					<td><?php echo $schoolteacher_result['s_teacher']; ?></td>
				</tr>
			<?php
				$result2 = $cursor2->getNext();
				}
			 ?>

			</tbody>

		<?php 
			}
			else{
				echo "<center><h1> NO DATA FOR DAY 2<h1><center>";
			}

		 ?>
		</table>
	</form>
</section>
</body>
<br><br><br><br>
</html>


