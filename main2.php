<?php
	session_start();
	require('database.php');
	if($_SESSION['username']){
?>
<html>
	<head>
		<title>Blaze Board-Home page</title>
	</head>
	<?php include("header.php"); ?>
	<center>
		<br />
		<a href="post.php" class="button button1">Create topic</a>
		<br />
		<br />
		<?php echo '<table border="5px;">'; ?>
			<tr>
				<td>ID</td>
				<td>Name</td>
				<td>Views</td>
				<td>Creator</td>
				<td>Date</td>
			</tr>
	</center>
</html>


<?php
	$check = mysqli_query($connect, "SELECT * FROM topics ORDER BY topic_id DESC");
	if(mysqli_num_rows($check) != 0){
		while($row = mysqli_fetch_assoc($check)){
				$id = $row['topic_id'];
				echo "<tr><td>".$row['topic_id']."<t/d>";
				echo "<td><a href='topic.php?id=$id'>".$row['topic_name']."</a><t/d>";
				echo "<td>".$row['views']."<t/d>";
				$check_u = mysqli_query($connect, "SELECT * FROM users WHERE username='".$row['topic_creator']."'");
				while($row_u = mysqli_fetch_assoc($check_u)){
					$user_id = $row_u['id'];
				}
				echo "<td><a href='profile.php?id=$user_id'>".$row['topic_creator']."</a><t/d>";
			
				echo "<td>".$row['date']."<t/d></tr>";
			}
		
	
	}else{
	
		echo "No topic found";
	}
	
	echo '</table>';
	
	echo "<br /><br /><a href='main.php?action=load'>Show less</a>";
	
	
	
	}else{
		echo '<link rel="stylesheet" type="text/css" href="mystyle.css">';
		echo "<center>";
		echo "<div>";
		echo "You must be <a href='login.php'>Logged in<a/>";
		echo "</div>";
		echo "</center>";
	}
	
?>