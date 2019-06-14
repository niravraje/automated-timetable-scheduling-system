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
?>

<body>


<section>
<div class="main-content">

    <form class="form-basic" action="View-Batch-Interns.php" method="post">

        <div class="form-title-row">
            <h1>Select Batch to View Internship Schedule</h1>
        </div> 

		<table class="table-fill">
			<thead>
				<tr>
					<th>BATCH</th>
					<th>CURRENT ACADEMIC YEAR</th>
				</tr>
			</thead>

			<tbody class="table-hover">
				<tr>
					<td><input class="submit_button" name="confirm2016" type="submit" value="B.Ed. 2016 Batch"></td>
					<td>First Year</td>	
				</tr>

				<tr>
					<td><input class="submit_button" name="confirm2015" type="submit" value="B.Ed. 2015 Batch"></td>
					<td>Second Year</td>
				</tr>

				<tr>
					<td><input class="submit_button" name="confirm2014" type="submit" value="B.Ed. 2014 Batch"></td>
					<td>Course Completed</td>
				</tr>

			</tbody>
		</table>
	</form>
</div>
</section>

<br><br><br><br>

</body>

</html>


