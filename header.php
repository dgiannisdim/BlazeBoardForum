<?php
if($_SESSION['username']){

?>
<link rel="stylesheet" type="text/css" href="mystyle2.css">
<h1>Blaze Board</h1>
Welcome, 


<?php
	$check = mysqli_query($connect, "SELECT *FROM users WHERE username='".$_SESSION['username']."'");
	while($row = mysqli_fetch_assoc($check)){
		$id = $row['id'];
	}
	echo "<a href='profile.php?id=$id'>".$_SESSION['username'];
?>

<a href="profile.php?id= <?php $id;?>"></a>
<center>
<br/>
<ul>
	<li><a href="main.php">Home page</a></li>
	<li><a href="post.php">Create topic</a></li>
	<li><a href="my_topics.php">My topics</a></li>
	<li><a href="account.php">My account</a></li>
	<li><a href="members.php">Members</a></li>
	<li><a href="login.php?action=logout">Logout</a></li>
</center>
</ul>

<?php
}else{
	header("Location: login.php");
}

?>