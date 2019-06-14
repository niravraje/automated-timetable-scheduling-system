<html>
<form action = "<?php echo ($_SERVER['PHP_SELF'])	?>" method="post">
 <span>Subject name: </span>
<input type="text" name="sub" required>

<br>
<span>Subject id: </span>
<input type="text" name="id" required>
<br>

<input type="submit" name="submit" value="Submit">
</form>

</html>

<?php
/* Form handling of added subject */

//require_once("../mongo_connect.php");
$connect = new MongoClient();
$db = $connect->internship;
$collection = $db->subject;

if(isset($_POST['submit'])){

	echo "Inserted";
	
	$sub = $_POST['sub'];
	$id = $_POST['id'];

	$document = array("sub_id" => $id,
									"sub_name" => $sub,
								   );
								   
	$collection->insert($document);							   
}
?>