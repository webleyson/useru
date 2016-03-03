<?php
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/header.php';


if (isset($_GET['success']) === true && empty($_GET['success']) === true){
?>
<h2>Account activated. Please login</h2>

<?php
}else if(isset($_GET['email'], $_GET['email_code']) === true){
	$email = trim($_GET['email']);
	$email_code = trim($_GET['email_code']);

	if (email_exists($email) === false){
		$errors[] = "There has been an issue matching your email address.  You will need to register again.";
	}elseif (activate($email, $email_code)===false) {
		$errors[] = 'We are unable to activate your account.  Please try again.';
	}
	if(empty($errors) === false){
	?>
	<h2>Opps...</h2>
	<?php
	echo output_errors($errors);
	}else{
		header('Location: activate.php?success');
	}
}else{
	header('Location: index.php');
	exit();
}

include 'includes/overall/footer.php';
?>