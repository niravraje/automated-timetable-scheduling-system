<?php
session_start();
if( !isset($_SESSION['username']) ){
	header('Location: login.php');
}
include_once("menu.php");
require_once("mongo_connect.php");
include_once("select-student-action.php");	
?>


<html>
<head>
	<link rel="stylesheet" href="assets/form-basic.css">
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



<body>
<section>
    <div class="main-content">

        <form  id="addstudentform" name="addstudentform" class="form-basic" action="Edit-Student-Select.php" method="post">

            <div class="form-title-row">
                <h1>Edit Student</h1>
            </div>

			<fieldset>
			<legend>PERSONAL DETAILS</legend><br>
				<div class="form-row">
					<label>
						<span>First Name</span>
						<input type="text" name="fname" value="<?php  echo $result_s_info['fname']; ?>" required>
					</label>
				</div>

				<div class="form-row">
					<label>
						<span>Last Name</span>
						<input type="text" name="lname" value="<?php  echo $result_s_info['lname']; ?>" required>
					</label>
				</div>
				
				<div class="form-row">
					<label><span>Gender</span></label>
					<div class="form-radio-buttons">

						<div>
							<label>
								<input type="radio" name="gender" value="Male" <?php echo ($result_s_info['gender']=='Male') ? 'checked' : '' ; ?>>
								<span>Male</span>
							</label>
						</div>

						<div>
							<label>
								<input type="radio" name="gender" value="Female" <?php echo ($result_s_info['gender']=='Female') ? 'checked' : '' ; ?>>
								<span>Female</span>
							</label>
						</div>
						
						<div>
							<label>
								<input type="radio" name="gender" value="Other" <?php echo ($result_s_info['gender']=='Other') ? 'checked' : '' ; ?>>
								<span>Other</span>
							</label>
						</div>						

					</div>
				</div>

				<div class="form-row">
					<label>
						<span>Language of Medium</span>
						<select name="language">
							<option value="">-----------------Select-----------------</option>
							<option value="English" <?php if($result_s_info['language'] == 'English') { ?> selected="selected"<?php } ?> >English</option>
							<option value="Marathi" <?php if($result_s_info['language'] == 'Marathi') { ?> selected="selected"<?php } ?> >Marathi</option>
						</select>
					</label>
				</div>
			
			</fieldset>
			<br>
			
<?php		
	function getRandomString(){
		$length = 8;
		$characters = '123456789ACFHLMNPRSV';
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
						<input type="text" name="PRNno" value="<?php  echo $result_s_info['PRNno']; ?>" readonly>
					</label>
				</div>
				
				 <div class="form-row">
					<label>
						<span>Roll Number <br>(if assigned)</span>
						<input type="text" name="rollno" value="<?php  echo $result_s_info['rollno']; ?>">
					</label>
				</div>
				
				 <div class="form-row">
					<label>
						<span>Admission Year</span>
						<input type="text" name="a_year" value="<?php  echo $result_s_info['batch']; ?>" readonly>
					</label>
				</div>			
			
				<div class="form-row">
					<label>
						<span>Qualification</span>
						<select name="qualification">
							<option value="">-----------------Select-----------------</option>
							<option value="B.A." <?php if($result_s_info['qualification'] == 'B.A.') { ?> selected="selected"<?php } ?>>B.A.</option>
							<option value="M.A." <?php if($result_s_info['qualification'] == 'M.A.') { ?> selected="selected"<?php } ?>>M.A.</option>
							<option value="B.Sc." <?php if($result_s_info['qualification'] == 'B.Sc.') { ?> selected="selected"<?php } ?>>B.Sc.</option>
							<option value="M.Sc." <?php if($result_s_info['qualification'] == 'M.Sc.') { ?> selected="selected"<?php } ?>>M.Sc.</option>
							<option value="B.Com." <?php if($result_s_info['qualification'] == 'B.Com.') { ?> selected="selected"<?php } ?>>B.Com.</option>
							<option value="M.Com." <?php if($result_s_info['qualification'] == 'M.Com.') { ?> selected="selected"<?php } ?>>M.Com.</option>
						</select>
					</label>
				</div>			
				
				 <div class="form-row">
					<label>
						<span>B.Ed. CET Score<br>Out Of 100</span>
						<input type="text" name="CETscore" value="<?php  echo $result_s_info['CETscore']; ?>" readonly>
					</label>
				</div>				
			
				<div class="form-row">
					<label><span>Subject Specific Methodology Courses <br>(Select Only 2)</span></label>
					<div class="form-checkbox-buttons">

					<?php
						$subject_collection = $db->subject;
						$cursor_sub = $subject_collection->find();
						$cursor_sub = $cursor_sub->sort(array("sub_id" => 1));
						while($cursor_sub->hasNext() ){
							$result_sub = $cursor_sub->getNext(); 	
					?>
					
					
						<div>
							<label>
								<input type="checkbox" name="subjects[]" value="<?php	echo $result_sub['sub_id']; ?> " 
								<?php 
									$sub = $result_s_sub['subjects'];
									$sub_scanned  = $result_sub['sub_id'];
									if($sub[0] == $sub_scanned) { echo 'checked';}
									if($sub[1] == $sub_scanned) { echo 'checked';}
								?>	>
								<span>
									<?php	echo $result_sub['sub_name']; ?>
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
		<!-- 		<button type="submit" name="submit" value="submit">SUBMIT FORM</button>	-->
            </div>

        </form>
		<script type="text/javascript">checkboxlimit(document.forms.addstudentform["subjects[]"], 2)</script>

    </div>
</section>

</body>




</html>


