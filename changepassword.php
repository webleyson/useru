<?php
include 'core/init.php';
protectpage();

if(empty($_POST)===false){
	$required_fields = array('current_password', 'password', 'confirm_password');
	foreach ($_POST as $key => $value) {
		# code...
		if(empty($value) && in_array($key, $required_fields)===true){
			$errors[] = 'Fields with (*) are required.';
			break 1;
		}
	}

	if (md5($_POST['current_password']) === $user_data['password'] ){
		if(trim($_POST['password']) !== trim($_POST['confirm_password'])){
			$errors[] = "New passwords do not match";
		}elseif (strlen($_POST['password']) < 6) {
			$errors[] = "Password must be at least 6 characters";
		}
	}else{
		$errors[] = "That is not your current password.";
	}
}

include 'includes/overall/header.php';

if(isset($_GET['success']) === true && empty($_GET['success']) === true) {
	echo "Your password has been changed.";
}else{

	if((isset($_GET['force']) === true && empty($_GET['force']) === true)) {
?>
<p>You must change your password</p>
<?php

}if(empty($_POST) === false && empty($errors) === true) {
		change_password($session_user_id, $_POST['password']);
		header('Location: changepassword.php?success');
	}else if(empty($errors)===false){
		echo output_errors($errors);
	}
	?>
	<h1>Change Password</h1>
	<form action="" method="post">
		<ul>
			<li>
			Current Password*<br />
				<input type="password" name="current_password">
			</li>
			<li>
			New password*<br />
				<input type="password" name="password">
			</li>
			<li>
			Confirm new password*<br />
				<input type="password" name="confirm_password">
			</li>
			<li>
				<input type="submit" value="Change password">
			</li>
		</ul>
	</form>
<?php
}
include 'includes/overall/footer.php';
?>