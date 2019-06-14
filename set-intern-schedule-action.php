<?php 

require_once("mongo_connect.php");

if(isset($_POST['confirm'])){

	for($i=0; $i<10; $i++){
		$schools[$i] = 0;
	}

/* -------------------- Fetch Form Data ----------------------------- */
	$school_temp = $_POST['schools'];
	$batch = $_POST['batch_select'];
	$date = $_POST['datepicker'];	

	//session_start();		//note
	//$_SESSION['selectedschools'] = $school_temp;
	
	/*
	$duration = $_POST['duration'];
	$totalLessons = (4*$duration);
	$perSubLessons = ($totalLessons/2);
	*/



	/* -------Get schools in variables------------ */	
	$j = 0;
	foreach($school_temp as $ele){
		$schools[$j] = $ele;
		$j++;
	}

	$school1 = trim($schools[0]);	//school1 means the 1st school selected, not school_id=1
	$school2 = trim($schools[1]);
	$school3 = trim($schools[2]);
	$school4 = trim($schools[3]);

/* -------------- Select Required Collections ------------------------- */

	$student_sub_col = $db->student_sub;
	$timetable_col = $db->timetable;
	$intern_schedule_col = $db->intern_schedule;


/* -------------- Retrieve in Cursors from collections ----------------------- */

	//find students in "student_sub" collections by "batch" 
	$query1 = array( "batch" => $batch );
	$cursor1 = $student_sub_col->find($query1);

/* ------------- Setting Schedule ---------------- */

	$schoolcount = count($school_temp);	//3
	$studentcount = $cursor1->count();	//12
	$groupcount = ceil($studentcount/$schoolcount);	//4			//note ceil function

	$kSchool = 1;

	while($kSchool<=$schoolcount){
		$k=1;
		while( $cursor1->hasNext() && $k<=$groupcount ){
			$result1 = $cursor1->getNext();
			$subjects = $result1["subjects"];
			
			switch($kSchool){
				case 1: $query2 = array( "school_id" => $school1);
						$cursor2 = $timetable_col->find($query2);
						break;

				case 2: $query2 = array( "school_id" => $school2);
						$cursor2 = $timetable_col->find($query2);
						break;

				case 3: $query2 = array( "school_id" => $school3);
						$cursor2 = $timetable_col->find($query2);
						break;

				case 4: $query2 = array( "school_id" => $school4);
						$cursor2 = $timetable_col->find($query2);
						break;
			}

			$lessonNo = 1;
			$byTime = array( "time" => 1 );
			$cursor2 = $cursor2->sort($byTime);
			$cursor2->rewind();		//note
			
			while($cursor2->hasNext() && $lessonNo<=2){

				$result2 = $cursor2->getNext();

				if( ($subjects[0] == $result2['sub_id']) && ($result2['flag'] == 'FALSE') && ($result2['day'] == '1') ){

					if($lessonNo == 1){
						$prevPeriod = $result2['period'];
						setSchedule($result1, $result2, $lessonNo, $timetable_col, $intern_schedule_col, $date);
						$lessonNo++;
					}
					else if($lessonNo == 2 && $result2['period'] != $prevPeriod){
						setSchedule($result1, $result2, $lessonNo, $timetable_col, $intern_schedule_col, $date);
						$lessonNo++;
					}
				}		
			}

			$cursor2->rewind();		//note
			while($cursor2->hasNext() && $lessonNo<=4){
				$result2 = $cursor2->getNext();
				if($subjects[1] == $result2['sub_id']  && $result2['flag'] == 'FALSE' && $result2['day'] == '2' ){

					if($lessonNo == 3){			//to ensure same period is not assigned to a student for both lessonss
					$prevPeriod = $result2['period'];
					setSchedule($result1, $result2, $lessonNo, $timetable_col, $intern_schedule_col, $date);
					$lessonNo++;
					}
					else if($lessonNo == 4 && $result2['period'] != $prevPeriod){
						setSchedule($result1, $result2, $lessonNo, $timetable_col, $intern_schedule_col, $date);
						$lessonNo++;
					}
				}		
			}
			$k++;

		}
		$kSchool++;
	}

}

function setSchedule($result1, $result2, $lessonNo, $timetable_col, $intern_schedule_col, $date){


	//echo "<br>Schedule getting set for:".$result1['rollno'];
	$day_set = $result2['day'];
	$school_set = $result2['school_id'];
	$class_set = $result2['class'];
	$period_set = $result2['period'];
	$subject_set = $result2['sub_id'];
	$time_set = $result2['time'];
		
	$batch_set = $result1['batch'];
	$rollno_set = $result1['rollno'];

	if($result2['day'] == 1){
		$date_set = new MongoDate( strtotime("$date") );
	}
	else{
		$date_set = new MongoDate( strtotime("+1 day", strtotime("$date")) );
	}

	$select = array("sub_id" => $result2['sub_id'] );
	$update_flag = array('$set' => array("flag" => "TRUE"));
	$timetable_col->update($select, $update_flag);



	$insertSchedule = array( "rollno_set" => $rollno_set,
							 "batch_set" => $batch_set,
							 "lessonNo" => $lessonNo,
							 "day_set" => $day_set,
							 "school_set" => $school_set,
							 "class_set" => $class_set,
							 "period_set" => $period_set,
							 "subject_set" => $subject_set,
							 "date_set" => $date_set,
							 "time_set" => $time_set
							 
						);

	$intern_schedule_col->insert($insertSchedule);
}


 ?>