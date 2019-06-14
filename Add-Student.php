<?php
session_start();
if( !isset($_SESSION['username']) ){
	header('Location: login.php');
}
include_once("menu.php");
include_once("add-student-action.php");
require_once("mongo_connect.php");
?>

<html>
<head>
	<link rel="stylesheet" href="assets/form-basic.css">
	<link rel="stylesheet" href="assets/jQuery-datetime-picker-style.css">

	<script src="assets/jQuery-Javascript-library1.js"></script>
	<script src="assets/jQuery-Javascript-library2.js"></script>
	<script>
		//var values = '1.1.1990'.split("."); //Default date
       // var parsed_date = new Date(values[2], values[1]-1, values[0]);
		$( function() {
		  $( "#datepicker" ).datepicker({ 
		  		changeYear: true,
		  		dateFormat: 'yy-mm-dd',
		  		minDate: '-71Y',
       		    maxDate: '-21Y',
       		    defaultDate: new Date(1980, 1-1, 1) 
		  	});
		  var SelectedDate = $( ".selector" ).datepicker( "getDate" );
		  return SelectedDate;

		} ); 
/*		var values = '1.2.2016'.split("."); //Default date
        var parsed_date = new Date(values[2], values[1]-1, values[0]);

		$(function() {

		        $( "#datepicker" ).datepicker({ 
		            changeYear: true,
		            minDate: '-50Y',
		            maxDate: '-20Y',
		            defaultDate: parsed_date,
		        });
		    });*/
	</script>

	<script type="text/javascript">
		function checkboxlimit(checkgroup, limit){
			var checkgroup=checkgroup
			var limit=limit
			for (var i=0; i<checkgroup.length; i++){
				checkgroup[i].onclick=function(){
				var checkedcount=0
				for (var i=0; i<checkgroup.length; i++)
					checkedcount+=(checkgroup[i].checked)? 1 : 0
				if (checkedcount>limit){
					alert("Please Select Only "+limit+" Subjects")
					this.checked=false
					}
				}
			}
		}
	</script>
</head>

<?php 
/* Auto Increment Student PRN id	*/

function getNextSequence($name){
	$connect = new MongoClient();
	$db = $connect->internship;

	$counters_col = $db->counters;
	$query = array( "_id" => $name );
	$update = array( '$inc' => array( "seq" => 1 ) );
	$result_update = $counters_col->update( $query, $update, array( "upsert" => true ) );
	$result_find = $counters_col->findOne($query);
	return $result_find['seq'];
}
$nextID = getNextSequence("studentPRN15");
if($nextID < 10)
	$PRN = 'S16L00'.$nextID;
else
	$PRN = 'S16L0'.$nextID;

 ?>


<body>
<section>
    <div class="main-content">

        <form name="addstudentform" id="addstudentform" class="form-basic" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

            <div class="form-title-row">
                <h1>Add Student</h1>
            </div>

			<fieldset>
			<legend>PERSONAL DETAILS</legend><br>
				<div class="form-row">
					<label>
						<span>First Name</span>
						<input type="text" name="fname" placeholder="First Name" required>
					</label>
				</div>

				<div class="form-row">
					<label>
						<span>Last Name</span>
						<input type="text" name="lname" placeholder="Last Name" required>
					</label>
				</div>
				
				<div class="form-row">
					<label><span>Gender</span></label>
					<div class="form-radio-buttons">

						<div>
							<label>
								<input type="radio" name="gender" value="Male" required>
								<span>Male</span>
							</label>
						</div>

						<div>
							<label>
								<input type="radio" name="gender" value="Female">
								<span>Female</span>
							</label>
						</div>
						
						<div>
							<label>
								<input type="radio" name="gender" value="Other">
								<span>Other</span>
							</label>
						</div>						

					</div>
				</div>

				<div class="form-row">
					<label>
						<span>Date of Birth</span>
						<input type="text" id="datepicker" name="DOB" placeholder="Select Date">
					</label>
				</div>				
				
				<div class="form-row">
					<label>
						<span>Language of Medium</span>
						<select name="language">
							<option value="">-----------------Select-----------------</option>
							<option value="English">English</option>
							<option value="Marathi">Marathi</option>
						</select>
					</label>
				</div>
			
			</fieldset>
			<br>
			
<?php		
	function getRandomString(){
		$length = 5;
		$characters = '123456789ACFHLV';
		$randomString = '';

		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
	
?>
			<fieldset>
				<legend>ACADEMIC DETAILS</legend><br>
				<div class="form-row">
					<label>
						<span>PRN</span>
						<input type="text" name="PRNno" value="<?php echo $PRN; ?>" readonly>
					</label>
				</div>
				
				<div class="form-row">
					<label>
						<span>Roll Number <br>(auto assigned)</span>
						<input type="text" name="rollno" value="<?php echo $nextID; ?>" readonly>
					</label>
				</div>
				
				<div class="form-row">
					<label>
						<span>Admission Year</span>
						<input type="text" name="a_year" value="2016" readonly>
					</label>
				</div>			
			
				<div class="form-row">
					<label>
						<span>Qualification</span>
						<select name="qualification">
							<option value="">-----------------Select-----------------</option>
							<option value="B.A.">B.A.</option>
							<option value="M.A.">M.A.</option>
							<option value="B.Sc.">B.Sc.</option>
							<option value="M.Sc.">M.Sc.</option>
							<option value="B.Com.">B.Com.</option>
							<option value="M.Com.">M.Com.</option>
						</select>
					</label>
				</div>			
				
				<div class="form-row">
					<label>
						<span>B.Ed. CET Score<br>Out Of 100</span>
						<input type="text" name="CETscore" min="0" max="100" required>
					</label>
				</div>				
			
				<div class="form-row">
					<label><span>Subject Specific Methodology Courses <br>(Select Only 2)</span></label>
					<div class="form-checkbox-buttons">

					<?php
						$subject_collection = $db->subject;
						$cursor = $subject_collection->find();
						$cursor = $cursor->sort(array("sub_id" => 1));
						while($cursor->hasNext() ){
							$result = $cursor->getNext();
					?>
				
						<div>
							<label>
								<input type="checkbox" name="subjects[]" value="<?php	echo $result['sub_id'] ?>" > 
								<span>
									<?php echo $result['sub_name'];  ?>
								</span>
							</label>
						</div>
					
						<?php } ?>
					</div>
						
				</div>
			</fieldset>
<br><br>


            <div class="form-row">
               <input class="submit_button" type="submit" name="submit" value="SUBMIT FORM">	
            </div>

        </form>
		<script type="text/javascript">checkboxlimit(document.forms.addstudentform["subjects[]"], 2)</script>

    </div>

</section>
</body>






</html>


