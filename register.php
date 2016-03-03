<?php
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/header.php';

if (empty($_POST) === false){
	$required_fields = array('username', 'password', 'confirm_password', 'first_name', 'email', 'location');
	foreach ($_POST as $key => $value) {
		if(empty($value) && in_array($key, $required_fields)===true){
			$errors[] = 'Fields with (*) are required.';
			break 1;
		}
	}
	if(empty($errors) === true){
		if(user_exists($_POST['username']) === true){
			$errors[] = '<strong>'.htmlentities($_POST['username']) . '</strong> user name has already been taken. Please try something fresher.';
		}		
		if(preg_match("/\\s/", $_POST['username'])==true){
			$errors[] ="Username must not contain any spaces";
		}
		if(strlen($_POST['password']) < 6){
			$errors[] = "Password must be 6 characters or more";
		}
		if(($_POST['password']) != $_POST['confirm_password']){
			$errors[] = "Passwords do not match";
		}
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
			$errors[] = "Please enter a valid email address";
		}
		if (email_exists($_POST['email'])===true){
			$errors[] = "Sorry, the email address, '<strong>" .$_POST['email']. "</strong>' is already in use.";
		}
	}
}

if(isset($_GET['success']) && empty($_GET['success'])) {
	 echo "An activation email has been sent to your email address.<br />You'll need to activate before you start posting.";
}else{
	if (empty($_POST) === false && empty($errors) === true){
		$register_data = array(
			'username' => $_POST['username'],
			'password' => $_POST['password'],
			'first_name' => $_POST['first_name'],
			'last_name' => $_POST['last_name'],
			'email' => $_POST['email'],
			'email_code' => md5($_POST['username']+microtime()),
			'location' => $_POST['location']
			);
		register_user($register_data);
		header('Location: register.php?success');
		exit();

	}elseif (empty($errors)===false){
		 echo output_errors($errors);
	}
?>
	<h1>Register</h1>
	<form action="" method="post">
	<ul>
		<li>
			Username*<br />
			<input type="text" name="username" value="">
		</li>
		<li>
			Password*<br />
			<input type="password" name="password">
		</li>
		<li>
			Confirm password*<br />
			<input type="password" name="confirm_password">
		</li>
		<li>
			First Name*<br />
			<input type="text" name="first_name"  value="">
		</li>
		<li>
			Last Name<br />
			<input type="text" name="last_name"  value="">
		</li>
		<li>
			Email Address*<br />
			<input type="email" name="email"  value="">
		</li>
		<li>
			Location*<br />
			<input type="text" name="location"  value="">
		</li>
		<li>
		<input type="submit" value="Register">
		</li>
	</ul>
	</form>
<?php 
}
include 'includes/overall/footer.php';
?>
	