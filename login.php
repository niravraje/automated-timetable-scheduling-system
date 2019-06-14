<!DOCTYPE html>
<html>
<head>
<link href='assets/loginstyle.css' rel='stylesheet' type='text/css'>

<title>Login Page</title>
</head>

<body>

<div class="logo"></div>
<div class="login-block">
    <h1>Login</h1>
    <form action="" method="post">
    <input type="text" name="uname" placeholder="Username" id="username" required />
    <input type="password" name="pass" value="" placeholder="Password" id="password" required />
    <button name="login">SUBMIT</button>
</div>
</body>

</html>


<?php
		
		if(isset($_POST['login'])){
			$username=$_POST['uname'];
			$password=$_POST['pass'];
			if($username=='admin' && $password=='admin@123')			
			{
				session_start();
				$_SESSION['username']=$username;
				$password=md5($password);
				echo "<script>
				window.location='mainpage.php';
				</script>";
			}
			else
			{
				echo"<script>
				alert('Incorrect Username or Password');
				window.location=window.location.href;
				</script>";
			}
			
					
					
		}
?>