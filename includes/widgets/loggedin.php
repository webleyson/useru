<div class="widget">
	<h2><?php echo $user_data['first_name']. " " . $user_data['last_name'];?></h2>
	<div class="inner">
	<div class="profile">
	<?php 
		if (isset($_FILES['profile']) === true){
			if (empty($_FILES['profile']['name']) === true){
				echo 'Please choose a file';
			}else{
				$allowed = array('jpg', 'jpeg', 'gif','png');

				$file_name = $_FILES['profile']['name'];
				$file_extn = explode('.', $file_name);
				$file_ext = end($file_extn);
				$file_extn = strtolower($file_ext);
				$file_temp = $_FILES['profile']['tmp_name'];
				$file_size = $_FILES['profile']['size'];
				//1332219
				if (in_array($file_extn, $allowed) === true) {
			
					if($file_size > 1332219){
						echo 'That\'s too big! <br /> Please upload something smaller. The size of that image is '. $file_size .'. Limit is 1332219';
					}else{
						//upload file
						change_profile_image($session_user_id, $file_temp, $file_extn);
						header('Location: ' . $current_file);
						exit();
					}
				}else{
					echo 'Sorry. Must upload one of the following file types: <br />';
					foreach ($allowed as $ext) {
						# code...
						echo $ext . "<br />";
					}
				}
			}
		}

		if(empty($user_data['profile']) === false){
			echo '<img class="img-responsive" src="', $user_data['profile'],  '" alt="',  $user_data['first_name'] ,'\'s Profile Image">';
		}
	?>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
		    <label for="exampleInputFile">File input</label>
		    <input type="file" name="profile">
		    <p class="help-block">Example block-level help text here.</p>
		</div>
		<div class="form-group">
			<input class="btn btn-default" type="submit" />
		</div>
		
	</form>
	</div>
		<ul>
			<li><a href="logout.php">Logout</a></li>
			<li><a href="<?php echo $user_data['username'];?>">Profile</a></li>
			<li><a href="changepassword.php">Change Password</a></li>
			<li><a href="settings.php">Account Preferences</a></li>
		</ul>
</div>

</div>