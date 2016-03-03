<?php 
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/header.php';
?>
<h1>Recover</h1>
<?php

if (isset($_GET['success']) === true && empty($_GET['success']) === true){
?>
<p>Please check your email for steps to recover your details.
<?php
}else{
	$mode_allowed = array('username', 'password');
	if (isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true) {
		if (isset($_POST['email']) === true && empty($_POST['email']) === false){
			if(email_exists($_POST['email']) === true) {
				recover($_GET['mode'], $_POST['email']);
				header('Location: recover.php?success');
				exit();
			}else{
				echo "Unable to find that email address";
			}
		}
	?>
	<form action="" method="post">
		<ul>
			<li>
				Please enter your email address<br />
				<input type="email" name="email">
			</li>
			<li>
				<input type="submit" value="Recover">
			</li>
		</ul>
	</form>
	<?php
	}else{
		header('Location: index.php');
		exit();
	}
}
?>
<?php include 'includes/overall/footer.php';?>
	