<?php
include 'core/init.php';
logged_in_redirect();



if(empty($_POST)=== false){
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (empty($username) || empty($password)){
		$errors [] = "Please enter a username and password.";
	}else if (user_exists($username) === false){#
		$errors [] = "That username does not exist.";
	}else if (user_active($username)===false){
		$errors [] = "Please activate your account.  Check your email.";
	}else{
		if(strlen($password) > 32){
			$errors[] = "password too long";
		}
		$login = login($username, $password);
		if ($login === false){
			$errors[] = "User name and password doesn't match.";
		}else{
			$_SESSION['user_id'] = $login;
			header('Location: index.php');
			exit();
		}

	}

}else{
	$errors[] = "nothing to see here guv";
}

include 'includes/overall/header.php';
if (empty($errors) === false){
?>
<h2>We tried to log you in, but..</h2>
<?php
	echo output_errors($errors);
}
include 'includes/overall/footer.php';
?>