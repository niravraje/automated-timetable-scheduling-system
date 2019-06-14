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
	<link rel="stylesheet" href="assets/table-style3.css">
	<link rel="stylesheet" href="assets/view-schedule-style.css">
</head>


<?php 

$batch_select = $_POST['batch_select'];
$sem_select = $_POST['sem_select'];

$student_info_col = $db->student_info;
$getStudents = array( "batch" => $batch_select );

$cursor_s_info = $student_info_col->find($getStudents);



?>


<body>
<section>
<div class="main-content">

    <form class="form-basic" action="Marks-Entry-Select.php" method="post">

        <div class="form-title-row">
            <h1>B.Ed. <?php echo $batch_select; ?> Batch Internship Marks</h1>
        </div> 

        <div class="table-title">
			<h2>
				<?php 
					echo "SEMESTER ".$sem_select; 
				?>
			</h2>
		</div>

		<table class="table-fill">
			<thead>
				<tr>
					<th rowspan="2">Roll No</th>
					<th rowspan="2">Student Name</th>
					<th colspan="2" id="marks_th">Marks (Out of 100)</th>
				</tr>
				<tr>
					<th>Subject 1</th>
					<th>Subject 2</th>
				</tr>
			</thead>


			<tbody class="table-hover">
			<?php 
			$k = 0;
				while( $cursor_s_info->hasNext() ){
					$result_s_info = $cursor_s_info->getNext();
					
			 ?>
				<tr>
					<td><?php echo $result_s_info['rollno']; ?></td>
					<input type="hidden" name="rollno[<?php echo $k; ?>]" value="<?php echo $result_s_info['rollno']; ?>">
					<td><?php echo $result_s_info['fname']." ".$result_s_info['lname']; ?></td>
					<td><input class="text_input" type="text" name="sub1marks[<?php echo $k; ?>]" required></td>
					<td><input class="text_input" type="text" name="sub2marks[<?php echo $k; ?>]" required></td>
				</tr>

			<?php 
				$k++;
				}
			 ?>
			</tbody>
		</table>	
		<div class="form-row">
			<br><br>
			<input type="hidden" name="semester" value="<?php echo $sem_select; ?>">
			<input type="hidden" name="batch" value="<?php echo $batch_select; ?>">
        	<input id="submit_marks_button" type="submit" name="submit" value="SUBMIT MARKS">	
        </div>
	</form>
</div>

</section>

<br><br><br><br>

</body>

</html>


