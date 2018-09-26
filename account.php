<?php
	session_start();
	require('database.php');
	if($_SESSION['username']){
?>
<html>
	<head>
		<title>Blaze Board-Account</title>
	</head>
	<?php include("header.php"); ?>
	<body>
	
		<center>
			<div>
		<p>
		<?php
		$check = mysqli_query($connect, "SELECT * FROM users WHERE username = '".$_SESSION['username']."'");
		$check_topics = mysqli_query($connect, "SELECT * FROM topics WHERE topic_creator = '".$_SESSION['username']."'");
		$rows = mysqli_num_rows($check_topics);
		
		while($row = mysqli_fetch_assoc($check)){
			$username = $row['username'];
			$id = $row['id'];
			$email = $row['email'];
			$date = $row['date'];
			$prof_pic = $row['profile_pic'];
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
		}
		?>

		<?php echo "<img src='$prof_pic' width='70' height='70'>"; ?> <br /> 
		Username: <?php echo $username; ?> <br />
		ID: <?php echo $id; ?> <br />
		First Name: <?php echo $first_name; ?> <br />
		Last Name: <?php echo $last_name; ?> <br />
		Email: <?php echo $email; ?> <br />
		Posts: <?php echo $rows; ?> <br />
		Date registered: <?php echo $date; ?> <br /><br /><br /> <br /> 
		<a href='account.php?action=cp'>Change password</a><br /> <br /> 
		<a href='account.php?action=ci'>Change profile picture</a><br /> 
		</center>
	</body>
</html>

<?php

	if(@$_GET['action'] == "ci"){
		echo '<form action="account.php?action=ci" method="POST" enctype="multipart/form-data"><center>
		<br />
		Available file extension: <b>.PNG .JPG .JPEG</b><br /> <br /> 
		<input type="file" name="image"><br /><br /> 
		<input type="submit" name="change_pic" value="change" class="button button1"><br /> 
		';
		
		if(isset($_POST['change_pic'])){
			$errors = array();
			$allowed_e = array('png', 'jpg', 'jpeg');
			$file_name = $_FILES['image']['name'];
			$file_e = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			$file_s = $_FILES['image']['size'];
			$file_tmp = $_FILES['image']['tmp_name'];
			
			if(in_array($file_e, $allowed_e) === false){
				$errors[] = 'This file extension is not allowed.';
			}
			
			if($file_s > 2097152){
				$errors[] = 'File size must be under 2mb';
			}
			
			if(empty($errors)){
				move_uploaded_file($file_tmp, 'images/'.$file_name);
				$image_up = 'images/'.$file_name;
			
				if($query = mysqli_query($connect, "UPDATE users SET profile_pic='".$image_up."' WHERE username='".$_SESSION['username']."'")){
					echo "Your profile image has changed.";
				}
			}else{
				foreach($errors as $error){
					echo $error, '<br />';
				}
			}
		}
		
		echo'</form></center>';
	}
	
	if(@$_GET['action'] == "cp"){
		echo "<form action='account.php?action=cp' method='POST'><center>";
		echo "
		Current password: <br/><input type='text' name='curr_pass'><br/>
		New password: <br/><input type='password' name='new_pass'><br/>
		Re-type password: <br/><input type='password' name='re_pass'><br/><br/>
		<input type='submit' name='change_pass' value='change' class='button button1'><br/>
		
		";
		
		$cur_pass = $_POST['curr_pass'];
		$new_pass = $_POST['new_pass'];
		$re_pass = $_POST['re_pass'];
		
		if(isset($_POST['change_pass'])){
			$check = mysqli_query($connect, "SELECT * FROM users");
			$rows = mysqli_num_rows($check);
		
			while($row = mysqli_fetch_assoc($check)){
				$get_pass = $row['password'];
			}	
			if(md5($cur_pass) == $get_pass){
				if(strlen($new_pass > 7)){
					if($re_pass == $new_pass){
						if($query = mysqli_query($connect, "UPDATE users SET password='".md5($new_pass)."' WHERE username='".$_SESSION['username']."'")){
							echo "Password changed.";
						}
					}else{
						echo "New password does not match with Re-type password.";
					}
				}else{
					echo "Password must have at least 8 characters.";
				}
			}else{
				echo "Current password does not match with your real password.";
			}
		}
			
	}

		echo "</center></form>";
	
	
	
	}else{
		echo '<link rel="stylesheet" type="text/css" href="mystyle.css">';
		echo "<center>";
		echo "<div>";
		echo "You must be <a href='login.php'>Logged in<a/>";
		echo "</div>";
		echo "</center>";
	}




?>
</div>