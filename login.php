<html>
<head><title>Blaze Board-Login</title></head>	
<link rel="stylesheet" type="text/css" href="mystyle.css">
<body>
	<br/><br/>
	<center>
	<div>
	<h1>Blaze Board</h1>
	<form action="login.php" method="POST">
		Username:<br /><input type="text" name="username" placeholder="Username..."><br /><br />
		Password:<br /><input type="password" name="password" placeholder="Password..."><br /><br />
		<input type="submit" value="Login" name="submit" class="button button1"> or <a href="register.php">Register</a>
	</form>

<?php
session_start();
require('database.php');
$username = @$_POST['username'];
$password = @$_POST['password'];


if (isset($_POST['submit'])){
	if($username && $password){
		$check = mysqli_query($connect, "SELECT * FROM users WHERE username='{$username}'");
		
		if(mysqli_num_rows($check) != 0){
			
			while($row = mysqli_fetch_assoc($check)){
				$db_username = $row['username'];
				$db_password = $row['password'];
			}
			
			if($username == $db_username && md5($password) == $db_password){
				$_SESSION['username'] = $username;
				header("Location: main.php");
			}else{
				echo "Wrong <b>Password</b>.";
			}
		}else{
			die ("Could not find <b>Username</b>.");
		}
	}else{
		echo "Please fill in all the fields.";
	}
}
if(@$_GET['action'] == "logout"){
		session_destroy();
		header("Location: login.php");
	}
?>
	</div>
	</center>

</body>
</html>