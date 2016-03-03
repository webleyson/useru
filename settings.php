<?php
include 'core/init.php';
protectpage();
include 'includes/overall/header.php';
if (empty($_POST) === false){
	$required_fields = array('first_name', 'email');
	foreach ($_POST as $key => $value) {
		if(empty($value) && in_array($key, $required_fields)===true){
			$errors[] = 'Fields with (*) are required.';
			break 1;
		}
	}

	if(empty($errors) === true){
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
			$errors[]='A valid email address is required.';
		}else if(email_exists($_POST['email'])===true && $user_data['email'] !== $_POST['email']){
			$errors[] = "Sorry, the email address, '<strong>" .$_POST['email']. "</strong>' is already in use.";
		}
	}
}



?>
<h1>Account Preferences</h1>

<?php
if (isset($_GET['success']) === true && empty($_GET['success']) === true){
	echo 'details updated';
}else{



if (empty($_POST)===false && empty($errors) === true){
	
	$update_data = array(
			'first_name' 	=> $_POST['first_name'],
			'last_name' 	=> $_POST['last_name'],
			'email' 		=> $_POST['email'],
			'allow_email' 	=> $allow_email = ($_POST['allow_email'] == 'on') ? 1 : 0
		);

	update_user($session_user_id, $update_data);
	 header('Location: settings.php?success');
	exit();

}else if(empty($errors)===false){
	echo output_errors($errors);
}

?>
<form action="" method="post">
<ul>
	<li>
	First Name*<br />
	<input type="text" name="first_name" value="<?php echo $user_data['first_name'];?>">
	</li>
	<li>
	Last Name<br />
	<input type="text" name="last_name" value="<?php echo $user_data['last_name'];?>">
	</li>
	<li>
	Email*<br />
	<input type="email" name="email" value="<?php echo $user_data['email'];?>">
	</li>
	<li>
		<input type="checkbox" name="allow_email" <?php if($user_data['allow_email'] == 1) {echo 'checked="checked"';} ?> >Would you like to receive emails from useryou?
	</li>
	<li>
	<input type="text" name="location" value="<?php echo $user_data['location'];?>">
	</li>
	<li>
	Preferred Main Category<br />
	<input type="text" name="main_category">
	</li>
	<li>
	Preferred Sub Category<br />
	<input type="text" name="secondary_category">
	</li>
	<input type="submit" value="Update">
</ul>
</form>
<?php
include 'includes/overall/footer.php';
}
?>