<?php 
	require_once("mongo_connect.php");

	$s_rollno = $result_s_info['rollno'];
	$s_batch = $result_s_info['batch'];

	$marks_col = $db->marks;
	$query1 = array( "rollno" => $s_rollno, "batch" => $s_batch, "semester" => "1" );
	$query2 = array( "rollno" => $s_rollno, "batch" => $s_batch, "semester" => "2" );
	$query3 = array( "rollno" => $s_rollno, "batch" => $s_batch, "semester" => "3" );
	$query4 = array( "rollno" => $s_rollno, "batch" => $s_batch, "semester" => "4" );

	$result_s_marks1 = $marks_col->findOne($query1);
	$result_s_marks2 = $marks_col->findOne($query2);
	$result_s_marks3 = $marks_col->findOne($query3);
	$result_s_marks4 = $marks_col->findOne($query4);
				
	if($result_s_marks1 && $result_s_marks2 && $result_s_marks3 && $result_s_marks4){
		$sem1_sub1 = $result_s_marks1['sub1marks'];
		$sem1_sub2 = $result_s_marks1['sub2marks'];
		$sem2_sub1 = $result_s_marks2['sub1marks']; 
		$sem2_sub2 = $result_s_marks2['sub2marks']; 
		$sem3_sub1 = $result_s_marks3['sub1marks']; 
		$sem3_sub2 = $result_s_marks3['sub2marks']; 0;
		$sem4_sub1 = $result_s_marks4['sub1marks']; 
		$sem4_sub2 = $result_s_marks4['sub2marks'];
	}
	else if($result_s_marks1 && $result_s_marks2 && $result_s_marks3){
		$sem1_sub1 = $result_s_marks1['sub1marks'];
		$sem1_sub2 = $result_s_marks1['sub2marks'];
		$sem2_sub1 = $result_s_marks2['sub1marks']; 
		$sem2_sub2 = $result_s_marks2['sub2marks']; 
		$sem3_sub1 = $result_s_marks3['sub1marks']; 
		$sem3_sub2 = $result_s_marks3['sub2marks']; 
		$sem4_sub1 = 0; 
		$sem4_sub2 = 0;
	}
	else if($result_s_marks1 && $result_s_marks2){
		$sem1_sub1 = $result_s_marks1['sub1marks'];
		$sem1_sub2 = $result_s_marks1['sub2marks'];
		$sem2_sub1 = $result_s_marks2['sub1marks']; 
		$sem2_sub2 = $result_s_marks2['sub2marks']; 
		$sem3_sub1 = 0; 
		$sem3_sub2 = 0; 
		$sem4_sub1 = 0; 
		$sem4_sub2 = 0;
	}
	else if($result_s_marks1){
		$sem1_sub1 = $result_s_marks1['sub1marks'];
		$sem1_sub2 = $result_s_marks1['sub2marks'];
		$sem2_sub1 = 0; 
		$sem2_sub2 = 0; 
		$sem3_sub1 = 0; 
		$sem3_sub2 = 0; 
		$sem4_sub1 = 0; 
		$sem4_sub2 = 0;		
	}
	
	 
?>

<!--<!DOCTYPE HTML>-->
<html>

<head>  
	<script type="text/javascript">
	window.onload = function () {
		var chart = new CanvasJS.Chart("chartContainer",
		{
			theme: "theme3",
                        animationEnabled: true,
			/*title:{
				text: "Crude Oil Reserves Vs Production, 2011",
				fontSize: 30
			},*/
			toolTip: {
				shared: true
			},			
			axisY: {
				title: "Marks"
			},
			/*axisY2: {
				title: "million barrels/day"
			},*/			
			data: [ 
			{
				type: "column",	
				name: "<?php	echo $sub1;	?>",
				legendText: "<?php	echo $sub1;	?>",
				showInLegend: true, 
				dataPoints:[
				{label: "Semester-1", y: <?php echo $sem1_sub1; ?>},
				{label: "Semester-2", y: <?php echo $sem2_sub1; ?>},
				{label: "Semester-3", y: <?php echo $sem3_sub1; ?>},
				{label: "Semester-4", y: <?php echo $sem4_sub1; ?>},
				]
			},
			{
				type: "column",	
				name: "<?php	echo $sub2;	?>",
				legendText: "<?php	echo $sub2;	?>",
				
				showInLegend: true,
				dataPoints:[
				{label: "Semester-1", y: <?php echo $sem1_sub2; ?>},
				{label: "Semester-2", y: <?php echo $sem2_sub2; ?>},
				{label: "Semester-3", y: <?php echo $sem3_sub2; ?>},
				{label: "Semester-4", y: <?php echo $sem4_sub2; ?>},
				]
			}
			
			],
          legend:{
            cursor:"pointer",
            itemclick: function(e){
              if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
              	e.dataSeries.visible = false;
              }
              else {
                e.dataSeries.visible = true;
              }
            	chart.render();
            }
          },
        });

chart.render();
}
</script>
  <script type="text/javascript" src="assets/canvasjs.min.js"></script>
</head>
<body>
	<div id="chartContainer" style="height: 300px; width: 100%;"></div>
</body>
</html>