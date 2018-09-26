<?php
	session_start();
	require('database.php');
	include("header.php"); 
	echo "<center><h1>Members</h1>";
	if($_SESSION['username']){
?>
<html>
	<head>
	
		<title>Blaze Board-Members</title>
	</head>
	<body>
	

<ol active class="a">
	
	<?php 
	
		$check = mysqli_query($connect, "SELECT * FROM users");
		$rows = mysqli_num_rows($check);
	
		while($row = mysqli_fetch_assoc($check)){
			$id = $row['id'];
			echo "<li>";
			echo "<a href='profile.php?id=$id'>".$row['username']. "</a>";
			echo "</li><br/>";
		}
		
	
	?>
	
</ol>
	
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