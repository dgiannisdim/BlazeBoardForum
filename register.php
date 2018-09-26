<html>
<head>
<title>Create Account</title>
</head>
<link rel="stylesheet" type="text/css" href="mystyle.css">

<body>
	<br/><br/>
<center>
	<div>
	<h1>Blaze Board</h1>
	Create an account
	<form action="register.php" method="POST">
		<br/><input type="text" name="username" placeholder="Username...">
		<br /><br/><input type="password" name="password" placeholder="Password...">
		<br /><br/><input type="password" name="confpassword" placeholder="Confirm password...">
		<br /><br/><input type="text" name="email" placeholder="Email...">
		<br /><br/><input type="text" name="first_name" placeholder="First Name...">
		<br /><br/><input type="text" name="last_name" placeholder="Last Name..."><br />
		<br /><input type="submit" name="submit" value="Register" class="button button1"> or <a href="login.php">Login</a>
	</form>

<?php
require('database.php');
$username = @$_POST['username'];
$password = @$_POST['password'];
$confpassword = @$_POST['confpassword'];
$email = @$_POST['email'];
$first_name = @$_POST['first_name'];
$last_name = @$_POST['last_name'];
$date = date("Y-m-d");
$pass_en = md5($password);




if(isset($_POST['submit'])){
	if ($username && $password && $confpassword && $email){
		if (strlen($username) >= 5 && strlen($username) < 25 && strlen($password) > 7){
			if($confpassword == $password){
				if($insert = mysqli_query($connect, "INSERT INTO users (username, password, email, date, first_name, last_name)
				VALUES ('$username', '$pass_en', '$email', '$date', '$first_name', '$last_name')")){
					
					echo "You have been registered as $username. Click <a href='login.php'>here</a> to login";
				}else{
					echo "Fail to register";
				}
			}else{
				echo "Password does not match.";
			}
			
		}else{
			if (strlen($username) < 5 || strlen($username) > 25){
				echo "Username must be between 5 and 25 characters.";
			}
			
			if (strlen($password) < 8){
				echo "<br>Password must have at least 8 characters.";
			}
		}
		
	}else{
		echo "Please fill in all the fields.";
	}
}
?>
</div>

</center>
</body>
</html>