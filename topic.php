<?php
	session_start();
	require('database.php');
	if($_SESSION['username']){
?>
<html>
	<head>
		<title>Blaze Board-Topic</title>
	</head>
	<?php include("header.php"); ?>
	<center>
		<?php
			if($_GET['id']){
				$id = $_GET['id'];
				$check = mysqli_query($connect, "SELECT * FROM topics WHERE topic_id='".$_GET['id']."'");
				
				if(mysqli_num_rows($check)){
					while($row = mysqli_fetch_assoc($check)){
						$check_u = mysqli_query($connect, "SELECT * FROM users WHERE username='".$row['topic_creator']."'");
						while($row_u = mysqli_fetch_assoc($check_u)){
							$user_id = $row_u['id'];
							
						}
						
						echo "<h1>".$row['topic_name']."</h1>";
						echo "<h5>By <a href='profile.php?id=$user_id'>".$row['topic_creator']."</a><br />Date: ".$row['date']."</h5>";
						echo "<div>";
						echo "<br />".$row['topic_content'];
						echo "</div>";
						
						$views = $row['views'] + 1;
						if($insert = mysqli_query($connect, "UPDATE topics SET views='".$views."' WHERE topic_id='".$id."'")){
							
						}
						
						if($_SESSION['username'] == $row['topic_creator']){
							echo "<a onclick=\"return confirm('Delete `".$row['topic_name']."` topic?')\" href=\"delete.php?id=".$id."\"class='button button1'>Delete</a>";
							echo "<br/><a href='edit.php?id=$id' class='button button1'>Edit</a>";
						}
					}
				}else{
					echo "Topic not found";
				}
				
				
			}else{
				header("Location: main.php");
			}
		
		?>
		
	</center>

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
