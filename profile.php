<?php
	session_start();
	require('database.php');
	if($_SESSION['username']){
?>
<html>
	<head>
		<title>Blaze Board-My profile</title>
	</head>
	<?php include("header.php"); 
		echo "<center>";
		if($_GET['id']){
			$check = mysqli_query($connect, "SELECT * FROM users WHERE id='".$_GET['id']."'");
			
			if(mysqli_num_rows($check) != 0){
				while($row = mysqli_fetch_assoc($check)){
					echo "<h1>".$row['username']."</h1><img src='".$row['profile_pic']."' width='50' height='50'><br/>";
					echo "<b>First Name: </b>".$row['first_name']."<br/>";
					echo "<b>Last Name: </b>".$row['last_name']."<br/>";
					echo "<b>Date registered: </b>".$row['date']."<br/>";
					echo "<b>Email: </b>".$row['email']."<br/>";
				}	
			}else{
				echo "ID not found.";
			}
		}else{
			header("Location:main.php");
		}
		echo "</center>";
		?>
	<body>
	</body>
</html>

<?php
	
	}else{
		echo '<link rel="stylesheet" type="text/css" href="mystyle.css">';
		echo "<center>";
		echo "<div>";
		echo "You must be <a href='login.php'>Logged in<a/>";
		echo "</div>";
		echo "</center>";
	}




?>