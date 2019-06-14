<?php
session_start();
if( !isset($_SESSION['username']) ){
	header('Location: login.php');
}
include_once("menu.php");
include_once("add-teacher-action.php");
?>

<html>
<head>
	<link rel="stylesheet" href="assets/form-basic.css">
</head>

<body>
<section>
    <div class="main-content">

        <form class="form-basic" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

            <div class="form-title-row">
                <h1>Add Teacher</h1>
            </div>
            <fieldset><br>	
			<div class="form-row">
				<label>
					<span>Name of the Teacher</span>
					<input type="text" name="teacher_name" placeholder="Teacher Name" required>
				</label>
			</div>
			
<?php		
	function getRandomString(){
		$length = 3;
		$characters = '123456789';
		$randomString = '';

		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
	
?>			
			
			<div class="form-row">
				<label>
					<span>Registration Number</span>
					<input type="text" name="teacher_PRNno" value="<?php echo 'T'.$PRN = getRandomString(); ?>" readonly>
				</label>
			</div>	
			
			
			<div class="form-row">
				<label><span>Subjects of Expertise</span></label>
				<div class="form-checkbox-buttons">

				<?php
					$subject_collection = $db->subject;
					$cursor = $subject_collection->find();
					$cursor = $cursor->sort(array("sub_id" => 1));
					while($cursor->hasNext() ){
						$result = $cursor->getNext();
						static $i = 0;  
				?>
				
					<div>
						<label>
							<input type="checkbox" name="teacher_subjects[]" value="<?php	echo $result['sub_id'] ?>" > 
							<span>
								<?php	echo $result['sub_name'];  ?>
							</span>
						</label>
					</div>
					
		<?php } ?>
					</div>	
				</div>		
			
			<br>
            <div class="form-row">
               <input class="submit_button" type="submit" name="submit" value="SUBMIT">	
            </div>
            </fieldset>
        </form>
<br><br>

    </div>
</section>

</body>




</html>


