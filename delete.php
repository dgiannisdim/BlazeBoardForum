<?php
	session_start();
	require('database.php');
	if($_SESSION['username']){
?>
<html>
	<head>
		<title>Blaze Board-Delete</title>
	</head>
	<?php include("header.php"); ?>
	<center>
	
		<?php
			if($_GET['id']){
				$id = $_GET['id'];
				$check = mysqli_query($connect, "DELETE FROM topics WHERE topic_id='".$id."'");
				if($check){
					header("Location: my_topics.php");
				}
				
				}else{
					echo "id not found";
				}
				
			}else{
				echo '<link rel="stylesheet" type="text/css" href="mystyle.css">';
				echo "<center>";
				echo "<div>";
				echo "You must be <a href='login.php'>Logged in<a/>";
				echo "</div>";
				echo "</center>";
			}
	
?>