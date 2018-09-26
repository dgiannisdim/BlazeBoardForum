<?php
	session_start();
	require('database.php');
	if($_SESSION['username']){
?>
<html>
	<head>
		<title>Blaze Board-Post topic</title>
	</head>
	<?php include("header.php"); ?>
	<form action="post.php" method="POST">
		<center>
			<br />
			Topic name: <br />
			<textarea name="topic_name" class= "textarea1"></textarea>
			<br /><br />
			Content: <br />
			<textarea name="content"></textarea>
			<br />
			<input type="submit" name="submit" value="post" class="button button1">
		</center>
	</form>
</html>

<?php
$t_name =@$_POST['topic_name'];
$content =@$_POST['content'];
$date = date("Y-m-d, h:m:s");


echo "<center><br /><br />";
if(isset($_POST['submit'])){
	 if($t_name && $content){
	 	if(strlen($t_name) >= 5 && strlen($t_name) <=50){
	 		if($insert = mysqli_query($connect, "INSERT INTO topics (topic_name, topic_content, topic_creator, date)
	 		VALUES('$t_name', '$content', '{$_SESSION['username']}', '$date')")){
	 			echo "Posted successfully";
				header("Location:main.php");
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

