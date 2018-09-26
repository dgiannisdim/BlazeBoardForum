<?php
	session_start();
	require('database.php');
	if($_SESSION['username']){
?>
<html>
	<head>
		<title>Blaze Board-Edit topic</title>
	</head>
	<?php include("header.php"); ?>
	<form action="edit.php" method="POST">
		<center>
			<br />
			Topic name: <br />
			<?php
			$id = $_GET['id'];
			$check = mysqli_query($connect, "SELECT * FROM topics WHERE topic_id='".$_GET['id']."'");

			if(mysqli_num_rows($check)){
				while($row = mysqli_fetch_assoc($check)){
					echo '<textarea name="topic_name" class="textarea1">'.$row['topic_name']."</textarea>";
					echo "<br /><br />";
					echo "Content: <br />";
					echo '<textarea name="content">'.$row['topic_content']."</textarea>";
				}
			}else{
				echo "Topic not found";
			}
			?>
			<br />
			<input type="submit" name="submit" value="edit" class="button button1">
		</center>
	</form>
</html>

<?php

$t_name =$_POST['topic_name'];
$content =$_POST['content'];
$date = date("Y-m-d, h:m:s");

echo "<center><br /><br />";
if(isset($_POST['submit'])){
	 if($t_name && $content){
	 	if(strlen($t_name) >= 5 && strlen($t_name) <=50){
	 		if($insert = mysqli_query($connect, "UPDATE topics SET topic_name='".$t_name."', topic_content='".$content."', date='".$date."' 
	 			WHERE topic_id='".$id."'")){
	 			header("Location: main.php");
	 		}else{
	 			echo "Fail";
	 		}
	 	}else{
	 		echo "Topic name must be between 5 and 50 characters long";
	 	}
	 }else{
	 	echo "Please fill in all the fields.";
	 }
}


}else{
	echo '<link rel="stylesheet" type="text/css" href="mystyle.css">';
	echo "<center>";
	echo "<div>";
	echo "You must be <a href='login.php'>Logged in<a/>";
	echo "</div>";
	echo "</center>";
}
echo "</center>";

?>

