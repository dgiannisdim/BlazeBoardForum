<?php
	session_start();
	require('database.php');
	if($_SESSION['username']){
?>
<html>
	<head>
		<title>Blaze Board-My topics</title>
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
				<td>Date</td>
				<td>Delete</td>
			</tr>
	</center>
	<body>
	</body>
</html>

<?php
	$check = mysqli_query($connect, "SELECT * FROM topics ORDER BY topic_id DESC");
	if(mysqli_num_rows($check) != 0){
		while($row = mysqli_fetch_assoc($check)){
			if($row['topic_creator'] == $_SESSION['username']){
			$id = $row['topic_id'];
			echo "<tr><td>".$row['topic_id']."<t/d>";
			echo "<td style='text-align: center;'><a href='topic.php?id=$id'>".$row['topic_name']."</a><t/d>";
			echo "<td>".$row['views']."<t/d>";
			
			
			echo "<td>".$row['date']."<t/d>";
			echo "<td><a onclick=\"return confirm('Delete `".$row['topic_name']."` topic?')\" href=\"delete.php?id=".$id."\">Delete</a><t/d>";
		
			}
		}
	}else{
		echo "No topic found";
	}
	
	echo '</table>';

	
	
	
	}else{
		echo "You must be <a href='login.php'>Logged in<a/>";echo '<link rel="stylesheet" type="text/css" href="mystyle.css">';
		echo "<center>";
		echo "<div>";
		echo "You must be <a href='login.php'>Logged in<a/>";
		echo "</div>";
		echo "</center>";
	}


?>